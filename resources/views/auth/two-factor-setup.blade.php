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
        <form action="{{ route('two-factor.setup.confirm') }}" method="POST" class="space-y-4" id="form-2fa-setup">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-ink mb-3 text-center">
                    Masukkan 6-Digit Kode Verifikasi Pertama dari Aplikasi *
                </label>

                <input type="hidden" id="code" name="code" value="">

                <div class="flex items-center justify-center gap-2 sm:gap-3" id="otp-wrapper">
                    <input
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        maxlength="1"
                        data-otp-idx="0"
                        class="otp-box w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl sm:text-3xl font-mono font-extrabold text-navy bg-white border-2 border-line rounded-xl shadow-xs focus:outline-none focus:border-navy focus:ring-4 focus:ring-navy/10 transition-all"
                        autocomplete="one-time-code"
                        autofocus
                    >
                    <input
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        maxlength="1"
                        data-otp-idx="1"
                        class="otp-box w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl sm:text-3xl font-mono font-extrabold text-navy bg-white border-2 border-line rounded-xl shadow-xs focus:outline-none focus:border-navy focus:ring-4 focus:ring-navy/10 transition-all"
                        autocomplete="off"
                    >
                    <input
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        maxlength="1"
                        data-otp-idx="2"
                        class="otp-box w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl sm:text-3xl font-mono font-extrabold text-navy bg-white border-2 border-line rounded-xl shadow-xs focus:outline-none focus:border-navy focus:ring-4 focus:ring-navy/10 transition-all"
                        autocomplete="off"
                    >
                    <span class="text-slate-300 font-bold text-lg select-none">&bull;</span>
                    <input
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        maxlength="1"
                        data-otp-idx="3"
                        class="otp-box w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl sm:text-3xl font-mono font-extrabold text-navy bg-white border-2 border-line rounded-xl shadow-xs focus:outline-none focus:border-navy focus:ring-4 focus:ring-navy/10 transition-all"
                        autocomplete="off"
                    >
                    <input
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        maxlength="1"
                        data-otp-idx="4"
                        class="otp-box w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl sm:text-3xl font-mono font-extrabold text-navy bg-white border-2 border-line rounded-xl shadow-xs focus:outline-none focus:border-navy focus:ring-4 focus:ring-navy/10 transition-all"
                        autocomplete="off"
                    >
                    <input
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        maxlength="1"
                        data-otp-idx="5"
                        class="otp-box w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl sm:text-3xl font-mono font-extrabold text-navy bg-white border-2 border-line rounded-xl shadow-xs focus:outline-none focus:border-navy focus:ring-4 focus:ring-navy/10 transition-all"
                        autocomplete="off"
                    >
                </div>
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

<script>
    const hiddenCode = document.getElementById('code');
    const otpBoxes = Array.from(document.querySelectorAll('.otp-box'));
    const formSetup = document.getElementById('form-2fa-setup');

    function syncHiddenCode() {
        const fullVal = otpBoxes.map(b => b.value).join('');
        if (hiddenCode) hiddenCode.value = fullVal;
        return fullVal;
    }

    otpBoxes.forEach((box, idx) => {
        box.addEventListener('input', (e) => {
            const val = box.value.replace(/[^0-9]/g, '');
            box.value = val ? val[val.length - 1] : '';

            const full = syncHiddenCode();
            if (box.value && idx < otpBoxes.length - 1) {
                otpBoxes[idx + 1].focus();
            }

            if (full.length === 6) {
                formSetup.submit();
            }
        });

        box.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace') {
                if (!box.value && idx > 0) {
                    otpBoxes[idx - 1].focus();
                    otpBoxes[idx - 1].value = '';
                    syncHiddenCode();
                    e.preventDefault();
                } else {
                    box.value = '';
                    syncHiddenCode();
                }
            } else if (e.key === 'ArrowLeft' && idx > 0) {
                otpBoxes[idx - 1].focus();
            } else if (e.key === 'ArrowRight' && idx < otpBoxes.length - 1) {
                otpBoxes[idx + 1].focus();
            }
        });

        box.addEventListener('paste', (e) => {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text');
            const cleanDigits = text.replace(/[^0-9]/g, '').slice(0, 6);

            cleanDigits.split('').forEach((digit, i) => {
                if (otpBoxes[i]) {
                    otpBoxes[i].value = digit;
                }
            });

            const full = syncHiddenCode();
            const nextIdx = Math.min(cleanDigits.length, otpBoxes.length - 1);
            otpBoxes[nextIdx]?.focus();

            if (full.length === 6) {
                formSetup.submit();
            }
        });

        box.addEventListener('focus', () => {
            box.select();
        });
    });
</script>
@endsection
