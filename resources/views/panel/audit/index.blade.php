@extends('layouts.panel')

@section('title', 'Catatan Audit Keamanan')
@section('page-title', 'Catatan Audit & Jejak Aktivitas Keamanan')

@section('content')
<div class="space-y-5">
    <!-- Filter Bar -->
    <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-xs">
        <form method="GET" action="{{ route('panel.audit.index') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
            <div class="sm:col-span-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari aktivitas, nama pengguna, atau alamat IP..." class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
            </div>

            <div>
                <select name="action" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-slate-700">
                    <option value="">Semua Jenis Aksi</option>
                    @foreach($actions as $act)
                        <option value="{{ $act }}" {{ request('action') === $act ? 'selected' : '' }}>{{ $act }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="w-full px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-lg transition-colors">
                    Saring Log
                </button>
                @if(request()->hasAny(['q', 'action']))
                    <a href="{{ route('panel.audit.index') }}" class="p-2 text-slate-500 hover:text-slate-800 rounded-lg hover:bg-slate-100" title="Reset">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Audit Logs Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 uppercase tracking-wider font-mono">
                    <tr>
                        <th class="py-3 px-4">Waktu (WITA)</th>
                        <th class="py-3 px-4">Pengguna</th>
                        <th class="py-3 px-4">Aksi</th>
                        <th class="py-3 px-4">Deskripsi Aktivitas</th>
                        <th class="py-3 px-4">Alamat IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-mono">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3 px-4 whitespace-nowrap text-slate-500">
                                {{ $log->created_at->isoFormat('D MMM Y, HH:mm:ss') }}
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                @if($log->user)
                                    <span class="font-bold text-slate-900">{{ $log->user->name }}</span>
                                    <span class="text-slate-400">({{ $log->user->username }})</span>
                                @else
                                    <span class="text-slate-400">Tamu / Sistem</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded text-[11px] font-semibold bg-slate-100 text-slate-800 border border-slate-200">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-800 font-sans text-xs">
                                {{ $log->description }}
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap text-slate-600">
                                {{ $log->ip_address ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-slate-400 font-sans">
                                Belum ada catatan aktivitas keamanan yang terekam.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
