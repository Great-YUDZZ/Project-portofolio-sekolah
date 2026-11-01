@extends('layouts.public')

@section('title', $major->name . ' (' . $major->code . ') - SMK Negeri 1 Denpasar')

@section('content')

    {{-- ===================================================================== --}}
    {{-- 1. HERO HEADER: IDENTITAS JURUSAN & KAPROGLI                          --}}
    {{-- ===================================================================== --}}
    <section class="relative bg-[#071C3F] text-white border-b-2 border-line py-16 sm:py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.07] pointer-events-none" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-reveal>
            {{-- Breadcrumb Navigation --}}
            <nav class="flex flex-wrap items-center gap-2 text-xs font-mono font-bold uppercase tracking-wider mb-4" aria-label="Breadcrumb">
                <a href="{{ route('majors.index') }}" class="text-cyan-300 hover:underline">
                    Katalog Jurusan
                </a>
                <span class="text-white/40">/</span>
                <span class="text-slate-300">{{ $major->field?->name }}</span>
                <span class="text-white/40">/</span>
                <span class="text-white font-extrabold">{{ $major->code }}</span>
            </nav>

            <div class="mt-4 flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                <div class="max-w-4xl">
                    <div class="flex flex-wrap items-center gap-2.5 mb-3">
                        <span class="inline-block px-3 py-1 rounded-md bg-white text-[#071C3F] text-xs font-mono font-extrabold uppercase tracking-wider shadow-xs">
                            Kode: {{ $major->code }}
                        </span>
                        <span class="inline-block px-3 py-1 rounded-md bg-white/10 border border-white/15 text-slate-200 text-xs font-mono uppercase tracking-wider">
                            Akreditasi A BAN-SM
                        </span>
                        <span class="inline-block px-3 py-1 rounded-md bg-white/10 border border-white/15 text-slate-200 text-xs font-mono uppercase tracking-wider">
                            Kurikulum Merdeka Vokasi
                        </span>
                    </div>

                    <h1 class="font-display font-extrabold text-3xl sm:text-5xl lg:text-6xl text-white tracking-tight leading-[1.1]">
                        {{ $major->name }}
                    </h1>
                    <p class="text-slate-300 text-base sm:text-lg max-w-3xl mt-4 leading-relaxed">
                        {{ $major->summary }}
                    </p>
                </div>

                {{-- Kaprogli Information Card --}}
                @if($major->head_of_major)
                    <div class="p-5 rounded-2xl bg-white/[0.08] border border-white/15 backdrop-blur-xs shrink-0 lg:max-w-xs w-full">
                        <span class="text-[11px] font-mono font-bold uppercase tracking-widest text-cyan-300 block mb-1">
                            Ketua Program Keahlian
                        </span>
                        <div class="font-display font-bold text-lg text-white">
                            {{ $major->head_of_major }}
                        </div>
                        <div class="flex items-center gap-3 mt-3 pt-3 border-t border-white/10 text-xs font-mono text-slate-300">
                            <span>{{ $major->classrooms->count() }} Rombel Aktif</span>
                            <span>•</span>
                            <span>LSP-P1 BNSP</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- 2. WORKSPACE LAYOUT: STICKY QUICK-JUMP SIDEBAR & CONTENT STREAM       --}}
    {{-- ===================================================================== --}}
    <section class="py-14 sm:py-20 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- ----------------------------------------------------------------- --}}
            {{-- STICKY QUICK-JUMP SIDEBAR (4 Kolom Desktop)                       --}}
            {{-- ----------------------------------------------------------------- --}}
            <aside class="lg:col-span-4 relative self-stretch">
                <div class="lg:sticky lg:top-24 space-y-6 max-h-[calc(100vh-7rem)] overflow-y-auto no-scrollbar pb-6">

                    {{-- Table of Contents Card --}}
                    <div class="p-6 rounded-3xl bg-paper-2 border border-line shadow-xs">
                        <span class="text-[11px] font-mono font-bold uppercase tracking-widest text-navy block mb-4">
                            Navigasi Cepat Kejuruan:
                        </span>

                        <nav class="space-y-1.5 text-xs font-semibold" aria-label="Daftar Isi Jurusan" id="major-toc-nav">
                            <a
                                href="#seksi-kompetensi"
                                data-major-toc-link
                                class="flex items-center justify-between p-3 rounded-xl border border-transparent transition-all group text-ink hover:bg-paper"
                            >
                                <span class="flex items-center gap-2.5">
                                    <span data-toc-badge class="font-mono text-ink-muted transition-colors">01.</span>
                                    <span data-toc-text class="text-ink transition-colors">Profil &amp; Filosofi Kompetensi</span>
                                </span>
                                <span data-toc-arrow class="text-ink-muted transition-all group-hover:translate-x-0.5">&rarr;</span>
                            </a>

                            <a
                                href="#seksi-kurikulum"
                                data-major-toc-link
                                class="flex items-center justify-between p-3 rounded-xl border border-transparent transition-all group text-ink hover:bg-paper"
                            >
                                <span class="flex items-center gap-2.5">
                                    <span data-toc-badge class="font-mono text-ink-muted transition-colors">02.</span>
                                    <span data-toc-text class="text-ink transition-colors">Struktur Kurikulum Merdeka</span>
                                </span>
                                <span data-toc-arrow class="text-ink-muted transition-all group-hover:translate-x-0.5">&rarr;</span>
                            </a>

                            <a
                                href="#seksi-laboratorium"
                                data-major-toc-link
                                class="flex items-center justify-between p-3 rounded-xl border border-transparent transition-all group text-ink hover:bg-paper"
                            >
                                <span class="flex items-center gap-2.5">
                                    <span data-toc-badge class="font-mono text-ink-muted transition-colors">03.</span>
                                    <span data-toc-text class="text-ink transition-colors">Bengkel &amp; Lab Praktik</span>
                                </span>
                                <span data-toc-arrow class="text-ink-muted transition-all group-hover:translate-x-0.5">&rarr;</span>
                            </a>

                            <a
                                href="#seksi-sertifikasi"
                                data-major-toc-link
                                class="flex items-center justify-between p-3 rounded-xl border border-transparent transition-all group text-ink hover:bg-paper"
                            >
                                <span class="flex items-center gap-2.5">
                                    <span data-toc-badge class="font-mono text-ink-muted transition-colors">04.</span>
                                    <span data-toc-text class="text-ink transition-colors">Sertifikasi BNSP LSP-P1</span>
                                </span>
                                <span data-toc-arrow class="text-ink-muted transition-all group-hover:translate-x-0.5">&rarr;</span>
                            </a>

                            <a
                                href="#seksi-karir"
                                data-major-toc-link
                                class="flex items-center justify-between p-3 rounded-xl border border-transparent transition-all group text-ink hover:bg-paper"
                            >
                                <span class="flex items-center gap-2.5">
                                    <span data-toc-badge class="font-mono text-ink-muted transition-colors">05.</span>
                                    <span data-toc-text class="text-ink transition-colors">Prospek Karir &amp; Lulusan</span>
                                </span>
                                <span data-toc-arrow class="text-ink-muted transition-all group-hover:translate-x-0.5">&rarr;</span>
                            </a>

                            <a
                                href="#seksi-mitra-karya"
                                data-major-toc-link
                                class="flex items-center justify-between p-3 rounded-xl border border-transparent transition-all group text-ink hover:bg-paper"
                            >
                                <span class="flex items-center gap-2.5">
                                    <span data-toc-badge class="font-mono text-ink-muted transition-colors">06.</span>
                                    <span data-toc-text class="text-ink transition-colors">Mitra DUDIKA &amp; Portofolio</span>
                                </span>
                                <span data-toc-arrow class="text-ink-muted transition-all group-hover:translate-x-0.5">&rarr;</span>
                            </a>
                        </nav>
                    </div>

                    {{-- Card Konsultasi Jurusan --}}
                    <div class="p-6 rounded-3xl bg-navy text-white border border-line shadow-xs">
                        <span class="text-[11px] font-mono font-bold uppercase tracking-widest text-cyan-300 block mb-2">
                            Penerimaan Peserta Didik Baru
                        </span>
                        <h3 class="font-display font-extrabold text-lg text-white">
                            Tertarik Memilih Jurusan {{ $major->code }}?
                        </h3>
                        <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                            Dapatkan informasi lengkap persyaratan masuk, daya tampung rombongan belajar, dan jalur pendaftaran melalui layanan Humas sekolah.
                        </p>
                        <a
                            href="{{ route('contact.index') }}"
                            class="inline-flex items-center justify-center w-full mt-4 px-4 py-2.5 rounded-xl bg-white hover:bg-slate-100 text-[#071C3F] font-bold text-xs uppercase tracking-wider transition-colors shadow-xs"
                        >
                            Hubungi Layanan Humas &rarr;
                        </a>
                    </div>

                    {{-- Daftar Jurusan Lainnya --}}
                    <div class="p-6 rounded-3xl bg-paper-2 border border-line shadow-xs">
                        <span class="text-[11px] font-mono font-bold uppercase tracking-widest text-navy block mb-3">
                            Konsentrasi Keahlian Lain:
                        </span>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($otherMajors as $other)
                                <a
                                    href="{{ route('majors.show', $other->slug) }}"
                                    class="px-2.5 py-1.5 rounded-lg bg-paper border border-line text-xs font-mono font-bold text-ink hover:text-navy hover:border-navy transition-colors"
                                >
                                    {{ $other->code }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </aside>

            {{-- ----------------------------------------------------------------- --}}
            {{-- CONTENT STREAM (8 Kolom Desktop)                                  --}}
            {{-- ----------------------------------------------------------------- --}}
            <div class="lg:col-span-8 space-y-16">

                @php
                    $majorShowcasePhotos = [
                        'TKJ'   => '/images/showcase/lab_fiber.jpg',
                        'TKP'   => '/images/showcase/ukk_2026.jpg',
                        'DPIB'  => '/images/showcase/ukk_2026.jpg',
                        'TPTUP' => '/images/showcase/daikin_coe.jpg',
                        'RPL'   => '/images/showcase/lks_2026.jpg',
                        'DKV'   => '/images/showcase/pengalaman_belajar.jpg',
                        'PRF'   => '/images/showcase/pengalaman_belajar.jpg',
                        'TP'    => '/images/showcase/ukk_2026.jpg',
                        'TPM'   => '/images/showcase/ukk_2026.jpg',
                        'TKR'   => '/images/showcase/ukk_2026.jpg',
                        'TITL'  => '/images/showcase/daikin_coe.jpg',
                        'TEDK'  => '/images/showcase/lab_fiber.jpg',
                        'TKRO'  => '/images/showcase/ukk_2026.jpg',
                    ];
                    $majorPhoto = $major->hero_image ?: ($majorShowcasePhotos[strtoupper($major->code)] ?? '/images/showcase/drone_kampus.jpg');
                @endphp

                {{-- ============================================================= --}}
                {{-- SEKSI 1: PROFIL & FILOSOFI KOMPETENSI                         --}}
                {{-- ============================================================= --}}
                <section id="seksi-kompetensi" class="scroll-mt-28" data-reveal>
                    <div class="rounded-3xl bg-paper-2/70 border border-line overflow-hidden shadow-xs">
                        {{-- Photo Showcase --}}
                        <div class="relative aspect-video bg-navy border-b border-line overflow-hidden">
                            <img
                                src="{{ $majorPhoto }}"
                                alt="Dokumentasi Praktik Kejuruan {{ $major->name }} ({{ $major->code }}) SMK Negeri 1 Denpasar"
                                class="w-full h-full object-cover"
                            >
                            <span class="absolute top-4 left-4 px-3 py-1 rounded-md bg-navy/90 text-white text-xs font-mono font-extrabold uppercase tracking-wider border border-white/20">
                                Dokumentasi Sarana {{ $major->code }}
                            </span>
                        </div>

                        {{-- Body Content --}}
                        <div class="p-6 sm:p-8 space-y-6">
                            <div>
                                <span class="text-xs font-mono font-bold uppercase tracking-widest text-navy block mb-2">
                                    01. Profil &amp; Filosofi Kejuruan
                                </span>
                                <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-ink">
                                    Mengenal Konsentrasi Keahlian {{ $major->name }}
                                </h2>
                            </div>

                            <div class="text-ink-muted text-sm sm:text-base leading-relaxed space-y-4">
                                <p>{{ $major->description ?: $major->summary }}</p>
                            </div>

                            @if($major->vision_mission)
                                <div class="p-5 rounded-2xl bg-paper border border-line">
                                    <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-navy block mb-2">
                                        Fokus Unggulan Kejuruan:
                                    </span>
                                    <p class="text-sm text-ink leading-relaxed font-medium">
                                        {{ $major->vision_mission }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>

                {{-- ============================================================= --}}
                {{-- SEKSI 2: STRUKTUR KURIKULUM MERDEKA VOKASI                    --}}
                {{-- ============================================================= --}}
                <section id="seksi-kurikulum" class="scroll-mt-28" data-reveal>
                    <div class="p-6 sm:p-8 rounded-3xl bg-paper-2/70 border border-line shadow-xs space-y-6">
                        <div>
                            <span class="text-xs font-mono font-bold uppercase tracking-widest text-navy block mb-2">
                                02. Struktur Kurikulum
                            </span>
                            <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-ink">
                                Kurikulum Merdeka Berbasis Industri Riil
                            </h2>
                            <p class="text-sm text-ink-muted mt-2 leading-relaxed">
                                Pembelajaran dirancang selaras dengan skema okupasi industri modern, memadukan teori fundamental dengan 70% porsi jam praktik di bengkel dan laboratorium.
                            </p>
                        </div>

                        {{-- Fase E vs Fase F --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                            {{-- Fase E --}}
                            <div class="p-6 rounded-2xl bg-paper border border-line flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between gap-2 mb-3">
                                        <span class="px-2.5 py-0.5 rounded bg-navy text-white text-[11px] font-mono font-bold uppercase tracking-wider">
                                            Fase E (Kelas X)
                                        </span>
                                        <span class="text-xs font-mono text-ink-muted">Dasar Kejuruan</span>
                                    </div>
                                    <h3 class="font-display font-bold text-lg text-ink mb-3">
                                        Pondasi Teknis &amp; Budaya Industri
                                    </h3>
                                    <ul class="space-y-2.5 text-xs text-ink leading-relaxed">
                                        @foreach($enrichedData['fase_e'] as $modul)
                                            <li class="flex items-start gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full bg-navy mt-1.5 shrink-0"></span>
                                                <span>{{ $modul }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            {{-- Fase F --}}
                            <div class="p-6 rounded-2xl bg-paper border border-line flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between gap-2 mb-3">
                                        <span class="px-2.5 py-0.5 rounded bg-blue-600 text-white text-[11px] font-mono font-bold uppercase tracking-wider">
                                            Fase F (Kelas XI - XII)
                                        </span>
                                        <span class="text-xs font-mono text-ink-muted">Keahlian Spesifik</span>
                                    </div>
                                    <h3 class="font-display font-bold text-lg text-ink mb-3">
                                        Konsentrasi &amp; Teaching Factory
                                    </h3>
                                    <ul class="space-y-2.5 text-xs text-ink leading-relaxed">
                                        @foreach($enrichedData['fase_f'] as $modul)
                                            <li class="flex items-start gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 mt-1.5 shrink-0"></span>
                                                <span>{{ $modul }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Kompetensi Tambahan --}}
                        @if(!empty($major->competencies))
                            <div class="pt-4 border-t border-line">
                                <span class="block text-xs font-mono font-bold uppercase tracking-widest text-navy mb-3">
                                    Capaian Kompetensi Kejuruan Teruji:
                                </span>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach((array) $major->competencies as $comp)
                                        <div class="p-3.5 rounded-xl bg-paper border border-line flex items-center gap-3 text-xs text-ink font-semibold">
                                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>{{ $comp }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </section>

                {{-- ============================================================= --}}
                {{-- SEKSI 3: SARANA LABORATORIUM & BENGKEL KERJA PRAKTIK          --}}
                {{-- ============================================================= --}}
                <section id="seksi-laboratorium" class="scroll-mt-28" data-reveal>
                    <div class="p-6 sm:p-8 rounded-3xl bg-paper-2/70 border border-line shadow-xs space-y-6">
                        <div>
                            <span class="text-xs font-mono font-bold uppercase tracking-widest text-navy block mb-2">
                                03. Sarana Pembelajaran
                            </span>
                            <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-ink">
                                Bengkel &amp; Laboratorium Berstandar Industri
                            </h2>
                            <p class="text-sm text-ink-muted mt-2 leading-relaxed">
                                Seluruh ruang praktik dilengkapi peralatan mutakhir berlisensi industri resmi guna memastikan siswa terlatih dengan teknologi terkini saat terjun ke dunia kerja.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-4 pt-2">
                            @foreach($enrichedData['labs'] as $lab)
                                <div class="p-5 sm:p-6 rounded-2xl bg-paper border border-line flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                                    <div class="space-y-1.5">
                                        <h3 class="font-display font-bold text-lg text-ink">
                                            {{ $lab['name'] }}
                                        </h3>
                                        <p class="text-xs sm:text-sm text-ink-muted leading-relaxed">
                                            {{ $lab['desc'] }}
                                        </p>
                                    </div>
                                    <span class="px-3 py-1 rounded-md bg-paper-2 border border-line text-[11px] font-mono font-bold uppercase text-navy shrink-0 self-start">
                                        Standar K3 Industri
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div class="p-4 rounded-xl bg-paper border border-line flex items-center justify-between gap-3 text-xs">
                            <span class="text-ink-muted">Lihat seluruh sarana prasarana sekolah secara komprehensif:</span>
                            <a href="{{ route('facilities.index') }}" class="font-mono font-bold text-navy hover:underline shrink-0">
                                Buka Halaman Fasilitas Kampus &rarr;
                            </a>
                        </div>
                    </div>
                </section>

                {{-- ============================================================= --}}
                {{-- SEKSI 4: SERTIFIKASI PROFESI BNSP LSP-P1                      --}}
                {{-- ============================================================= --}}
                <section id="seksi-sertifikasi" class="scroll-mt-28" data-reveal>
                    <div class="p-6 sm:p-8 rounded-3xl bg-navy text-white border-2 border-line shadow-md space-y-6">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2.5 py-1 rounded bg-white/10 text-cyan-300 text-[11px] font-mono font-bold uppercase tracking-widest">
                                    Lisensi BNSP Republik Indonesia
                                </span>
                                <span class="px-2.5 py-1 rounded bg-white/10 text-slate-200 text-[11px] font-mono uppercase tracking-wider">
                                    Lembaga Sertifikasi Profesi Pihak Pertama (LSP-P1)
                                </span>
                            </div>
                            <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-white">
                                Skema Sertifikasi Kompetensi Profesi
                            </h2>
                            <p class="text-slate-300 text-sm mt-2 leading-relaxed">
                                Lulusan SMK Negeri 1 Denpasar tidak hanya memperoleh ijazah sekolah, namun diuji secara independen oleh asesor bersertifikat BNSP untuk mendapatkan sertifikat kompetensi berlogo Garuda Emas yang diakui di seluruh wilayah Republik Indonesia dan tingkat ASEAN.
                            </p>
                        </div>

                        {{-- Certificate Scheme Detail Box --}}
                        <div class="p-6 rounded-2xl bg-white/[0.06] border border-white/15 backdrop-blur-xs space-y-4">
                            <div>
                                <span class="text-[11px] font-mono text-cyan-300 font-bold uppercase tracking-wider block mb-1">
                                    Skema Okupasi Resmi yang Diujikan:
                                </span>
                                <div class="font-display font-extrabold text-xl sm:text-2xl text-white">
                                    {{ $enrichedData['scheme'] }}
                                </div>
                            </div>

                            <div class="pt-3 border-t border-white/10 flex flex-wrap items-center gap-2">
                                <span class="text-xs font-mono text-slate-300 mr-2">Kode Skema Uji:</span>
                                @foreach($enrichedData['unit_codes'] as $code)
                                    <span class="px-2.5 py-1 rounded bg-white/10 text-slate-100 text-xs font-mono font-bold border border-white/15">
                                        {{ $code }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================================= --}}
                {{-- SEKSI 5: PROSPEK KARIR & TRISULA BMW                          --}}
                {{-- ============================================================= --}}
                <section id="seksi-karir" class="scroll-mt-28" data-reveal>
                    <div class="p-6 sm:p-8 rounded-3xl bg-paper-2/70 border border-line shadow-xs space-y-6">
                        <div>
                            <span class="text-xs font-mono font-bold uppercase tracking-widest text-navy block mb-2">
                                05. Masa Depan Lulusan
                            </span>
                            <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-ink">
                                Prospek Karir &amp; Skema BMW Vokasi
                            </h2>
                            <p class="text-sm text-ink-muted mt-2 leading-relaxed">
                                Tiga opsi kelulusan yang setara dan terfasilitasi: Bekerja langsung di industri mitra, Melanjutkan pendidikan ke perguruan tinggi vokasi terkemuka, atau Berwirausaha mandiri (Technopreneur).
                            </p>
                        </div>

                        {{-- Career Opportunities Grid --}}
                        <div class="space-y-3 pt-2">
                            <span class="block text-xs font-mono font-bold uppercase tracking-widest text-navy mb-2">
                                Profil Pekerjaan / Jabatan Industri:
                            </span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @forelse((array) $major->career_prospects as $career)
                                    <div class="p-4 rounded-xl bg-paper border border-line flex items-center justify-between gap-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-navy/10 text-navy flex items-center justify-center shrink-0 font-bold text-xs">
                                                ✓
                                            </div>
                                            <span class="text-xs font-bold text-ink">{{ $career }}</span>
                                        </div>
                                        <span class="text-[10px] font-mono uppercase text-ink-muted">Industri</span>
                                    </div>
                                @empty
                                    <div class="p-4 rounded-xl bg-paper border border-line text-xs text-ink-muted">
                                        Teknisi Spesialis, Supervisor Lapangan, Drafter, Konsultan Teknis, dan Wirausahawan Mandiri.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Trisula BMW Cards --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-line">
                            <div class="p-4 rounded-xl bg-paper border border-line">
                                <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 text-[10px] font-mono font-extrabold uppercase">Bekerja</span>
                                <h4 class="font-display font-bold text-sm text-ink mt-2">Industri Mitra BKK</h4>
                                <p class="text-xs text-ink-muted mt-1 leading-relaxed">Penyaluran langsung melalui Bursa Kerja Khusus (BKK) SKENSA ke 70+ perusahaan mitra.</p>
                            </div>
                            <div class="p-4 rounded-xl bg-paper border border-line">
                                <span class="px-2 py-0.5 rounded bg-blue-100 text-blue-800 text-[10px] font-mono font-extrabold uppercase">Melanjutkan</span>
                                <h4 class="font-display font-bold text-sm text-ink mt-2">D4 / S1 Terapan</h4>
                                <p class="text-xs text-ink-muted mt-1 leading-relaxed">Jalur prestasi SNBP vokasi dan kemitraan politeknik negeri/swasta di Indonesia.</p>
                            </div>
                            <div class="p-4 rounded-xl bg-paper border border-line">
                                <span class="px-2 py-0.5 rounded bg-amber-100 text-amber-800 text-[10px] font-mono font-extrabold uppercase">Wirausaha</span>
                                <h4 class="font-display font-bold text-sm text-ink mt-2">Technopreneur</h4>
                                <p class="text-xs text-ink-muted mt-1 leading-relaxed">Pembekalan bisnis mandiri melalui inkubator Teaching Factory (TeFa) komersial sekolah.</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================================= --}}
                {{-- SEKSI 6: MITRA DUDIKA & KARYA SISWA TERKAIT                   --}}
                {{-- ============================================================= --}}
                <section id="seksi-mitra-karya" class="scroll-mt-28" data-reveal>
                    <div class="p-6 sm:p-8 rounded-3xl bg-paper-2/70 border border-line shadow-xs space-y-8">
                        <div>
                            <span class="text-xs font-mono font-bold uppercase tracking-widest text-navy block mb-2">
                                06. Jejaring Industri &amp; Portofolio
                            </span>
                            <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-ink">
                                Mitra DUDIKA &amp; Portofolio Karya
                            </h2>
                            <p class="text-sm text-ink-muted mt-2 leading-relaxed">
                                Kerjasama formal dengan industri dunia usaha dan dunia kerja untuk program Praktik Kerja Lapangan (PKL), guru tamu industri, penyelarasan kurikulum, dan rekrutmen lulusan.
                            </p>
                        </div>

                        {{-- Industry Partners Grid --}}
                        <div>
                            <span class="block text-xs font-mono font-bold uppercase tracking-widest text-navy mb-3">
                                Mitra Industri Khusus Jurusan {{ $major->code }}:
                            </span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($enrichedData['partners'] as $partner)
                                    <div class="p-4 rounded-xl bg-paper border border-line flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-navy text-white flex items-center justify-center font-bold text-xs shrink-0">
                                            🏢
                                        </div>
                                        <span class="text-xs font-bold text-ink">{{ $partner }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Student Works Linked to this Major --}}
                        @if($major->studentWorks->isNotEmpty())
                            <div class="pt-6 border-t border-line">
                                <span class="block text-xs font-mono font-bold uppercase tracking-widest text-navy mb-4">
                                    Showcase Karya Inovasi Siswa {{ $major->code }}:
                                </span>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($major->studentWorks->take(4) as $work)
                                        <div class="p-5 rounded-2xl bg-paper border border-line flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center justify-between text-xs font-mono text-ink-muted mb-2">
                                                    <span>{{ $work->student_name }}</span>
                                                    <span>{{ $work->year }}</span>
                                                </div>
                                                <h4 class="font-display font-bold text-base text-ink mb-2">
                                                    {{ $work->title }}
                                                </h4>
                                                <p class="text-xs text-ink-muted line-clamp-2 leading-relaxed">
                                                    {{ $work->description }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Achievements Linked to this Major --}}
                        @if($major->achievements->isNotEmpty())
                            <div class="pt-6 border-t border-line">
                                <span class="block text-xs font-mono font-bold uppercase tracking-widest text-navy mb-4">
                                    Prestasi &amp; Medali Kejuaraan Terkait:
                                </span>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($major->achievements->take(4) as $achievement)
                                        <div class="p-4 rounded-xl bg-paper border border-line flex items-center gap-3">
                                            <span class="px-2.5 py-1 rounded bg-amber-400 text-amber-950 text-xs font-mono font-extrabold uppercase shrink-0">
                                                {{ $achievement->medal }}
                                            </span>
                                            <div>
                                                <h4 class="text-xs font-bold text-ink">{{ $achievement->title }}</h4>
                                                <span class="text-[11px] text-ink-muted uppercase font-mono">{{ $achievement->level }} • {{ $achievement->year }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </section>

                {{-- ============================================================= --}}
                {{-- SEKSI 7: KONSENTRASI KEAHLIAN LAINNYA                          --}}
                {{-- ============================================================= --}}
                <section class="pt-6 border-t border-line" data-reveal>
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <span class="text-xs font-mono font-bold uppercase tracking-widest text-navy">Struktur Akademik</span>
                            <h3 class="font-display font-extrabold text-2xl text-ink mt-1">Jelajahi Jurusan Lainnya</h3>
                        </div>
                        <a href="{{ route('majors.index') }}" class="text-xs font-mono font-bold uppercase text-navy hover:underline">
                            Katalog Lengkap (12) &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($otherMajors->take(6) as $other)
                            <a
                                href="{{ route('majors.show', $other->slug) }}"
                                class="p-4 rounded-2xl bg-paper-2 border border-line hover:border-navy transition-colors block group"
                            >
                                <div class="flex items-center justify-between gap-2 mb-2">
                                    <span class="px-2 py-0.5 rounded bg-ink text-white text-[11px] font-mono font-bold uppercase">
                                        {{ $other->code }}
                                    </span>
                                    <span class="text-[10px] text-ink-muted truncate max-w-[120px]">{{ $other->field?->name }}</span>
                                </div>
                                <h4 class="font-display font-bold text-sm text-ink group-hover:text-navy transition-colors leading-snug line-clamp-1">
                                    {{ $other->name }}
                                </h4>
                            </a>
                        @endforeach
                    </div>
                </section>

            </div>

        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- SCROLLSPY & SMOOTH NAVIGATION SCRIPT                                  --}}
    {{-- ===================================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navLinks = document.querySelectorAll('[data-major-toc-link]');
            if (!navLinks.length) return;

            const sections = [];
            navLinks.forEach(function (link) {
                const href = link.getAttribute('href');
                if (href && href.startsWith('#')) {
                    const sec = document.querySelector(href);
                    if (sec) {
                        sections.push({ link: link, el: sec, id: href });
                    }
                }
            });

            if (!sections.length) return;

            // Handle smooth scroll on click with header offset
            sections.forEach(function (item) {
                item.link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const headerOffset = 100;
                    const elementPosition = item.el.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    if (history.pushState) {
                        history.pushState(null, null, item.id);
                    }
                });
            });

            // ScrollSpy update handler
            function updateScrollSpy() {
                const scrollPosition = window.scrollY + 140;
                let activeIndex = -1;

                for (let i = 0; i < sections.length; i++) {
                    const el = sections[i].el;
                    const top = el.offsetTop;
                    const height = el.offsetHeight;

                    if (scrollPosition >= top && scrollPosition < top + height) {
                        activeIndex = i;
                        break;
                    }
                }

                // If scrolled past the last section or near bottom
                if (activeIndex === -1 && window.innerHeight + window.scrollY >= document.body.offsetHeight - 120) {
                    activeIndex = sections.length - 1;
                } else if (activeIndex === -1 && scrollPosition < sections[0].el.offsetTop) {
                    activeIndex = 0;
                }

                sections.forEach(function (item, idx) {
                    const link = item.link;
                    const badge = link.querySelector('[data-toc-badge]');
                    const text = link.querySelector('[data-toc-text]');
                    const arrow = link.querySelector('[data-toc-arrow]');

                    if (idx === activeIndex) {
                        link.classList.add('bg-[#071C3F]', 'text-white', 'shadow-xs');
                        link.classList.remove('text-ink', 'hover:bg-paper', 'border-transparent');
                        link.classList.add('border-white/10');
                        if (badge) {
                            badge.classList.remove('text-ink-muted');
                            badge.classList.add('text-cyan-300', 'font-extrabold');
                        }
                        if (text) {
                            text.classList.remove('text-ink');
                            text.classList.add('text-white', 'font-bold');
                        }
                        if (arrow) {
                            arrow.classList.remove('text-ink-muted');
                            arrow.classList.add('text-cyan-300', 'translate-x-1');
                        }
                    } else {
                        link.classList.remove('bg-[#071C3F]', 'text-white', 'shadow-xs', 'border-white/10');
                        link.classList.add('text-ink', 'hover:bg-paper', 'border-transparent');
                        if (badge) {
                            badge.classList.add('text-ink-muted');
                            badge.classList.remove('text-cyan-300', 'font-extrabold');
                        }
                        if (text) {
                            text.classList.add('text-ink');
                            text.classList.remove('text-white', 'font-bold');
                        }
                        if (arrow) {
                            arrow.classList.add('text-ink-muted');
                            arrow.classList.remove('text-cyan-300', 'translate-x-1');
                        }
                    }
                });
            }

            window.addEventListener('scroll', updateScrollSpy, { passive: true });
            window.addEventListener('resize', updateScrollSpy, { passive: true });
            updateScrollSpy();
        });
    </script>

@endsection
