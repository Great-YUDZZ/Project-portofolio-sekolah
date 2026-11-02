@extends('layouts.panel')

@section('title', 'Detail Pesan: ' . $message->subject)
@section('page-title', 'Detail Pesan Humas')

@section('header-badge')
    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700 border border-slate-200">
        ID Pesan: #{{ $message->id }}
    </span>
@endsection

@section('header-actions')
    <a href="{{ route('panel.messages.index') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Kembali ke Kotak Masuk</span>
    </a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Sender & Overview Card -->
    <div class="rounded-xl bg-white border border-slate-200 p-6 shadow-xs">
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-6 pb-6 border-b border-slate-100">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2.5 py-1 text-xs font-bold rounded-full {{ $message->is_read ? 'bg-slate-100 text-slate-600' : 'bg-amber-500 text-slate-950' }}">
                        {{ $message->is_read ? 'Sudah Dibaca' : 'Pesan Baru' }}
                    </span>
                    <span class="text-xs text-slate-400">Diterima pada {{ $message->created_at->isoFormat('dddd, D MMMM Y - HH:mm') }} WITA</span>
                </div>
                <h2 class="text-xl font-bold text-slate-900">{{ $message->subject }}</h2>
            </div>

            <!-- Reply Direct Actions -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="mailto:{{ $message->email }}?subject=Re:%20{{ rawurlencode($message->subject) }}&body=Yth.%20{{ rawurlencode($message->name) }},%0D%0A%0D%0AMenanggapi%20pesan%20Anda%20ke%20Humas%20SMK%20Negeri%201%20Denpasar...%0D%0A"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Balas Surel (Email)</span>
                </a>

                @if($message->phone)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}?text=Halo%20{{ rawurlencode($message->name) }},%20kami%20dari%20tim%20Humas%20SMK%20Negeri%201%20Denpasar%20menindaklanjuti%20pesan%20Anda..."
                       target="_blank"
                       rel="noopener"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold shadow-xs transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>Hubungi via WhatsApp</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- Sender Meta Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-6 text-xs">
            <div class="p-3.5 rounded-lg bg-slate-50 border border-slate-100">
                <div class="text-slate-400 font-semibold mb-1 uppercase tracking-wider text-[10px]">Nama Pengirim</div>
                <div class="text-slate-900 font-bold text-sm">{{ $message->name }}</div>
            </div>

            <div class="p-3.5 rounded-lg bg-slate-50 border border-slate-100">
                <div class="text-slate-400 font-semibold mb-1 uppercase tracking-wider text-[10px]">Alamat Surel (Email)</div>
                <div class="text-slate-900 font-bold font-mono">
                    <a href="mailto:{{ $message->email }}" class="text-amber-700 hover:underline">
                        {{ $message->email }}
                    </a>
                </div>
            </div>

            <div class="p-3.5 rounded-lg bg-slate-50 border border-slate-100">
                <div class="text-slate-400 font-semibold mb-1 uppercase tracking-wider text-[10px]">Nomor Telepon / WhatsApp</div>
                <div class="text-slate-900 font-bold font-mono">
                    @if($message->phone)
                        <a href="tel:{{ $message->phone }}" class="text-slate-900 hover:text-emerald-700">
                            {{ $message->phone }}
                        </a>
                    @else
                        <span class="text-slate-400 font-normal italic">Tidak dicantumkan</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Message Body Container -->
    <div class="rounded-xl bg-white border border-slate-200 p-6 sm:p-8 shadow-xs space-y-4">
        <div class="text-xs uppercase tracking-wider text-slate-400 font-bold">Isi Pesan Lengkap</div>
        <div class="text-sm md:text-base text-slate-800 leading-relaxed font-sans whitespace-pre-line bg-slate-50 p-6 rounded-xl border border-slate-200">
            {{ $message->message }}
        </div>
    </div>

    <!-- Management Controls Bar -->
    <div class="rounded-xl bg-white border border-slate-200 p-4 shadow-xs flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            @if($message->is_read)
                <form method="POST" action="{{ route('panel.messages.unread', $message) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-3 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                        Tandai Belum Dibaca
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('panel.messages.read', $message) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-3 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold transition-colors">
                        Tandai Sudah Dibaca
                    </button>
                </form>
            @endif
        </div>

        <form method="POST" action="{{ route('panel.messages.destroy', $message) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini secara permanen?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                <span>Hapus Pesan</span>
            </button>
        </form>
    </div>
</div>
@endsection
