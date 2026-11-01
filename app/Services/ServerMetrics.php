<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

class ServerMetrics
{
    /**
     * Get aggregate server health and resource usage metrics.
     * Cached for 3 seconds to avoid resource spikes under polling.
     */
    public static function get(): array
    {
        return Cache::remember('skensa_server_metrics', 3, function () {
            $cpu = self::getCpuUsage();
            $load = self::getLoadAverage();
            $procs = self::getTopProcesses();

            return [
                'timestamp' => now()->toIso8601String(),
                'cpu' => $cpu,
                'cpu_usage' => $cpu,
                'memory' => self::getMemoryUsage(),
                'disk' => self::getDiskUsage(),
                'load' => $load,
                'load_average' => $load,
                'uptime' => self::getUptime(),
                'services' => self::getServiceStatuses(),
                'database' => self::getDatabaseMetrics(),
                'top_processes' => $procs,
                'processes' => $procs,
                'recent_logs' => self::getRecentLogs(),
                'php_version' => PHP_VERSION,
            ];
        });
    }

    public static function getMetrics(): array
    {
        return self::get();
    }

    /**
     * Compute CPU percentage from /proc/stat.
     */
    protected static function getCpuUsage(): float
    {
        if (!is_readable('/proc/stat')) {
            return 0.0;
        }

        $readStat = function () {
            $lines = file('/proc/stat');
            $line = explode(' ', preg_replace('/\s+/', ' ', trim($lines[0])));
            $idle = (int) ($line[4] ?? 0) + (int) ($line[5] ?? 0); // idle + iowait
            $total = 0;
            for ($i = 1; $i <= 8; $i++) {
                $total += (int) ($line[$i] ?? 0);
            }
            return [$idle, $total];
        };

        [$idle1, $total1] = $readStat();
        usleep(100000); // 100ms
        [$idle2, $total2] = $readStat();

        $diffIdle = $idle2 - $idle1;
        $diffTotal = $total2 - $total1;

        if ($diffTotal <= 0) {
            return 0.0;
        }

        $usage = (1 - ($diffIdle / $diffTotal)) * 100;
        return round(max(0, min(100, $usage)), 1);
    }

    /**
     * Parse RAM metrics from /proc/meminfo.
     */
    protected static function getMemoryUsage(): array
    {
        if (!is_readable('/proc/meminfo')) {
            return ['total_mb' => 0, 'used_mb' => 0, 'free_mb' => 0, 'percentage' => 0];
        }

        $meminfo = [];
        foreach (file('/proc/meminfo') as $line) {
            if (preg_match('/^(\w+):\s+(\d+)\s+kB$/', trim($line), $matches)) {
                $meminfo[$matches[1]] = (int) $matches[2];
            }
        }

        $totalKb = $meminfo['MemTotal'] ?? 1;
        $availableKb = $meminfo['MemAvailable'] ?? ($meminfo['MemFree'] ?? 0);
        $usedKb = max(0, $totalKb - $availableKb);

        return [
            'total_mb' => round($totalKb / 1024, 1),
            'used_mb' => round($usedKb / 1024, 1),
            'available_mb' => round($availableKb / 1024, 1),
            'free_mb' => round($availableKb / 1024, 1),
            'percentage' => round(($usedKb / $totalKb) * 100, 1),
            'used_percent' => round(($usedKb / $totalKb) * 100, 1),
        ];
    }

    /**
     * Read root partition disk usage.
     */
    protected static function getDiskUsage(): array
    {
        $total = @disk_total_space('/') ?: 1;
        $free = @disk_free_space('/') ?: 0;
        $used = max(0, $total - $free);

        return [
            'total_gb' => round($total / (1024 * 1024 * 1024), 2),
            'used_gb' => round($used / (1024 * 1024 * 1024), 2),
            'free_gb' => round($free / (1024 * 1024 * 1024), 2),
            'percentage' => round(($used / $total) * 100, 1),
            'used_percent' => round(($used / $total) * 100, 1),
        ];
    }

    /**
     * Read 1m, 5m, 15m load average.
     */
    protected static function getLoadAverage(): array
    {
        if (function_exists('sys_getloadavg')) {
            $loads = sys_getloadavg();
            return [
                '1m' => round($loads[0] ?? 0, 2),
                '5m' => round($loads[1] ?? 0, 2),
                '15m' => round($loads[2] ?? 0, 2),
            ];
        }

        return ['1m' => 0, '5m' => 0, '15m' => 0];
    }

    /**
     * Read uptime from /proc/uptime.
     */
    protected static function getUptime(): array
    {
        if (is_readable('/proc/uptime')) {
            $uptimeSeconds = (int) explode(' ', file_get_contents('/proc/uptime'))[0];
            $days = floor($uptimeSeconds / 86400);
            $hours = floor(($uptimeSeconds % 86400) / 3600);
            $minutes = floor(($uptimeSeconds % 3600) / 60);

            $human = $days > 0 ? "{$days} hari, {$hours} jam" : "{$hours} jam, {$minutes} menit";

            return [
                'seconds' => $uptimeSeconds,
                'human' => $human,
            ];
        }

        return [
            'seconds' => 0,
            'human' => 'Tidak tersedia',
        ];
    }

    /**
     * Inspect status of vital services without shell injection risk.
     */
    protected static function getServiceStatuses(): array
    {
        $services = ['nginx', 'mysql', 'php8.4-fpm'];
        $statuses = [];

        foreach ($services as $srv) {
            $process = new Process(['systemctl', 'is-active', $srv]);
            $process->run();
            $output = trim($process->getOutput());
            $statuses[$srv] = ($output === 'active');
        }

        return $statuses;
    }

    /**
     * Get Database size and active session count.
     */
    protected static function getDatabaseMetrics(): array
    {
        $sizeMb = 0.0;
        try {
            $row = DB::selectOne("
                SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb
                FROM information_schema.tables
                WHERE table_schema = DATABASE()
            ");
            $sizeMb = (float) ($row->size_mb ?? 0.0);
        } catch (\Throwable $e) {
            $sizeMb = 0.0;
        }

        $activeSessions = 0;
        try {
            $activeSessions = DB::table('sessions')
                ->where('last_activity', '>=', now()->subMinutes(15)->timestamp)
                ->count();
        } catch (\Throwable $e) {
            $activeSessions = 0;
        }

        return [
            'database_name' => config('database.connections.mysql.database'),
            'user' => config('database.connections.mysql.username'),
            'size_mb' => $sizeMb,
            'active_sessions_15m' => $activeSessions,
        ];
    }

    /**
     * Safe listing of top 10 processes by CPU consumption.
     * Uses static process command with no user input.
     */
    protected static function getTopProcesses(): array
    {
        $process = new Process(['ps', '-eo', 'pid,user,%cpu,%mem,comm', '--sort=-%cpu']);
        $process->run();

        if (!$process->isSuccessful()) {
            return [];
        }

        $lines = explode("\n", trim($process->getOutput()));
        array_shift($lines); // remove header

        $result = [];
        $count = 0;
        foreach ($lines as $line) {
            $parts = preg_split('/\s+/', trim($line));
            if (count($parts) >= 5) {
                $command = implode(' ', array_slice($parts, 4));
                $result[] = [
                    'pid' => $parts[0],
                    'user' => htmlspecialchars($parts[1]),
                    'cpu' => (float) $parts[2],
                    'mem' => (float) $parts[3],
                    'command' => htmlspecialchars($command),
                    'name' => htmlspecialchars($command),
                ];
                $count++;
                if ($count >= 10) break;
            }
        }

        return $result;
    }

    /**
     * Read last 50 lines of storage/logs/laravel.log safely, masking sensitive info.
     */
    protected static function getRecentLogs(): array
    {
        $logFile = storage_path('logs/laravel.log');
        if (!file_exists($logFile) || !is_readable($logFile)) {
            return [];
        }

        $lines = [];
        $file = new \SplFileObject($logFile, 'r');
        $file->seek(PHP_INT_MAX);
        $totalLines = $file->key();

        $startLine = max(0, $totalLines - 50);
        $file->seek($startLine);

        while (!$file->eof()) {
            $line = trim($file->fgets());
            if ($line !== '') {
                // Mask sensitive tokens/passwords
                $masked = preg_replace('/(password|token|secret|key)=\S+/i', '$1=***REDACTED***', $line);
                $lines[] = htmlspecialchars($masked);
            }
        }

        return array_slice(array_reverse($lines), 0, 50);
    }
}
