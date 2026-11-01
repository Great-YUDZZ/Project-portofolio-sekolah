@extends('layouts.panel')

@section('title', 'Pemantau Beban Server')
@section('page-title', 'Pemantau Beban Server & Status Sistem')

@section('header-actions')
    <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs text-slate-700 shadow-2xs">
        <span id="poll-status-indicator" class="w-2.5 h-2.5 rounded-full bg-emerald-500 transition-all"></span>
        <span class="font-mono text-[11px]">Polling Aktif (5s)</span>
    </div>
@endsection

@section('content')
<div id="server-monitor-root" data-poll-url="{{ route('panel.server.poll') }}" class="space-y-6">
    <!-- Top Metrics Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- CPU Card with SVG mini line chart -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between text-slate-500 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-600">Beban CPU Host</span>
                    <span class="text-[11px] font-mono px-2 py-0.5 rounded bg-slate-100 text-slate-700 font-bold">/proc/stat</span>
                </div>
                <div id="metric-cpu-val" class="text-3xl font-black text-slate-900 tracking-tight">
                    {{ $metrics['cpu_usage'] ?? 0 }}%
                </div>
            </div>

            <!-- SVG Real-time Line Graph -->
            <div class="mt-4 pt-3 border-t border-slate-100">
                <svg viewBox="0 0 300 80" class="w-full h-16 overflow-visible">
                    <defs>
                        <linearGradient id="cpuGrad" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#D97706" stop-opacity="0.25" />
                            <stop offset="100%" stop-color="#D97706" stop-opacity="0.0" />
                        </linearGradient>
                    </defs>
                    <path id="svg-cpu-area" fill="url(#cpuGrad)" d="" />
                    <path id="svg-cpu-line" fill="none" stroke="#D97706" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="" />
                </svg>
                <div class="w-full h-1.5 bg-slate-100 rounded-full mt-2 overflow-hidden">
                    <div id="metric-cpu-bar" class="h-full bg-amber-500 rounded-full transition-all duration-500" style="width: {{ $metrics['cpu_usage'] ?? 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- RAM Card with SVG mini line chart -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between text-slate-500 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-600">Penggunaan Memori RAM</span>
                    <span class="text-[11px] font-mono px-2 py-0.5 rounded bg-slate-100 text-slate-700 font-bold">/proc/meminfo</span>
                </div>
                <div id="metric-ram-val" class="text-2xl font-black text-slate-900 tracking-tight truncate">
                    {{ $metrics['memory']['used_percent'] ?? 0 }}%
                </div>
                <div class="text-[11px] text-slate-500 mt-0.5">
                    {{ round(($metrics['memory']['used_mb'] ?? 0) / 1024, 1) }} GB terpakai dari {{ round(($metrics['memory']['total_mb'] ?? 0) / 1024, 1) }} GB
                </div>
            </div>

            <!-- SVG Real-time Line Graph for RAM -->
            <div class="mt-4 pt-3 border-t border-slate-100">
                <svg viewBox="0 0 300 80" class="w-full h-16 overflow-visible">
                    <defs>
                        <linearGradient id="ramGrad" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#10B981" stop-opacity="0.25" />
                            <stop offset="100%" stop-color="#10B981" stop-opacity="0.0" />
                        </linearGradient>
                    </defs>
                    <path id="svg-ram-area" fill="url(#ramGrad)" d="" />
                    <path id="svg-ram-line" fill="none" stroke="#10B981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="" />
                </svg>
                <div class="w-full h-1.5 bg-slate-100 rounded-full mt-2 overflow-hidden">
                    <div id="metric-ram-bar" class="h-full bg-emerald-500 rounded-full transition-all duration-500" style="width: {{ $metrics['memory']['used_percent'] ?? 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Disk Storage Card -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between text-slate-500 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-600">Penyimpanan Hard Disk</span>
                    <span class="text-[11px] font-mono px-2 py-0.5 rounded bg-slate-100 text-slate-700 font-bold">Root /</span>
                </div>
                <div id="metric-disk-val" class="text-2xl font-black text-slate-900 tracking-tight">
                    {{ $metrics['disk']['used_percent'] ?? 0 }}%
                </div>
                <div class="text-[11px] text-slate-500 mt-0.5">
                    {{ $metrics['disk']['used_gb'] ?? 0 }} GB terpakai dari {{ $metrics['disk']['total_gb'] ?? 0 }} GB
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-slate-100">
                <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                    <div id="metric-disk-bar" class="h-full bg-blue-600 rounded-full transition-all duration-500" style="width: {{ $metrics['disk']['used_percent'] ?? 0 }}%"></div>
                </div>
                <div class="flex justify-between text-[11px] text-slate-500 mt-2 font-mono">
                    <span>Tersisa: {{ $metrics['disk']['free_gb'] ?? 0 }} GB</span>
                    <span>Database: {{ $metrics['database']['size_mb'] ?? 0 }} MB</span>
                </div>
            </div>
        </div>

        <!-- Load Average & Uptime Card -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between text-slate-500 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-600">Load Average</span>
                    <span class="text-[11px] font-mono px-2 py-0.5 rounded bg-slate-100 text-slate-700 font-bold">1m | 5m | 15m</span>
                </div>
                <div id="metric-load-val" class="text-xl font-bold font-mono text-slate-900 tracking-tight">
                    {{ $metrics['load_average']['1m'] ?? '-' }} | {{ $metrics['load_average']['5m'] ?? '-' }} | {{ $metrics['load_average']['15m'] ?? '-' }}
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-slate-100 space-y-1.5 text-xs">
                <div class="flex justify-between text-slate-600">
                    <span>Uptime Host:</span>
                    <span id="metric-uptime-val" class="font-mono font-semibold text-slate-900">{{ $metrics['uptime']['human'] ?? '-' }}</span>
                </div>
                <div class="flex justify-between text-slate-600">
                    <span>Versi PHP:</span>
                    <span class="font-mono text-slate-800">{{ $metrics['php_version'] ?? PHP_VERSION }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Middle: System Daemons & Database Status -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Service Daemon Status -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs">
            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-3">Status Layanan Daemon</h4>
            <div class="space-y-2.5">
                @foreach(['nginx' => 'Web Server Nginx', 'mysql' => 'Database MySQL', 'php8.4-fpm' => 'PHP FastCGI (FPM)'] as $svc => $label)
                    @php
                        $st = $metrics['services'][$svc] ?? 'unknown';
                        $cleanId = preg_replace('/[^a-z0-9]/i', '_', $svc);
                    @endphp
                    <div class="flex items-center justify-between p-2 rounded-lg bg-slate-50 border border-slate-100 text-xs">
                        <span class="font-medium text-slate-700">{{ $label }}</span>
                        <span id="service-status-{{ $cleanId }}" class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $st === 'active' ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-red-100 text-red-800 border border-red-300' }}">
                            {{ $st }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Database Isolation Information -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs">
            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-3">Isolasi Database Sekolah</h4>
            <div class="space-y-2 text-xs">
                <div class="flex justify-between p-2 rounded bg-slate-50 border border-slate-100">
                    <span class="text-slate-600">Nama Pangkalan Data:</span>
                    <span class="font-mono font-bold text-slate-900">{{ $metrics['database']['database_name'] ?? 'skensa' }}</span>
                </div>
                <div class="flex justify-between p-2 rounded bg-slate-50 border border-slate-100">
                    <span class="text-slate-600">Pengguna Terisolasi:</span>
                    <span class="font-mono font-bold text-emerald-700">{{ $metrics['database']['user'] ?? 'skensa_app' }}</span>
                </div>
                <div class="flex justify-between p-2 rounded bg-slate-50 border border-slate-100">
                    <span class="text-slate-600">Ukuran Pangkalan Data:</span>
                    <span class="font-mono font-bold text-slate-900">{{ $metrics['database']['size_mb'] ?? 0 }} MB</span>
                </div>
            </div>
        </div>

        <!-- Web Security Status -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs">
            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-3">Lapisan Proteksi Keamanan</h4>
            <div class="space-y-1.5 text-xs">
                <div class="flex items-center justify-between text-slate-700">
                    <span>Rate Limiter Login:</span>
                    <span class="font-semibold text-emerald-700 font-mono">5 att/min (IP+User)</span>
                </div>
                <div class="flex items-center justify-between text-slate-700">
                    <span>Enkripsi Sesi:</span>
                    <span class="font-semibold text-emerald-700 font-mono">AES-256-CBC</span>
                </div>
                <div class="flex items-center justify-between text-slate-700">
                    <span>Content Security Policy:</span>
                    <span class="font-semibold text-emerald-700 font-mono">Strict Header</span>
                </div>
                <div class="flex items-center justify-between text-slate-700">
                    <span>XSS Output Sanitizer:</span>
                    <span class="font-semibold text-emerald-700 font-mono">HTMLPurifier Allowlist</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom: Top 10 Running Processes -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h3 class="font-bold text-slate-900 text-sm">Top 10 Proses Berjalan Berdasarkan Penggunaan CPU</h3>
                <p class="text-xs text-slate-500">Daftar proses aktif secara dinamis dimutakhirkan setiap 5 detik</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 uppercase tracking-wider font-mono">
                    <tr>
                        <th class="py-2.5 px-3">PID</th>
                        <th class="py-2.5 px-3">User</th>
                        <th class="py-2.5 px-3">% CPU</th>
                        <th class="py-2.5 px-3">% MEM</th>
                        <th class="py-2.5 px-3">Command / Executable</th>
                    </tr>
                </thead>
                <tbody id="server-processes-tbody" class="divide-y divide-slate-100 font-mono text-slate-700">
                    @forelse($metrics['processes'] ?? [] as $p)
                        <tr class="hover:bg-slate-50 border-b border-slate-100 transition-colors">
                            <td class="py-2 px-3 text-slate-500">{{ $p['pid'] }}</td>
                            <td class="py-2 px-3 font-semibold text-slate-700">{{ $p['user'] }}</td>
                            <td class="py-2 px-3 text-amber-700 font-bold">{{ $p['cpu'] }}%</td>
                            <td class="py-2 px-3 text-slate-600">{{ $p['mem'] }}%</td>
                            <td class="py-2 px-3 text-slate-700 max-w-xs truncate" title="{{ $p['command'] }}">{{ $p['command'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-slate-400">Tidak dapat mengambil daftar proses.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
