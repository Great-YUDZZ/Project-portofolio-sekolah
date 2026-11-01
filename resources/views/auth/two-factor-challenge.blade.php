@extends('layouts.app', ['title' => 'Verifikasi Dua Faktor - SMK Negeri 1 Denpasar'])

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-paper text-ink selection:bg-navy selection:text-paper">
    <div class="w-full max-w-md bg-white p-8 rounded-3xl border-2 border-ink shadow-xl">

        <div class="text-center mb-6">
            <div class="mx-auto w-14 h-14 rounded-2xl bg-[#071C3F] text-cyan-300 flex items-center justify-center font-display font-extrabold text-2xl border-2 border-ink shadow-sm mb-3">
                2FA
            </div>
            <h1 class="font-display font-extrabold text-2xl text-ink tracking-tight">
                Verifikasi Dua Faktor
            </h1>
            <p class="text-xs text-ink-muted mt-1 leading-relaxed">
                Buka aplikasi authenticator Anda dan masukkan kode 6-digit untuk melanjutkan ke Panel Administrator.
            </p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3.5 rounded-xl bg-rose-50 border-2 border-rose-500 text-rose-800 text-xs font-semibold">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('two-factor.challenge.verify') }}" method="POST" class="space-y-4" id="form-2fa">
            @csrf

            {{-- TOTP 6-digit mode (Separate digit boxes) --}}
            <div id="totp-container">
                <label class="block text-xs font-bold uppercase tracking-wider text-ink mb-3 text-center">
                    Kode 6-Digit Authenticator *
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
                <p class="text-[11px] text-center text-ink-muted mt-3">
                    Masukkan 6 digit angka dari aplikasi Authenticator
                </p>
            </div>

            {{-- Recovery Code mode (hidden by default) --}}
            <div id="recovery-container" class="hidden">
                <label for="recovery_code" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1.5 text-center">
                    Kode Pemulihan Darurat (10 Karakter) *
                </label>
                <input
                    id="recovery_code"
                    name="recovery_code"
                    type="text"
                    placeholder="XXXXXXXXXX"
                    class="w-full text-center px-4 py-3 rounded-xl bg-white border-2 border-line text-lg font-mono font-extrabold text-navy tracking-widest uppercase focus:outline-none focus:border-navy"
                >
            </div>

            <button
                type="submit"
                id="btn-submit-2fa"
                class="w-full py-3.5 px-6 rounded-xl bg-navy hover:bg-navy-700 text-paper font-display font-extrabold text-sm uppercase tracking-wider shadow-md hover:shadow-lg transition-all flex items-center justify-center cursor-pointer border-2 border-ink"
            >
                Konfirmasi Masuk &rarr;
            </button>
        </form>

        <div class="mt-6 pt-4 border-t border-line flex items-center justify-between text-xs">
            <button
                type="button"
                id="toggle-recovery"
                class="text-navy font-bold hover:underline cursor-pointer"
            >
                Gunakan Recovery Code
            </button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-ink-muted hover:text-rose-600 transition-colors cursor-pointer">
                    Batal Masuk
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const btnToggle = document.getElementById('toggle-recovery');
    const totpBox = document.getElementById('totp-container');
    const recBox = document.getElementById('recovery-container');
    const hiddenCode = document.getElementById('code');
    const recInput = document.getElementById('recovery_code');
    const otpBoxes = Array.from(document.querySelectorAll('.otp-box'));
    const form2fa = document.getElementById('form-2fa');

    let isRecovery = false;
    btnToggle?.addEventListener('click', () => {
        isRecovery = !isRecovery;
        if (isRecovery) {
            totpBox.classList.add('hidden');
            recBox.classList.remove('hidden');
            btnToggle.textContent = 'Gunakan Kode 6-Digit Authenticator';
            recInput.focus();
        } else {
            recBox.classList.add('hidden');
            totpBox.classList.remove('hidden');
            btnToggle.textContent = 'Gunakan Recovery Code';
            otpBoxes[0]?.focus();
        }
    });

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
                form2fa.submit();
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
                form2fa.submit();
            }
        });

        box.addEventListener('focus', () => {
            box.select();
        });
    });
</script>
@endsection
