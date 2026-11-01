@extends('layouts.app', ['title' => 'Pendaftaran Akun Siswa Baru - SMK Negeri 1 Denpasar'])

@section('content')
<div class="min-h-screen flex flex-col lg:flex-row bg-paper text-ink selection:bg-navy selection:text-paper" data-login-stage>

    {{-- =====================================================================
         PANEL KIRI: PANDUAN PENDAFTARAN SISWA (NAVY BLUEPRINT)
         ===================================================================== --}}
    <aside class="relative w-full lg:w-5/12 bg-[#071C3F] text-paper border-b-2 lg:border-b-0 lg:border-r-2 border-ink p-8 sm:p-12 lg:p-16 flex flex-col justify-between overflow-hidden">
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none opacity-40"></div>
        <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none"></div>

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
                        Registrasi Portal Siswa
                    </span>
                </div>
            </a>
        </div>

        <div class="relative z-10 my-8 space-y-6">
            <span class="inline-block px-3 py-1 rounded-md bg-white/10 border border-white/15 text-xs font-mono uppercase tracking-widest text-[#D97706]">
                Ketentuan Akun Siswa
            </span>
            <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-white tracking-tight leading-snug">
                Satu Pintu Publikasi Kreativitas &amp; Kegiatan Siswa
            </h2>
            <ul class="space-y-4 text-xs sm:text-sm text-slate-300">
                <li class="flex items-start gap-3">
                    <span class="w-5 h-5 rounded-full bg-cyan-400 text-ink font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5">1</span>
                    <span>Gunakan <strong>Nomor Induk Siswa (NIS)</strong> resmi yang terdaftar di buku induk sekolah.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-5 h-5 rounded-full bg-cyan-400 text-ink font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5">2</span>
                    <span>Pilih <strong>Konsentrasi Keahlian Jurusan</strong> Anda dengan benar untuk memudahkan validasi oleh Ketua Program Keahlian.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-5 h-5 rounded-full bg-cyan-400 text-ink font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5">3</span>
                    <span>Setiap pendaftaran berstatus <strong>Menunggu Verifikasi</strong> dan akan disetujui langsung oleh guru jurusan atau admin.</span>
                </li>
            </ul>
        </div>

        <div class="relative z-10 pt-6 border-t border-white/10 flex items-center justify-between text-[11px] font-mono text-slate-400">
            <span>Verifikasi: Guru / Admin</span>
            <span>Status Awal: Pending</span>
        </div>
    </aside>

    {{-- =====================================================================
         PANEL KANAN: FORMULIR PENDAFTARAN SISWA (PAPER)
         ===================================================================== --}}
    <main class="w-full lg:w-7/12 flex items-center justify-center p-6 sm:p-12 lg:p-16 overflow-y-auto">
        <div class="w-full max-w-xl" data-form-card>

            <div class="mb-8" data-form-stagger>
                <div class="flex items-center justify-between gap-3 mb-2">
                    <span class="px-3 py-1 rounded-md bg-navy text-paper text-xs font-extrabold uppercase tracking-widest">
                        Pendaftaran Mandiri
                    </span>
                    <a href="{{ route('login') }}" class="text-xs font-bold text-navy hover:underline">
                        Sudah punya akun? Masuk &rarr;
                    </a>
                </div>
                <h1 class="font-display font-extrabold text-3xl text-ink tracking-tight">
                    Buat Akun Siswa Baru
                </h1>
                <p class="text-sm text-ink-muted mt-1 leading-relaxed">
                    Lengkapi identitas akademik Anda untuk mendapatkan akses mengirimkan artikel dan berita kegiatan.
                </p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border-2 border-rose-500 text-rose-800 text-xs font-semibold" data-login-error>
                    <span class="font-bold block mb-1">Periksa kembali isian pendaftaran Anda:</span>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="space-y-4" data-login-form>
                @csrf

                {{-- Anti-bot Honeypot field (hidden from real users) --}}
                <div class="hidden" aria-hidden="true">
                    <input type="text" name="institution_website_hp" tabindex="-1" autocomplete="off">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1">
                            Nama Lengkap Siswa *
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            required
                            value="{{ old('name') }}"
                            placeholder="Contoh: Gede Rama Wijaya"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-white border-2 border-line text-sm text-ink placeholder-ink-muted/50 focus:outline-none focus:border-navy"
                        >
                    </div>

                    {{-- NIS --}}
                    <div>
                        <label for="nis" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1">
                            Nomor Induk Siswa (NIS) *
                        </label>
                        <input
                            id="nis"
                            name="nis"
                            type="text"
                            required
                            value="{{ old('nis') }}"
                            placeholder="Contoh: 22001"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-white border-2 border-line text-sm text-ink placeholder-ink-muted/50 focus:outline-none focus:border-navy"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Konsentrasi Keahlian Jurusan --}}
                    <div>
                        <label for="major_id" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1">
                            Jurusan / Konsentrasi *
                        </label>
                        <select
                            id="major_id"
                            name="major_id"
                            required
                            class="w-full px-3.5 py-2.5 rounded-xl bg-white border-2 border-line text-sm text-ink focus:outline-none focus:border-navy"
                        >
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach($majors as $m)
                                <option value="{{ $m->id }}" {{ old('major_id') == $m->id ? 'selected' : '' }}>
                                    [{{ $m->code }}] {{ $m->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Rombongan Belajar (Kelas) --}}
                    <div>
                        <label for="classroom_id" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1">
                            Kelas Rombel (Opsional)
                        </label>
                        <select
                            id="classroom_id"
                            name="classroom_id"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-white border-2 border-line text-sm text-ink focus:outline-none focus:border-navy"
                        >
                            <option value="">-- Pilih Rombel --</option>
                            @foreach($classrooms as $c)
                                <option value="{{ $c->id }}" {{ old('classroom_id') == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }} (Tingkat {{ $c->grade_level }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-ink mb-1">
                            Jenis Kelamin *
                        </label>
                        <div class="flex items-center gap-4 pt-1.5">
                            <label class="inline-flex items-center gap-1.5 text-xs font-semibold text-ink cursor-pointer">
                                <input type="radio" name="gender" value="L" {{ old('gender', 'L') === 'L' ? 'checked' : '' }} class="text-navy">
                                <span>Laki-laki</span>
                            </label>
                            <label class="inline-flex items-center gap-1.5 text-xs font-semibold text-ink cursor-pointer">
                                <input type="radio" name="gender" value="P" {{ old('gender') === 'P' ? 'checked' : '' }} class="text-navy">
                                <span>Perempuan</span>
                            </label>
                        </div>
                    </div>

                    {{-- Email (Opsional) --}}
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1">
                            Surel (Opsional)
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="nama@siswa.id"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-white border-2 border-line text-sm text-ink placeholder-ink-muted/50 focus:outline-none focus:border-navy"
                        >
                    </div>

                    {{-- Nomor Telepon / WA --}}
                    <div>
                        <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1">
                            WhatsApp (Opsional)
                        </label>
                        <input
                            id="phone"
                            name="phone"
                            type="text"
                            value="{{ old('phone') }}"
                            placeholder="0812xxxxxxxx"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-white border-2 border-line text-sm text-ink placeholder-ink-muted/50 focus:outline-none focus:border-navy"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1">
                            Kata Sandi Baru *
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            placeholder="Minimal 10 karakter"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-white border-2 border-line text-sm text-ink placeholder-ink-muted/50 focus:outline-none focus:border-navy"
                        >
                        <span class="block text-[10px] text-ink-muted mt-0.5">Gabungan huruf dan angka, min 10 karakter.</span>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1">
                            Ulangi Kata Sandi *
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            placeholder="Ketik ulang kata sandi"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-white border-2 border-line text-sm text-ink placeholder-ink-muted/50 focus:outline-none focus:border-navy"
                        >
                    </div>
                </div>

                <div class="pt-4">
                    <button
                        type="submit"
                        data-submit-btn
                        class="w-full py-3.5 px-6 rounded-xl bg-navy hover:bg-navy-700 text-paper font-display font-extrabold text-sm uppercase tracking-wider shadow-md hover:shadow-lg transition-all flex items-center justify-center cursor-pointer border-2 border-ink"
                    >
                        <span data-submit-text>Ajukan Pendaftaran Siswa &rarr;</span>
                        <span data-submit-spinner class="hidden flex items-center gap-2">
                            <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span class="text-xs font-mono font-bold">MEMPROSES PENDAFTARAN...</span>
                        </span>
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-xs font-bold text-ink-muted hover:text-navy transition-colors">
                    &larr; Batalkan dan Kembali ke Halaman Masuk
                </a>
            </div>

        </div>
    </main>
</div>
@endsection
