@extends('layouts.panel')

@section('title', 'Pesan Masuk Humas')
@section('page-title', 'Kotak Masuk Pesan Humas')

@section('header-badge')
    @if($unreadCount > 0)
        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-900 border border-amber-300">
            {{ $unreadCount }} Pesan Baru
        </span>
    @else
        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-slate-100 text-slate-700 border border-slate-200">
            Semua Pesan Terbaca
        </span>
    @endif
@endsection

@section('header-actions')
    <a href="{{ route('panel.dashboard') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Kembali ke Dashboard</span>
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Filter Status & Search Bar -->
    <div class="rounded-xl bg-white border border-slate-200 p-4 shadow-xs">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Status Tabs -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1 md:pb-0">
                <a href="{{ route('panel.messages.index', array_merge(request()->except('status', 'page'), ['status' => 'all'])) }}"
                   class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors {{ ($status ?? 'all') === 'all' ? 'bg-amber-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Semua ({{ $totalCount }})
                </a>
                <a href="{{ route('panel.messages.index', array_merge(request()->except('status', 'page'), ['status' => 'unread'])) }}"
                   class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors {{ ($status ?? '') === 'unread' ? 'bg-amber-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Belum Dibaca ({{ $unreadCount }})
                </a>
                <a href="{{ route('panel.messages.index', array_merge(request()->except('status', 'page'), ['status' => 'read'])) }}"
                   class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors {{ ($status ?? '') === 'read' ? 'bg-amber-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Sudah Dibaca ({{ max(0, $totalCount - $unreadCount) }})
                </a>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('panel.messages.index') }}" class="flex items-center gap-2 max-w-md w-full">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <div class="relative flex-1">
                    <input type="text"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="Cari pengirim, surel, kontak, perihal..."
                           class="w-full pl-9 pr-3 py-1.5 rounded-lg border border-slate-300 text-xs focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button type="submit" class="px-3 py-1.5 rounded-lg bg-slate-900 text-white hover:bg-slate-800 text-xs font-semibold transition-colors flex-shrink-0">
                    Cari
                </button>
                @if(request('q'))
                    <a href="{{ route('panel.messages.index', request()->except('q', 'page')) }}" class="px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold transition-colors">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Messages List -->
    <div class="rounded-xl bg-white border border-slate-200 shadow-xs overflow-hidden">
        <div class="divide-y divide-slate-100">
            @forelse($messages as $msg)
                <div class="p-5 sm:p-6 hover:bg-slate-50 transition-colors {{ !$msg->is_read ? 'bg-amber-50/20' : '' }}">
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-3">
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                <span class="font-bold text-slate-900 text-base">{{ $msg->name }}</span>
                                @if(!$msg->is_read)
                                    <span class="px-2 py-0.5 text-[11px] font-bold rounded-full bg-amber-500 text-slate-950">
                                        Belum Dibaca
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 text-[11px] font-medium rounded-full bg-slate-100 text-slate-600">
                                        Sudah Dibaca
                                    </span>
                                @endif
                                <span class="text-xs text-slate-400">&bull; {{ $msg->created_at->isoFormat('D MMMM Y, HH:mm') }} WITA ({{ $msg->created_at->diffForHumans() }})</span>
                            </div>

                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1.5 text-xs text-slate-500">
                                <a href="mailto:{{ $msg->email }}" class="text-slate-700 hover:text-amber-700 hover:underline flex items-center gap-1 font-mono">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                                    {{ $msg->email }}
                                </a>

                                @if($msg->phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" rel="noopener" class="text-emerald-700 hover:underline flex items-center gap-1 font-mono font-medium">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                        {{ $msg->phone }}
                                    </a>
                                @endif

                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 font-medium">
                                    Perihal: {{ $msg->subject }}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2 self-start flex-shrink-0">
                            <a href="{{ route('panel.messages.show', $msg) }}" class="px-3 py-1.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition-colors">
                                Detail Lengkap
                            </a>

                            @if(!$msg->is_read)
                                <form method="POST" action="{{ route('panel.messages.read', $msg) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold transition-colors">
                                        Tandai Dibaca
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('panel.messages.unread', $msg) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 text-xs font-medium transition-colors">
                                        Tandai Belum Dibaca
                                    </button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('panel.messages.destroy', $msg) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini secara permanen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition-colors" title="Hapus Pesan">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Message Body Snippet -->
                    <div class="text-xs sm:text-sm text-slate-800 bg-slate-50 border border-slate-200/80 rounded-lg p-3.5 leading-relaxed font-sans whitespace-pre-line">
                        {{ $msg->message }}
                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-slate-500">
                    <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <div class="text-sm font-semibold text-slate-700">Tidak ada pesan kontak ditemukan</div>
                    <p class="text-xs text-slate-400 mt-1">
                        @if(request('q'))
                            Tidak ada pesan yang cocok dengan kata kunci pencarian "{{ request('q') }}".
                        @else
                            Kotak pesan Humas saat ini sedang kosong.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>

        @if($messages->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
