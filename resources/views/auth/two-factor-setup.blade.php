@extends('layouts.app', ['title' => 'Aktivasi Autentikasi Dua Faktor (2FA) - SMK Negeri 1 Denpasar'])

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-paper text-ink selection:bg-navy selection:text-paper">
    <div class="w-full max-w-xl bg-white p-8 sm:p-10 rounded-3xl border-2 border-ink shadow-xl">

        <div class="flex items-center justify-between gap-3 mb-6 pb-4 border-b border-line">
            <span class="px-3 py-1 rounded-md bg-navy text-paper text-xs font-extrabold uppercase tracking-widest">
                Keamanan Administrator
            </span>
            <span class="text-xs font-mono text-[#D97706] font-bold">Wajib Diaktifkan</span>
        </div>

        <h1 class="font-display font-extrabold text-2xl sm:text-3xl text-ink tracking-tight">
            Konfigurasi Google Authenticator (2FA)
        </h1>
        <p class="text-xs sm:text-sm text-ink-muted mt-2 leading-relaxed">
            Akun administrator memiliki wewenang tertinggi dan akses ke pemantau beban server. Pindai kode QR di bawah ini menggunakan aplikasi <strong>Google Authenticator</strong> atau <strong>1Password</strong> pada ponsel Anda.
        </p>

        @if($errors->any())
            <div class="mt-4 p-4 rounded-xl bg-rose-50 border-2 border-rose-500 text-rose-800 text-xs font-semibold">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif

        {{-- QR Code Display Box --}}
        <div class="my-6 p-6 rounded-2xl bg-paper border border-line flex flex-col items-center justify-center text-center">
            <div class="p-3 bg-white rounded-xl border border-line shadow-xs">
                {!! $qrCodeSvg !!}
            </div>

            <div class="mt-4 w-full">
                <span class="block text-[11px] font-mono text-ink-muted uppercase">Atau masukkan kunci rahasia manual:</span>
                <code class="block mt-1 p-2.5 rounded-lg bg-paper-2 border border-line font-mono font-bold text-xs text-navy tracking-widest select-all">
                    {{ $secret }}
                </code>
            </div>
        </div>

        {{-- Confirmation Form --}}
        <form action="{{ route('two-factor.setup.confirm') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="code" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1.5">
                    Masukkan 6-Digit Kode Verifikasi Pertama dari Aplikasi *
                </label>
                <input
                    id="code"
                    name="code"
                    type="text"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    maxlength="6"
                    required
                    autofocus
                    placeholder="Contoh: 123456"
                    class="w-full text-center px-4 py-3 rounded-xl bg-white border-2 border-line text-lg font-mono font-extrabold text-navy tracking-widest focus:outline-none focus:border-navy"
                >
            </div>

            <button
                type="submit"
                class="w-full py-3.5 px-6 rounded-xl bg-navy hover:bg-navy-700 text-paper font-display font-extrabold text-sm uppercase tracking-wider shadow-md hover:shadow-lg transition-all flex items-center justify-center cursor-pointer border-2 border-ink"
            >
                Verifikasi &amp; Simpan 2FA Sekarang &rarr;
            </button>
        </form>

        <form action="{{ route('logout') }}" method="POST" class="mt-4 text-center">
            @csrf
            <button type="submit" class="text-xs text-ink-muted hover:text-rose-600 transition-colors cursor-pointer">
                Keluar dari Sesi
            </button>
        </form>
    </div>
</div>
@endsection
