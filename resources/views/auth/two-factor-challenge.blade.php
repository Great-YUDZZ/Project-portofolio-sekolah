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

            {{-- TOTP 6-digit mode --}}
            <div id="totp-container">
                <label for="code" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1.5 text-center">
                    Kode 6-Digit Authenticator *
                </label>
                <input
                    id="code"
                    name="code"
                    type="text"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    maxlength="6"
                    autofocus
                    placeholder="000000"
                    class="w-full text-center px-4 py-3 rounded-xl bg-white border-2 border-line text-2xl font-mono font-extrabold text-navy tracking-widest focus:outline-none focus:border-navy"
                >
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
    const codeInput = document.getElementById('code');
    const recInput = document.getElementById('recovery_code');

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
            codeInput.focus();
        }
    });
</script>
@endsection
