@extends('layouts.app', ['title' => 'Gerbang Masuk Akun - SMK Negeri 1 Denpasar'])

@section('content')
<div class="min-h-screen flex flex-col lg:flex-row bg-paper text-ink selection:bg-navy selection:text-paper" data-login-stage>

    {{-- =====================================================================
         PANEL KIRI: NAVY BLUEPRINT & IDENTITAS INSTITUSIONAL (DESKTOP & TABLET)
         ===================================================================== --}}
    <aside class="relative w-full lg:w-5/12 bg-[#071C3F] text-paper border-b-2 lg:border-b-0 lg:border-r-2 border-ink p-8 sm:p-12 lg:p-16 flex flex-col justify-between overflow-hidden">
        {{-- Background Blueprint Grid & Accent Glow --}}
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none opacity-40"></div>
        <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

        {{-- Top Identity Branding --}}
        <div class="relative z-10">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group focus:outline-none focus:ring-2 focus:ring-cyan-300 rounded-xl p-1">
                <img
                    src="{{ asset('images/logo_emblem.png') }}"
                    alt="Logo SMKN 1 Denpasar"
                    class="w-12 h-12 object-contain rounded-xl bg-white/10 p-1 border-2 border-white/20 shadow-md group-hover:scale-105 transition-transform"
                >
                <div>
                    <span class="block font-display font-extrabold text-lg tracking-tight text-white group-hover:text-cyan-300 transition-colors">
                        SMK Negeri 1 Denpasar
                    </span>
                    <span class="block text-[11px] font-mono uppercase tracking-widest text-cyan-300">
                        Pusat Keunggulan Vokasi
                    </span>
                </div>
            </a>
        </div>

        {{-- Middle: Animated Blueprint Architectural Illustration (SVG Draw) --}}
        <div class="relative z-10 my-8 lg:my-auto flex flex-col items-center">
            <svg
                data-blueprint-svg
                viewBox="0 0 460 260"
                class="w-full max-w-md h-auto text-cyan-300 drop-shadow-md"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
            >
                {{-- Base Horizon & Ground Lines --}}
                <line x1="20" y1="230" x2="440" y2="230" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-opacity="0.8"/>
                <line x1="10" y1="238" x2="450" y2="238" stroke="currentColor" stroke-width="1" stroke-dasharray="4 4" stroke-opacity="0.4"/>

                {{-- Landmark Gate & Portal Pilars --}}
                <rect x="70" y="110" width="36" height="120" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <rect x="110" y="90" width="28" height="140" stroke="currentColor" stroke-width="2"/>
                <rect x="322" y="90" width="28" height="140" stroke="currentColor" stroke-width="2"/>
                <rect x="354" y="110" width="36" height="120" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>

                {{-- Central Arch & Roof Portal --}}
                <path d="M110 90 L230 40 L350 90 Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M138 90 L230 52 L322 90" stroke="#D97706" stroke-width="2" stroke-linecap="round"/>
                <circle cx="230" cy="115" r="26" stroke="#67E8F9" stroke-width="2"/>
                <path d="M230 95 L230 135 M210 115 L250 115" stroke="#67E8F9" stroke-width="1.5" stroke-dasharray="2 2"/>

                {{-- Workshop Windows & Perspective Grid --}}
                <line x1="148" y1="150" x2="312" y2="150" stroke="currentColor" stroke-width="1.5" stroke-opacity="0.6"/>
                <line x1="148" y1="180" x2="312" y2="180" stroke="currentColor" stroke-width="1.5" stroke-opacity="0.6"/>
                <line x1="148" y1="210" x2="312" y2="210" stroke="currentColor" stroke-width="1.5" stroke-opacity="0.6"/>
                <line x1="185" y1="150" x2="185" y2="230" stroke="currentColor" stroke-width="1.5" stroke-opacity="0.6"/>
                <line x1="230" y1="145" x2="230" y2="230" stroke="currentColor" stroke-width="2" stroke-opacity="0.8"/>
                <line x1="275" y1="150" x2="275" y2="230" stroke="currentColor" stroke-width="1.5" stroke-opacity="0.6"/>

                {{-- Architectural Dimension Ticks --}}
                <path d="M40 70 L40 230 M35 70 L45 70 M35 230 L45 230" stroke="currentColor" stroke-width="1" stroke-opacity="0.5"/>
                <path d="M70 250 L390 250 M70 245 L70 255 M390 245 L390 255" stroke="currentColor" stroke-width="1" stroke-opacity="0.5"/>
            </svg>

            <div class="mt-4 text-center">
                <p class="text-xs text-slate-300 mt-2 max-w-sm italic">
                    &ldquo;Abhyāsad Dhäryate Vidyä&rdquo; : Peliharalah ilmu sampai menjadi tradisi.
                </p>
            </div>
        </div>

        {{-- Bottom Clean Footer --}}
        <div class="relative z-10 pt-6 border-t border-white/10 flex items-center justify-between text-[11px] font-mono text-slate-400">
            <span>SMK Negeri 1 Denpasar</span>
            <span>&copy; {{ date('Y') }}</span>
        </div>
    </aside>

    {{-- =====================================================================
         PANEL KANAN: FORM MASUK TAKTIL & MINIMALIS (PAPER)
         ===================================================================== --}}
    <main class="w-full lg:w-7/12 flex items-center justify-center p-6 sm:p-12 lg:p-16">
        <div class="w-full max-w-lg" data-form-card>

            {{-- Form Header --}}
            <div class="mb-8" data-form-stagger>
                <div class="flex items-center justify-between gap-3 mb-2">
                    <span class="px-3 py-1 rounded-md bg-navy text-paper text-xs font-extrabold uppercase tracking-widest">
                        Portal Otentikasi
                    </span>
                    <a href="{{ route('home') }}" class="text-xs font-bold text-ink-muted hover:text-navy transition-colors">
                        &larr; Halaman Publik
                    </a>
                </div>
                <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-ink tracking-tight mt-1">
                    Masuk ke Panel Skensa
                </h1>
                <p class="text-sm text-ink-muted mt-2 leading-relaxed">
                    Satu gerbang masuk untuk Administrator, Guru Produktif 12 Jurusan, dan Siswa SMKN 1 Denpasar.
                </p>
            </div>

            {{-- Feedback Alert Notifications --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border-2 border-emerald-500 text-emerald-800 text-xs font-semibold flex items-start gap-3" data-form-stagger>
                    <span class="font-bold text-sm leading-none mt-0.5">&check;</span>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('warning'))
                <div class="mb-6 p-4 rounded-xl bg-amber-50 border-2 border-[#D97706] text-[#D97706] text-xs font-semibold flex items-start gap-3" data-form-stagger>
                    <span class="font-bold text-sm leading-none mt-0.5">&excl;</span>
                    <div>{{ session('warning') }}</div>
                </div>
            @endif

            @if(session('error') || $errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border-2 border-rose-500 text-rose-800 text-xs font-semibold flex items-start gap-3" data-login-error data-form-stagger>
                    <span class="font-bold text-sm leading-none mt-0.5">&times;</span>
                    <div>
                        @if(session('error'))
                            <p>{{ session('error') }}</p>
                        @endif
                        @foreach($errors->all() as $err)
                            <p>{{ $err }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Main Login Form --}}
            <form action="{{ route('login.post') }}" method="POST" class="space-y-5" data-login-form>
                @csrf

                {{-- Input Identitas (NIS / NIP / Username / Email) --}}
                <div data-form-stagger>
                    <label for="username" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1.5">
                        NIS / NIP / Nama Pengguna / Surel *
                    </label>
                    <div class="relative">
                        <input
                            id="username"
                            name="username"
                            type="text"
                            autocomplete="username"
                            required
                            autofocus
                            value="{{ old('username') }}"
                            placeholder="Contoh: 22001 (Siswa) atau admin"
                            class="w-full px-4 py-3 rounded-xl bg-white border-2 border-line text-sm text-ink placeholder-ink-muted/50 focus:outline-none focus:border-navy focus:ring-0 transition-colors font-medium @error('username') border-rose-500 @enderror"
                        >
                    </div>
                    <span class="block text-[11px] text-ink-muted mt-1">
                        Siswa menggunakan NIS, Guru menggunakan NIP atau Username.
                    </span>
                </div>

                {{-- Input Kata Sandi with Toggle Show/Hide --}}
                <div data-form-stagger>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-ink">
                            Kata Sandi *
                        </label>
                        <span class="text-[11px] text-ink-muted">
                            Min. 6 karakter
                        </span>
                    </div>
                    <div class="relative">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required
                            placeholder="Masukkan kata sandi akun Anda"
                            class="w-full pl-4 pr-12 py-3 rounded-xl bg-white border-2 border-line text-sm text-ink placeholder-ink-muted/50 focus:outline-none focus:border-navy focus:ring-0 transition-colors font-medium @error('password') border-rose-500 @enderror"
                        >
                        <button
                            type="button"
                            data-toggle-password
                            class="absolute inset-y-0 right-0 px-3.5 flex items-center text-ink-muted hover:text-navy cursor-pointer focus:outline-none"
                            aria-label="Tampilkan atau sembunyikan kata sandi"
                        >
                            <svg data-icon-show class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg data-icon-hide class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember Session & Help Link --}}
                <div class="flex items-center justify-between pt-1" data-form-stagger>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-2 border-line text-navy focus:ring-navy cursor-pointer"
                        >
                        <span class="text-xs font-semibold text-ink-muted">Ingat sesi perangkat ini</span>
                    </label>
                    <span class="text-xs text-ink-muted">
                        Bantuan: <a href="mailto:fo@smkn1denpasar.sch.id" class="text-navy font-bold hover:underline">Humas Skensa</a>
                    </span>
                </div>

                {{-- Submit Button with Morphing Spinner --}}
                <div class="pt-2" data-form-stagger>
                    <button
                        type="submit"
                        data-submit-btn
                        class="relative w-full py-3.5 px-6 rounded-xl bg-navy hover:bg-navy-700 text-paper font-display font-extrabold text-sm uppercase tracking-wider shadow-md hover:shadow-lg transition-all flex items-center justify-center cursor-pointer border-2 border-ink"
                    >
                        <span data-submit-text>Masuk ke Panel Sekarang &rarr;</span>
                        <span data-submit-spinner class="hidden absolute inset-0 flex items-center justify-center gap-2">
                            <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span class="text-xs font-mono font-bold tracking-wider">MEMVERIFIKASI...</span>
                        </span>
                    </button>
                </div>
            </form>

            {{-- Link to Siswa Registration --}}
            <div class="mt-6 p-4 rounded-xl bg-paper-2 border border-line flex flex-col sm:flex-row items-center justify-between gap-3" data-form-stagger>
                <div>
                    <span class="block text-xs font-bold text-ink">Belum Memiliki Akun Siswa?</span>
                    <span class="block text-[11px] text-ink-muted">Daftarkan diri menggunakan NIS Anda untuk mengirimkan berita kegiatan sekolah.</span>
                </div>
                <a
                    href="{{ route('register') }}"
                    class="shrink-0 px-4 py-2 rounded-lg bg-white border-2 border-ink text-navy hover:bg-navy hover:text-white text-xs font-extrabold uppercase tracking-wider transition-colors"
                >
                    Daftar Siswa
                </a>
            </div>

        </div>
    </main>
</div>
@endsection
