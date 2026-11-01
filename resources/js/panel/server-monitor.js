export function initServerMonitor() {
    const container = document.getElementById('server-monitor-root');
    if (!container) return;

    const pollUrl = container.getAttribute('data-poll-url') || '/admin/server/poll';

    // Rolling history for SVG charts (up to 20 data points)
    const history = {
        cpu: [0],
        ram: [0],
    };

    const cpuValEl = document.getElementById('metric-cpu-val');
    const cpuBarEl = document.getElementById('metric-cpu-bar');
    const ramValEl = document.getElementById('metric-ram-val');
    const ramBarEl = document.getElementById('metric-ram-bar');
    const diskValEl = document.getElementById('metric-disk-val');
    const diskBarEl = document.getElementById('metric-disk-bar');
    const loadValEl = document.getElementById('metric-load-val');
    const uptimeValEl = document.getElementById('metric-uptime-val');
    const procTableBody = document.getElementById('server-processes-tbody');
    const pollStatusEl = document.getElementById('poll-status-indicator');

    const svgCpuPath = document.getElementById('svg-cpu-line');
    const svgCpuArea = document.getElementById('svg-cpu-area');
    const svgRamPath = document.getElementById('svg-ram-line');
    const svgRamArea = document.getElementById('svg-ram-area');

    function updateSvgChart(dataArray, lineEl, areaEl) {
        if (!lineEl || !areaEl) return;
        const width = 300;
        const height = 80;
        const maxPoints = 20;

        const points = dataArray.slice(-maxPoints);
        if (points.length < 2) return;

        const stepX = width / (maxPoints - 1);
        const startOffset = (maxPoints - points.length) * stepX;

        const coords = points.map((val, idx) => {
            const x = startOffset + idx * stepX;
            const clampedVal = Math.max(0, Math.min(100, val));
            const y = height - (clampedVal / 100) * (height - 8) - 4;
            return { x, y };
        });

        const lineD = coords.reduce((acc, pt, i) => `${acc} ${i === 0 ? 'M' : 'L'} ${pt.x.toFixed(1)} ${pt.y.toFixed(1)}`, '');
        lineEl.setAttribute('d', lineD);

        const areaD = `${lineD} L ${coords[coords.length - 1].x.toFixed(1)} ${height} L ${coords[0].x.toFixed(1)} ${height} Z`;
        areaEl.setAttribute('d', areaD);
    }

    async function fetchMetrics() {
        if (pollStatusEl) {
            pollStatusEl.classList.remove('bg-emerald-500');
            pollStatusEl.classList.add('bg-amber-400', 'animate-ping');
        }

        try {
            const response = await fetch(pollUrl, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (!response.ok) return;

            const data = await response.json();

            // Update CPU
            const cpu = data.cpu_usage || 0;
            if (cpuValEl) cpuValEl.textContent = `${cpu}%`;
            if (cpuBarEl) cpuBarEl.style.width = `${Math.min(cpu, 100)}%`;
            history.cpu.push(cpu);
            if (history.cpu.length > 20) history.cpu.shift();
            updateSvgChart(history.cpu, svgCpuPath, svgCpuArea);

            // Update RAM
            const ram = data.memory?.used_percent || 0;
            if (ramValEl) {
                ramValEl.textContent = `${ram}% (${(data.memory.used_mb / 1024).toFixed(1)} GB / ${(data.memory.total_mb / 1024).toFixed(1)} GB)`;
            }
            if (ramBarEl) ramBarEl.style.width = `${Math.min(ram, 100)}%`;
            history.ram.push(ram);
            if (history.ram.length > 20) history.ram.shift();
            updateSvgChart(history.ram, svgRamPath, svgRamArea);

            // Update Disk
            const disk = data.disk?.used_percent || 0;
            if (diskValEl) {
                diskValEl.textContent = `${disk}% (${data.disk.used_gb} GB / ${data.disk.total_gb} GB)`;
            }
            if (diskBarEl) diskBarEl.style.width = `${Math.min(disk, 100)}%`;

            // Update Load & Uptime
            if (loadValEl && data.load_average) {
                loadValEl.textContent = `${data.load_average['1m']} | ${data.load_average['5m']} | ${data.load_average['15m']}`;
            }
            if (uptimeValEl && data.uptime) {
                uptimeValEl.textContent = data.uptime.human || '-';
            }

            // Update Services Status
            if (data.services) {
                ['nginx', 'mysql', 'php8.4-fpm'].forEach((svc) => {
                    const status = data.services[svc] || 'inactive';
                    const el = document.getElementById(`service-status-${svc.replace(/[^a-z0-9]/gi, '_')}`);
                    if (el) {
                        el.textContent = status;
                        if (status === 'active') {
                            el.className = 'px-2 py-0.5 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300';
                        } else {
                            el.className = 'px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-300';
                        }
                    }
                });
            }

            // Update Top 10 Processes
            if (procTableBody && data.processes && Array.isArray(data.processes)) {
                procTableBody.innerHTML = data.processes.map((p) => `
                    <tr class="hover:bg-slate-50 border-b border-slate-100 transition-colors">
                        <td class="py-2 px-3 font-mono text-xs text-slate-500">${p.pid}</td>
                        <td class="py-2 px-3 font-semibold text-xs text-slate-700">${escapeHtml(p.user)}</td>
                        <td class="py-2 px-3 font-mono text-xs text-amber-700 font-bold">${p.cpu}%</td>
                        <td class="py-2 px-3 font-mono text-xs text-slate-600">${p.mem}%</td>
                        <td class="py-2 px-3 font-mono text-xs text-slate-700 max-w-xs truncate" title="${escapeHtml(p.command)}">${escapeHtml(p.command)}</td>
                    </tr>
                `).join('');
            }
        } catch (err) {
            console.error('Failed to poll server metrics', err);
        } finally {
            if (pollStatusEl) {
                pollStatusEl.classList.remove('bg-amber-400', 'animate-ping');
                pollStatusEl.classList.add('bg-emerald-500');
            }
        }
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Initial fetch
    fetchMetrics();

    // Poll every 5 seconds
    const intervalId = setInterval(fetchMetrics, 5000);

    // Clean up if navigating away
    window.addEventListener('beforeunload', () => clearInterval(intervalId));
}
