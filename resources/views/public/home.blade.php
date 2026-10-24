@extends('layouts.public')

@section('title', ($settings['school_name'] ?? 'SMK Negeri 1 Denpasar') . ' - ' . ($settings['school_slogan'] ?? 'Abhyāsad Dhäryate Vidyä.'))

@section('content')

    {{-- Remotion Cinematic Intro Overlay (Full-Screen GSAP Split Curtain, Unskippable with Audio) --}}
    <div
        id="skensa-intro-overlay"
        aria-hidden="false"
        class="fixed inset-0 z-50 flex items-center justify-center overflow-hidden select-none bg-[#071C3F]"
    >
        <div data-intro-top class="absolute inset-x-0 top-0 h-1/2 bg-[#071C3F] border-b border-yellow-skensa/40"></div>
        <div data-intro-bottom class="absolute inset-x-0 bottom-0 h-1/2 bg-[#071C3F] border-t border-yellow-skensa/40"></div>

        <div data-intro-stage class="relative z-10 w-screen h-screen flex items-center justify-center">
            <video
                autoplay
                playsinline
                preload="auto"
                poster="/media/intro.jpg"
                class="w-full h-full object-cover"
            >
                <source src="/media/intro.mp4" type="video/mp4">
                <source src="/media/intro.webm" type="video/webm">
            </video>

            {{-- Browser Autoplay-with-Sound Gate Fallback (Shown only if browser blocks unmuted autoplay) --}}
            <button
                type="button"
                data-intro-sound-gate
                class="hidden absolute inset-0 z-20 flex flex-col items-center justify-end pb-16 bg-gradient-to-t from-[#051329]/90 via-[#071C3F]/25 to-transparent text-paper cursor-pointer focus:outline-none group"
            >
                <div class="inline-flex items-center gap-3.5 px-7 py-4 rounded-2xl bg-[#071C3F]/95 border-2 border-yellow-skensa text-yellow-skensa font-display font-extrabold text-xs sm:text-sm uppercase tracking-[0.2em] shadow-2xl group-hover:bg-yellow-skensa group-hover:text-ink transition-all duration-300">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-skensa opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-yellow-skensa group-hover:bg-ink"></span>
                    </span>
                    <span>Klik di Mana Saja untuk Memasuki SKENSA dengan Suara</span>
                </div>
            </button>

            <div class="absolute bottom-7 inset-x-0 px-6 sm:px-12 flex items-center justify-center text-paper/75 text-[11px] font-bold uppercase tracking-[0.25em] pointer-events-none">
                <span>SMK NEGERI 1 DENPASAR &bull; ABHYĀSAD DHÄRYATE VIDYÄ</span>
            </div>
        </div>
    </div>

    {{-- ===================================================================== --}}
    {{-- KATEGORI 1: BERANDA & IDENTITAS UTAMA (HERO SECTION)                  --}}
    {{-- ===================================================================== --}}
    <section class="relative min-h-[86vh] flex items-center bg-navy text-paper border-b-2 border-ink overflow-hidden">
        {{-- Background Video / Showcase --}}
        <div class="absolute inset-0 z-0">
            <video
                autoplay
                muted
                loop
                playsinline
                preload="auto"
                poster="/media/intro.jpg"
                class="w-full h-full object-cover opacity-45 scale-105"
            >
                <source src="/media/intro.webm" type="video/webm">
                <source src="/media/intro.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-r from-navy via-navy/90 to-navy/55"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-navy via-transparent to-navy/40"></div>
        </div>

        {{-- Main Hero Container --}}
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                {{-- Left Column: Motto, Spirit Day Badge Below Motto & CTA (PPDB + Jurusan + Intro) --}}
                <div class="lg:col-span-7 space-y-6">
                    <h1 data-hero-title class="font-display font-extrabold text-4xl sm:text-5xl lg:text-6xl text-paper leading-[1.06] tracking-tight">
                        {{ $settings['school_slogan'] ?? 'Abhyāsad Dhäryate Vidyä.' }}
                        <span class="block text-yellow-skensa mt-3 text-2xl sm:text-4xl lg:text-5xl">
                            "{{ $settings['school_slogan_meaning'] ?? 'Peliharalah ilmu sampai menjadi tradisi.' }}"
                        </span>
                    </h1>

                    <div data-hero-badge class="inline-flex flex-wrap items-center gap-2.5 px-4 py-2 rounded-full bg-paper/10 backdrop-blur-md border border-yellow-skensa/40 text-yellow-skensa text-xs sm:text-sm font-bold uppercase tracking-widest">
                        <span class="w-2 h-2 rounded-full bg-yellow-skensa"></span>
                        <span>SMK Negeri 1 Denpasar &bull; {{ $settings['hero_highlight'] ?? '“When I Grow Up” Spirit Day!' }}</span>
                    </div>

                    <div data-hero-cta class="flex flex-wrap items-center gap-3.5 pt-2">
                        <a
                            href="#informasi-ppdb"
                            data-magnetic
                            class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl bg-yellow-skensa text-ink font-display font-extrabold text-xs sm:text-sm uppercase tracking-wider border-2 border-yellow-skensa hover:bg-paper transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-skensa"
                        >
                            <span>Pendaftaran / PPDB</span>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                        <a
                            href="#fakultas-keahlian"
                            data-magnetic
                            class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl bg-paper/10 backdrop-blur-md text-paper font-display font-bold text-xs sm:text-sm uppercase tracking-wider border border-paper/30 hover:bg-paper/20 hover:text-yellow-skensa transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-paper"
                        >
                            <span>Jelajahi 12 Jurusan</span>
                            <span aria-hidden="true">&darr;</span>
                        </a>
                        <button
                            type="button"
                            data-intro-replay
                            data-magnetic
                            class="inline-flex items-center gap-2 px-4 py-3.5 rounded-xl bg-paper/10 backdrop-blur-md text-paper font-display font-bold text-xs sm:text-sm uppercase tracking-wider border border-paper/25 hover:bg-paper/20 hover:text-yellow-skensa transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-paper"
                            title="Putar Ulang Animasi Logo Intro"
                        >
                            <svg class="w-4 h-4 text-yellow-skensa shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                            </svg>
                            <span>Putar Intro</span>
                        </button>
                    </div>
                </div>

                {{-- Right Column: Komposisi Pimpinan SKENSA (Foto Kepsek + Kartu 4 Wakasek seperti smkn1denpasar.sch.id) --}}
                <div data-hero-media class="lg:col-span-5 flex justify-center lg:justify-end">
                    <div class="relative flex items-start gap-4 sm:gap-5 max-w-[500px] w-full justify-center lg:justify-end">
                        {{-- Main Portrait: Kepala Sekolah I Wayan Mustika --}}
                        <div data-tilt class="relative w-[265px] sm:w-[300px] rounded-2xl overflow-hidden border-2 border-yellow-skensa/60 bg-navy-700 shadow-2xl shrink-0 group">
                            <img
                                src="/images/kepala-sekolah-i-wayan-mustika.jpg"
                                alt="I Wayan Mustika, S.Pd., M.Pd. - Kepala SMK Negeri 1 Denpasar"
                                width="400"
                                height="460"
                                class="w-full h-[340px] sm:h-[380px] object-cover object-top group-hover:scale-103 transition-transform duration-500"
                            >
                            <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-[#051329] via-[#071C3F]/85 to-transparent"></div>
                            <div class="absolute inset-x-3 bottom-3 p-3.5 rounded-xl bg-[#071C3F]/95 backdrop-blur-md border border-yellow-skensa/45 shadow-lg">
                                <span class="block text-[9px] font-bold uppercase tracking-[0.18em] text-yellow-skensa">
                                    Kepala SMK Negeri 1 Denpasar
                                </span>
                                <h2 class="font-display font-extrabold text-sm sm:text-base text-paper mt-0.5 leading-snug">
                                    I Wayan Mustika, S.Pd., M.Pd.
                                </h2>
                            </div>
                        </div>

                        {{-- Secondary Card: 4 Wakil Kepala Sekolah (Waka SKENSA) --}}
                        <div data-tilt class="hidden sm:flex flex-col w-[170px] mt-10 rounded-2xl overflow-hidden border-2 border-paper/30 bg-paper shadow-2xl shrink-0">
                            <img
                                src="/images/hero_waka.jpg"
                                alt="Wakil Kepala SMK Negeri 1 Denpasar"
                                width="200"
                                height="240"
                                class="w-full h-[200px] object-cover"
                            >
                            <div class="p-3 bg-[#071C3F] text-paper border-t border-yellow-skensa/40">
                                <span class="block text-[9px] font-extrabold uppercase tracking-widest text-yellow-skensa">
                                    Jajaran Wakasek
                                </span>
                                <span class="block text-[11px] font-bold text-paper/90 mt-0.5 leading-tight">
                                    4 Wakil Kepala Sekolah SKENSA
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- KATEGORI 1B: INDIKATOR KUNCI (QUICK STATS / COUNTERS BAR)             --}}
    {{-- ===================================================================== --}}
    <section class="bg-paper-2 border-b-2 border-ink py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <div class="p-5 rounded-2xl bg-paper border-2 border-ink flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-navy text-yellow-skensa flex items-center justify-center font-display font-extrabold text-xl shrink-0">
                        A
                    </div>
                    <div>
                        <span class="block font-display font-extrabold text-xl sm:text-2xl text-ink">Akreditasi A</span>
                        <span class="block text-xs font-semibold text-ink-muted">Unggul (BAN-S/M &bull; SMK PK)</span>
                    </div>
                </div>

                <div class="p-5 rounded-2xl bg-paper border-2 border-ink flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-navy text-yellow-skensa flex items-center justify-center font-display font-extrabold text-sm shrink-0 tabular-nums">
                        SISWA
                    </div>
                    <div>
                        <span class="block font-display font-extrabold text-xl sm:text-2xl text-ink tabular-nums">2.680+</span>
                        <span class="block text-xs font-semibold text-ink-muted">Siswa Aktif (4.205 User LMS)</span>
                    </div>
                </div>

                <div class="p-5 rounded-2xl bg-paper border-2 border-ink flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-navy text-yellow-skensa flex items-center justify-center font-display font-extrabold text-sm shrink-0">
                        SDM
                    </div>
                    <div>
                        <span class="block font-display font-extrabold text-xl sm:text-2xl text-ink tabular-nums">185+</span>
                        <span class="block text-xs font-semibold text-ink-muted">Guru &amp; Tenaga Kependidikan</span>
                    </div>
                </div>

                <div class="p-5 rounded-2xl bg-paper border-2 border-ink flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-yellow-skensa text-ink flex items-center justify-center font-display font-extrabold text-lg shrink-0 tabular-nums">
                        9/12
                    </div>
                    <div>
                        <span class="block font-display font-extrabold text-xl sm:text-2xl text-ink tabular-nums">9 Program</span>
                        <span class="block text-xs font-semibold text-ink-muted">12 Konsentrasi Keahlian</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- KATEGORI 2: PROFIL LEMBAGA (SAMBUTAN KEPSEK, VISI MISI, SEJARAH, SDM) --}}
    {{-- ===================================================================== --}}
    <section id="sambutan-kepala-sekolah" class="py-20 bg-paper border-b-2 border-ink">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            {{-- Baris 1: Sebelah Kiri Foto Kepala Sekolah + Gedung, Sebelah Kanan Sambutan & Ringkasan Pengenalan --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                {{-- Kolom Kiri (lg:col-span-5): Foto Kepala Sekolah & Foto Udara Gedung SKENSA --}}
                <div class="lg:col-span-5 space-y-5">
                    <div class="relative rounded-2xl overflow-hidden border-2 border-ink bg-navy shadow-lg group">
                        <img
                            src="/images/showcase/kepsek_sambutan.jpg"
                            alt="Sambutan Kepala SMK Negeri 1 Denpasar - I Wayan Mustika, S.Pd., M.Pd."
                            width="640"
                            height="360"
                            loading="lazy"
                            class="w-full h-[320px] sm:h-[360px] object-cover object-center group-hover:scale-103 transition-transform duration-500"
                        >
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-navy via-navy/85 to-transparent p-5">
                            <span class="px-2.5 py-1 rounded bg-yellow-skensa text-ink text-[10px] font-extrabold uppercase tracking-widest">
                                Sambutan Kepala Sekolah
                            </span>
                            <h3 class="font-display font-extrabold text-lg text-paper mt-2">
                                I Wayan Mustika, S.Pd., M.Pd.
                            </h3>
                            <p class="text-xs text-paper/80">
                                Kepala SMK Negeri 1 Denpasar (SKENSA)
                            </p>
                        </div>
                    </div>

                    {{-- Foto Gedung Kampus & Legalitas Singkat --}}
                    <div class="p-4 rounded-2xl bg-paper-2 border-2 border-ink flex items-center gap-4">
                        <img
                            src="/images/showcase/drone_kampus.jpg"
                            alt="Gedung Kampus SMK Negeri 1 Denpasar Jl. HOS Cokroaminoto No. 84"
                            width="120"
                            height="80"
                            loading="lazy"
                            class="w-28 h-20 rounded-xl object-cover border border-line shrink-0"
                        >
                        <div class="text-xs space-y-1">
                            <span class="font-extrabold uppercase tracking-wider text-navy block">Sejarah &amp; Legalitas Institusi</span>
                            <p class="text-ink font-semibold">Berdiri: 24 September 1962 (STM Negeri Denpasar)</p>
                            <p class="text-ink-muted">NPSN: <strong class="text-ink">50103118</strong> &bull; SK: <strong class="text-ink">No. 17/D.J.P.T/B1/1962</strong></p>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan (lg:col-span-7): Teks Pengantar & Sambutan Pembuka Kepala Sekolah --}}
                <div class="lg:col-span-7 space-y-6">
                    <div>
                        <span class="inline-block px-3 py-1 rounded-md bg-navy text-yellow-skensa text-xs font-extrabold uppercase tracking-widest">
                            Pengantar &amp; Sambutan Resmi
                        </span>
                        <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-3 leading-tight">
                            Membangun Tradisi Keunggulan Vokasi Teknologi &amp; Industri Kreatif di Bali
                        </h2>
                    </div>

                    <blockquote class="p-6 rounded-2xl bg-paper-2 border-l-4 border-navy text-ink text-sm sm:text-base leading-relaxed space-y-3">
                        <p class="font-semibold text-navy">
                            "Om Swastyastu, Assalamu’alaikum Warahmatullahi Wabarakatuh, Salam Sejahtera bagi kita semua, Shalom, Namo Buddhaya, Salam Kebajikan."
                        </p>
                        <p>
                            Selamat datang di portal resmi <strong>SMK Negeri 1 Denpasar (SKENSA)</strong>. Sejak didirikan pada tanggal 24 September 1962 sebagai STM Negeri Denpasar, institusi ini terus bertransformasi menjadi SMK Pusat Keunggulan yang memadukan penguasaan rekayasa teknologi, teknologi informasi, dan industri kreatif dengan nilai luhur <em>Abhyāsad Dhäryate Vidyä</em> (Peliharalah ilmu sampai menjadi tradisi).
                        </p>
                        <p>
                            Melalui sinergi kurikulum bersama mitra Dunia Usaha dan Dunia Industri (DUDIKA), pembelajaran berbasis <em>Teaching Factory</em>, serta sertifikasi profesi berlisensi BNSP melalui LSP-P1 SMK Negeri 1 Denpasar, kami berkomitmen menyiapkan lulusan yang <strong>Siap, Kompeten, Disiplin, dan Beretika</strong> untuk bekerja, melanjutkan pendidikan tinggi, maupun berwirausaha mandiri.
                        </p>
                    </blockquote>

                    {{-- Visi, Misi & Tujuan Institusi Ringkas --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="p-5 rounded-2xl bg-navy text-paper border-2 border-ink">
                            <span class="text-[11px] font-extrabold uppercase tracking-widest text-yellow-skensa">Visi Institusi</span>
                            <h3 class="font-display font-bold text-base text-paper mt-1.5 leading-snug">
                                Terwujudnya Lulusan yang Unggul dalam IPTEK, Berkarakter Pancasila, Berbudaya Lingkungan, dan Berdaya Saing Global.
                            </h3>
                        </div>

                        <div class="p-5 rounded-2xl bg-paper-2 border-2 border-ink">
                            <span class="text-[11px] font-extrabold uppercase tracking-widest text-navy">Misi &amp; Tujuan Utama</span>
                            <ul class="mt-2 space-y-1.5 text-xs text-ink-muted font-medium">
                                <li>&bull; Menyelenggarakan pendidikan vokasi berbasis <em>Link and Match</em> industri.</li>
                                <li>&bull; Mengembangkan sertifikasi kompetensi berstandar nasional (BNSP) &amp; internasional.</li>
                                <li>&bull; Menanamkan budaya kerja industri dan kearifan lokal Bali.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 pt-1">
                        <a href="{{ route('profile.index') }}" class="px-5 py-2.5 rounded-xl bg-navy text-paper text-xs font-extrabold uppercase tracking-wider hover:bg-navy-700 transition-colors">
                            Profil, Sejarah &amp; Struktur Organisasi &rarr;
                        </a>
                        <a href="{{ route('staff.index') }}" class="px-5 py-2.5 rounded-xl bg-paper-2 border-2 border-ink text-ink text-xs font-extrabold uppercase tracking-wider hover:border-navy transition-colors">
                            Direktori Guru &amp; Staf Pengajar &rarr;
                        </a>
                    </div>
                </div>
            </div>

            {{-- Baris 2: 4 Karakter Budaya Sekolah + Preview Struktur Pimpinan --}}
            <div class="pt-10 border-t-2 border-line">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-navy">Nilai Budaya &amp; Karakter SKENSA (SISIKOBER)</span>
                        <h3 class="font-display font-extrabold text-2xl sm:text-3xl text-ink mt-1">
                            4 Pilar Karakter Utama Peserta Didik
                        </h3>
                    </div>
                    <a href="{{ route('staff.index') }}" class="text-xs font-extrabold uppercase tracking-wider text-navy hover:underline">
                        Lihat Bagan Pimpinan &amp; Direktori Guru Lengkap &rarr;
                    </a>
                </div>

                @php
                    $characterValues = json_decode($settings['character_values'] ?? '[]', true) ?: [
                        ['code' => '01', 'title' => 'Siap', 'desc' => 'Siaga menghadapi tantangan dunia kerja dan berkomitmen mencapai tujuan.'],
                        ['code' => '02', 'title' => 'Kompeten', 'desc' => 'Keselarasan pengetahuan, keterampilan teknis, dan sertifikasi profesi.'],
                        ['code' => '03', 'title' => 'Disiplin', 'desc' => 'Pembiasaan budaya kerja industri yang terstruktur dan bertanggung jawab.'],
                        ['code' => '04', 'title' => 'Beretika', 'desc' => 'Menjunjung tinggi nilai etika, tata krama, dan norma dalam kehidupan sosial.'],
                    ];
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($characterValues as $idx => $char)
                        <div class="p-6 rounded-2xl bg-paper-2 border-2 border-ink flex flex-col justify-between hover:border-navy transition-all">
                            <div class="flex items-center justify-between mb-4">
                                <span class="px-3 py-1 rounded-lg bg-navy text-yellow-skensa font-display font-extrabold text-xs tabular-nums">
                                    PILAR {{ $char['code'] ?? str_pad((string) ($idx + 1), 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="w-2.5 h-2.5 rounded-full bg-navy"></span>
                            </div>
                            <div>
                                <h4 class="font-display font-extrabold text-xl text-ink">{{ $char['title'] }}</h4>
                                <p class="text-xs sm:text-sm text-ink-muted mt-1.5 leading-relaxed">{{ $char['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- KATEGORI 3: PROGRAM AKADEMIK, SERTIFIKASI, FASILITAS & VIDEO YOUTUBE  --}}
    {{-- ===================================================================== --}}
    <section id="fakultas-keahlian" class="py-20 bg-paper-2 border-b-2 border-ink">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
            {{-- Bagian 3A: Daftar 9 Program & 12 Konsentrasi Keahlian + Sertifikasi & Prospek Karir --}}
            <div>
                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12 pb-6 border-b-2 border-line">
                    <div>
                        <span class="inline-block px-3 py-1 rounded-md bg-navy text-yellow-skensa text-xs font-extrabold uppercase tracking-widest">
                            Program Akademik &amp; Kejuruan Resmi
                        </span>
                        <h2 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-ink mt-3">
                            9 Program &amp; 12 <span class="marker-highlight">Konsentrasi Keahlian</span>
                        </h2>
                        <p class="text-sm text-ink-muted mt-2 max-w-2xl">
                            Setiap konsentrasi keahlian dilengkapi kurikulum berbasis industri, sertifikasi kompetensi berlisensi <strong>LSP-P1 BNSP</strong>, serta pemetaan karir lulusan.
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-ink-muted tabular-nums">
                            Menampilkan: <strong id="faculty-active-count" class="text-navy font-extrabold">{{ $majors->count() }}</strong> Jurusan
                        </span>
                        <a
                            href="{{ route('majors.index') }}"
                            class="px-4 py-2.5 rounded-xl bg-navy text-paper text-xs font-bold uppercase tracking-wider hover:bg-navy-700 transition-colors"
                        >
                            Katalog Penuh &rarr;
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    {{-- Left Column: Sticky 9 Program Keahlian Selector --}}
                    <div class="lg:col-span-4 lg:sticky lg:top-28 bg-paper rounded-2xl border-2 border-ink p-4 space-y-1.5 shadow-sm">
                        <div class="px-3 py-2 border-b border-line mb-2 flex items-center justify-between">
                            <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Filter Program Keahlian</span>
                            <span class="text-[11px] font-bold text-ink-muted tabular-nums">9 Bidang</span>
                        </div>

                        <button
                            type="button"
                            data-faculty-filter="all"
                            class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-left font-display font-bold text-sm transition-all cursor-pointer bg-navy text-paper"
                        >
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-extrabold text-yellow-skensa tabular-nums">ALL</span>
                                <span>Seluruh Program Keahlian</span>
                            </div>
                            <span class="text-xs font-extrabold px-2 py-0.5 rounded bg-yellow-skensa text-ink tabular-nums">
                                {{ $majors->count() }}
                            </span>
                        </button>

                        @foreach($fields as $fIdx => $field)
                            <button
                                type="button"
                                data-faculty-filter="{{ $field->id }}"
                                class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-left font-display font-semibold text-sm transition-all cursor-pointer text-ink hover:bg-paper-2"
                            >
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="text-xs font-extrabold text-ink-muted tabular-nums" data-filter-num>{{ str_pad((string) ($fIdx + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="truncate">{{ $field->name }}</span>
                                </div>
                                <span class="text-xs font-bold px-2 py-0.5 rounded bg-paper-2 border border-line text-ink-muted tabular-nums shrink-0" data-filter-badge>
                                    {{ $field->majors_count }}
                                </span>
                            </button>
                        @endforeach
                    </div>

                    {{-- Right Column: 12 Konsentrasi Keahlian Cards --}}
                    <div class="lg:col-span-8">
                        <div id="faculty-cards-grid" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($majors as $index => $major)
                                <article
                                    data-faculty-card
                                    data-field-id="{{ $major->field_id }}"
                                    class="rounded-2xl bg-paper border-2 border-ink overflow-hidden flex flex-col justify-between hover:border-navy transition-all group shadow-xs"
                                >
                                    <div>
                                        <div class="relative h-44 bg-navy overflow-hidden border-b-2 border-ink">
                                            <img
                                                src="{{ $major->image ?: '/images/showcase/drone_kampus.jpg' }}"
                                                alt="{{ $major->name }}"
                                                loading="lazy"
                                                class="w-full h-full object-cover opacity-65 group-hover:scale-105 transition-transform duration-500"
                                            >
                                            <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/45 to-transparent"></div>

                                            <div class="absolute top-3.5 left-3.5 right-3.5 flex items-center justify-between gap-2">
                                                <span class="px-3 py-1 rounded-lg bg-yellow-skensa text-ink font-display font-extrabold text-xs uppercase tracking-wider shadow-xs">
                                                    {{ $major->code }}
                                                </span>
                                                <span class="px-2.5 py-1 rounded-md bg-navy/90 backdrop-blur-xs border border-paper/20 text-paper text-[11px] font-bold uppercase tracking-wider truncate max-w-[200px]">
                                                    {{ $major->field?->name }}
                                                </span>
                                            </div>

                                            <div class="absolute bottom-3 left-3.5 right-3.5 flex items-center justify-between">
                                                <span class="text-[11px] font-extrabold uppercase tracking-widest text-yellow-skensa">
                                                    Sertifikasi LSP-P1 BNSP &bull; Level II KKNI
                                                </span>
                                            </div>
                                        </div>

                                        <div class="p-6">
                                            <h3 class="font-display font-extrabold text-xl text-ink group-hover:text-navy transition-colors leading-snug">
                                                <a href="{{ route('majors.show', $major->slug) }}" class="focus-visible:outline-none focus-visible:underline">
                                                    {{ $major->name }}
                                                </a>
                                            </h3>

                                            <p class="text-sm text-ink-muted mt-2.5 leading-relaxed">
                                                {{ $major->description }}
                                            </p>

                                            @if(!empty($major->competencies))
                                                <div class="mt-4 pt-4 border-t border-line">
                                                    <span class="block text-[10px] font-extrabold uppercase tracking-widest text-navy mb-2">
                                                        Fokus Materi &amp; Skema Uji Kompetensi:
                                                    </span>
                                                    <ul class="space-y-1 text-xs text-ink-muted">
                                                        @foreach(array_slice((array) $major->competencies, 0, 3) as $comp)
                                                            <li class="flex items-start gap-2">
                                                                <span class="text-navy font-bold">&bull;</span>
                                                                <span>{{ $comp }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="px-6 pb-6 pt-3 border-t border-line bg-paper-2/50">
                                        @if(!empty($major->career_prospects))
                                            <span class="block text-[10px] font-bold uppercase tracking-wider text-ink-muted mb-1.5">Prospek Karir Lulusan:</span>
                                            <div class="flex flex-wrap gap-1.5 mb-4">
                                                @foreach(array_slice((array) $major->career_prospects, 0, 3) as $prospect)
                                                    <span class="text-[11px] font-semibold px-2.5 py-0.5 rounded-md bg-paper border border-line text-ink">
                                                        {{ $prospect }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <a
                                            href="{{ route('majors.show', $major->slug) }}"
                                            class="inline-flex items-center justify-between w-full px-4 py-2.5 rounded-xl bg-navy text-paper group-hover:bg-yellow-skensa group-hover:text-ink font-display font-bold text-xs uppercase tracking-wider transition-colors"
                                        >
                                            <span>Detail Kurikulum &amp; Bengkel {{ $major->code }}</span>
                                            <span aria-hidden="true">&rarr;</span>
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian 3B: Fasilitas Penunjang Pembelajaran (Lab Komputer, Bengkel Praktik, Perpustakaan/Olahraga/Aula) --}}
            <div class="pt-12 border-t-2 border-line">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Infrastruktur Kampus 16.610 m&sup2;</span>
                        <h3 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-1">
                            Fasilitas Penunjang <span class="marker-highlight">Pembelajaran</span>
                        </h3>
                    </div>
                    <a href="{{ route('gallery.index') }}" class="text-xs font-extrabold uppercase tracking-wider text-navy hover:underline">
                        Lihat Galeri Fasilitas Lengkap &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- 1. Laboratorium Jaringan Komputer & Fiber Optik (TKJ) --}}
                    <div class="rounded-2xl bg-paper border-2 border-ink overflow-hidden flex flex-col justify-between">
                        <div class="relative h-52 bg-navy border-b-2 border-ink overflow-hidden">
                            <img src="/images/showcase/lab_fiber.jpg" alt="Praktik Splicing Fiber Optik Jurusan Teknik Komputer dan Jaringan (TKJ) SMKN 1 Denpasar" loading="lazy" class="w-full h-full object-cover">
                            <span class="absolute top-3 left-3 px-3 py-1 rounded-md bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase tracking-wider">
                                Jurusan TKJ
                            </span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h4 class="font-display font-extrabold text-lg text-ink">Laboratorium Jaringan &amp; Fiber Optik (TKJ)</h4>
                                <p class="text-sm text-ink-muted mt-2 leading-relaxed">
                                    Fasilitas praktik siswa <strong>Teknik Komputer dan Jaringan (TKJ)</strong> yang dilengkapi alat <em>Fusion Splicer</em> serat optik FTTH, router/switch Cisco &amp; MikroTik, serta server administrasi jaringan.
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-line text-xs font-bold text-navy">
                                TUK Tersertifikasi LSP-P1 BNSP &bull; Teknik Komputer &amp; Jaringan
                            </div>
                        </div>
                    </div>

                    {{-- 2. Workshop Praktik Konstruksi Gedung (TKP & DPIB) --}}
                    <div class="rounded-2xl bg-paper border-2 border-ink overflow-hidden flex flex-col justify-between">
                        <div class="relative h-52 bg-navy border-b-2 border-ink overflow-hidden">
                            <img src="/images/showcase/ukk_2026.jpg" alt="Praktik Konstruksi dan Uji Kompetensi Keahlian TKP SMKN 1 Denpasar" loading="lazy" class="w-full h-full object-cover">
                            <span class="absolute top-3 left-3 px-3 py-1 rounded-md bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase tracking-wider">
                                Jurusan TKP &amp; DPIB
                            </span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h4 class="font-display font-extrabold text-lg text-ink">Workshop Konstruksi Gedung &amp; Studio BIM</h4>
                                <p class="text-sm text-ink-muted mt-2 leading-relaxed">
                                    Area praktik lapangan <strong>Teknik Konstruksi dan Perumahan (TKP)</strong> serta studio gambar <strong>DPIB</strong> untuk pelaksanaan Uji Kompetensi Keahlian (UKK) Pelaksana Lapangan Pekerjaan Gedung.
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-line text-xs font-bold text-navy">
                                Skema Sertifikasi BNSP Level 2 &bull; TKP &amp; DPIB
                            </div>
                        </div>
                    </div>

                    {{-- 3. Daikin Center of Excellence & Bengkel Rekayasa --}}
                    <div class="rounded-2xl bg-paper border-2 border-ink overflow-hidden flex flex-col justify-between">
                        <div class="relative h-52 bg-navy border-b-2 border-ink overflow-hidden">
                            <img src="/images/showcase/daikin_coe.jpg" alt="Peresmian Daikin Center of Excellence SMKN 1 Denpasar" loading="lazy" class="w-full h-full object-cover">
                            <span class="absolute top-3 left-3 px-3 py-1 rounded-md bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase tracking-wider">
                                Center of Excellence
                            </span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h4 class="font-display font-extrabold text-lg text-ink">Daikin Center of Excellence &amp; Bengkel Rekayasa</h4>
                                <p class="text-sm text-ink-muted mt-2 leading-relaxed">
                                    Pusat keunggulan tata udara (<strong>TPTUP</strong>) berstandar PT Daikin Airconditioning Indonesia, berdampingan dengan bengkel mesin CNC (<strong>TPM</strong>), kelistrikan (<strong>TITL</strong>), dan otomotif (<strong>TKR/TSM</strong>).
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-line text-xs font-bold text-navy">
                                Kelas Industri DUDIKA &bull; TPTUP, TITL, TPM, TKR, TSM
                            </div>
                        </div>
                    </div>

                    {{-- 4. Perpustakaan Digital, Sarana Olahraga & Aula Utama --}}
                    <div class="rounded-2xl bg-paper border-2 border-ink overflow-hidden flex flex-col justify-between">
                        <div class="relative h-52 bg-navy border-b-2 border-ink overflow-hidden">
                            <img src="/images/showcase/lapangan_upacara.jpg" alt="Lapangan Olahraga, Perpustakaan, dan Aula SMKN 1 Denpasar" loading="lazy" class="w-full h-full object-cover">
                            <span class="absolute top-3 left-3 px-3 py-1 rounded-md bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase tracking-wider">
                                Sarana Umum Kampus
                            </span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h4 class="font-display font-extrabold text-lg text-ink">Perpustakaan Digital (e-Library), Lapangan &amp; Aula</h4>
                                <p class="text-sm text-ink-muted mt-2 leading-relaxed">
                                    Terintegrasi dengan portal <em>lib.smkn1denpasar.sch.id</em>, lapangan olahraga utama untuk kegiatan apel &amp; ekstrakurikuler, aula serbaguna Gelora SKENSA, serta laboratorium RPL/DKV/PRF.
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-line text-xs font-bold text-navy">
                                Mendukung Pembelajaran Holistik &amp; Kegiatan Kesiswaan
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian 3C: Showcase Video Resmi YouTube @smkn1denpasar --}}
            <div class="pt-12 border-t-2 border-line">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Kanal Resmi YouTube @smkn1denpasar</span>
                        <h3 class="font-display font-extrabold text-2xl sm:text-3xl text-ink mt-1">
                            Video Profil Jurusan &amp; Aktivitas Kampus SKENSA
                        </h3>
                    </div>
                    <a
                        href="https://www.youtube.com/@smkn1denpasar/videos"
                        target="_blank"
                        rel="noopener"
                        class="text-xs font-extrabold uppercase tracking-wider text-navy hover:underline"
                    >
                        Buka Kanal YouTube Resmi &nearr;
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Video 1: Profil Konsentrasi Keahlian SMKN 1 Denpasar --}}
                    <div class="rounded-2xl bg-navy text-paper border-2 border-ink overflow-hidden shadow-lg">
                        <div class="aspect-video w-full bg-ink">
                            <iframe
                                class="w-full h-full"
                                src="https://www.youtube.com/embed/uTDYUJLP3xY?rel=0"
                                title="Profil Konsentrasi Keahlian (Jurusan) SMKN 1 Denpasar"
                                loading="lazy"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                            ></iframe>
                        </div>
                        <div class="p-5 flex items-center justify-between gap-4">
                            <div>
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-yellow-skensa">Video Resmi SKENSA</span>
                                <h4 class="font-display font-bold text-base sm:text-lg text-paper mt-0.5">
                                    Profil Konsentrasi Keahlian (Jurusan) SMKN 1 Denpasar
                                </h4>
                            </div>
                            <a href="https://www.youtube.com/watch?v=uTDYUJLP3xY" target="_blank" rel="noopener" class="px-3.5 py-2 rounded-lg bg-yellow-skensa text-ink text-xs font-extrabold uppercase shrink-0">
                                YouTube &nearr;
                            </a>
                        </div>
                    </div>

                    {{-- Video 2: Pengalaman Belajar di SMKN 1 Denpasar --}}
                    <div class="rounded-2xl bg-navy text-paper border-2 border-ink overflow-hidden shadow-lg">
                        <div class="aspect-video w-full bg-ink">
                            <iframe
                                class="w-full h-full"
                                src="https://www.youtube.com/embed/PGel3Be5L_E?rel=0"
                                title="Pengalaman Belajar di SMKN 1 Denpasar"
                                loading="lazy"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                            ></iframe>
                        </div>
                        <div class="p-5 flex items-center justify-between gap-4">
                            <div>
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-yellow-skensa">Kehidupan Kampus</span>
                                <h4 class="font-display font-bold text-base sm:text-lg text-paper mt-0.5">
                                    Pengalaman Belajar &amp; Praktik Kejuruan di SMKN 1 Denpasar
                                </h4>
                            </div>
                            <a href="https://www.youtube.com/watch?v=PGel3Be5L_E" target="_blank" rel="noopener" class="px-3.5 py-2 rounded-lg bg-yellow-skensa text-ink text-xs font-extrabold uppercase shrink-0">
                                YouTube &nearr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- KATEGORI 4: KEMITRAAN DUDIKA & JEJAK LULUSAN (STATISTIK & TESTIMONI)  --}}
    {{-- ===================================================================== --}}
    <section id="kemitraan-alumni" class="py-20 bg-paper border-b-2 border-ink overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            {{-- Header Kemitraan & DUDIKA --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="inline-block px-3 py-1 rounded-md bg-navy text-yellow-skensa text-xs font-extrabold uppercase tracking-widest">
                        Ekosistem DUDIKA &amp; Bursa Kerja Khusus (BKK)
                    </span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-3">
                        Kemitraan Industri &amp; <span class="marker-highlight">Jejak Lulusan</span>
                    </h2>
                </div>
                <p class="text-sm text-ink-muted max-w-md">
                    Kolaborasi nyata bersama perusahaan nasional dan multinasional untuk PKL/magang, kelas industri, uji kompetensi, dan rekrutmen lulusan.
                </p>
            </div>

            {{-- Infinite Marquee of Verified Industry Partners (DUDIKA) --}}
            <div class="p-6 rounded-2xl bg-paper-2 border-2 border-ink">
                <div class="mb-4 flex items-center justify-between">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-navy">
                        Daftar Mitra Perusahaan Rekanan PKL, Kelas Industri &amp; Rekrutmen:
                    </span>
                    <span class="hidden sm:inline text-[11px] font-semibold text-ink-muted">
                        Arahkan Kursor untuk Menghentikan
                    </span>
                </div>

                <div class="relative w-full overflow-hidden mask-gradient-x">
                    <div class="animate-marquee flex items-center gap-6 py-2">
                        @php
                            $partners = [
                                ['name' => 'PT Astra Honda Motor', 'desc' => 'Kelas Industri & Praktik TSM', 'logo' => '/images/partners/honda.svg'],
                                ['name' => 'Toyota Auto2000 Bali', 'desc' => 'Sinkronisasi & Magang TKR', 'logo' => '/images/partners/toyota.svg'],
                                ['name' => 'PT Telkom Indonesia', 'desc' => 'Mitra Fiber Optik & TKJ', 'logo' => '/images/partners/telkom.svg'],
                                ['name' => 'Daikin Air Conditioning', 'desc' => 'Daikin Center of Excellence TPTUP', 'logo' => '/images/partners/daikin.svg'],
                                ['name' => 'PT PLN (Persero)', 'desc' => 'Mitra Ketenagalistrikan TITL', 'logo' => '/images/partners/pln.svg'],
                                ['name' => 'Schneider Electric', 'desc' => 'Otomasi & Listrik Industri', 'logo' => '/images/partners/schneider.svg'],
                                ['name' => 'PT Yamaha Motor Bali', 'desc' => 'Mitra Praktik Otomotif Roda Dua', 'logo' => '/images/partners/yamaha.svg'],
                                ['name' => 'Imaji Kryamaha Software', 'desc' => 'Mitra Industri Perangkat Lunak RPL', 'logo' => '/images/partners/imaji.svg'],
                                ['name' => 'PT Casa Amertha Arsitektur', 'desc' => 'Mitra Desain & Konstruksi DPIB/TKP', 'logo' => '/images/partners/casa_amertha.svg'],
                                ['name' => 'Komatsu Heavy Equipment', 'desc' => 'Mitra Manufaktur & Pemesinan TPM', 'logo' => '/images/partners/komatsu.svg'],
                            ];
                        @endphp

                        @foreach([$partners, $partners] as $loopSet)
                            @foreach($loopSet as $partner)
                                <div class="flex items-center gap-3.5 px-4 py-2.5 rounded-2xl bg-paper border border-line shadow-xs shrink-0 hover:border-navy transition-all">
                                    <div class="w-16 h-9 rounded-lg bg-white border border-line/60 flex items-center justify-center p-1 shrink-0 overflow-hidden">
                                        <img src="{{ $partner['logo'] }}" alt="Logo {{ $partner['name'] }}" class="max-h-7 max-w-[56px] w-auto h-auto object-contain">
                                    </div>
                                    <div>
                                        <span class="block font-display font-extrabold text-xs text-ink leading-tight">{{ $partner['name'] }}</span>
                                        <span class="block text-[10px] text-ink-muted mt-0.5">{{ $partner['desc'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>

                {{-- 4 Bentuk Program Kolaborasi DUDIKA --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6 pt-6 border-t border-line">
                    <div class="p-4 rounded-xl bg-paper border border-line">
                        <span class="text-[11px] font-extrabold uppercase text-navy">01 &bull; Kelas Industri</span>
                        <h3 class="font-display font-bold text-sm text-ink mt-1">Sinkronisasi Kurikulum &amp; CoE</h3>
                        <p class="text-xs text-ink-muted mt-1">Kurikulum disusun bersama Daikin CoE, Astra Honda, Toyota, dan Telkom sesuai standar industri terkini.</p>
                    </div>
                    <div class="p-4 rounded-xl bg-paper border border-line">
                        <span class="text-[11px] font-extrabold uppercase text-navy">02 &bull; PKL &amp; Magang</span>
                        <h3 class="font-display font-bold text-sm text-ink mt-1">Praktik Kerja Lapangan 6 Bulan</h3>
                        <p class="text-xs text-ink-muted mt-1">Penempatan siswa di lebih dari 120 perusahaan rekanan di Bali, nasional, hingga program magang Jepang (JAC).</p>
                    </div>
                    <div class="p-4 rounded-xl bg-paper border border-line">
                        <span class="text-[11px] font-extrabold uppercase text-navy">03 &bull; Uji Kompetensi</span>
                        <h3 class="font-display font-bold text-sm text-ink mt-1">Asesmen UKK &amp; LSP-P1 BNSP</h3>
                        <p class="text-xs text-ink-muted mt-1">Penguji eksternal dari praktisi industri dan asesor LSP-P1 menjamin validitas sertifikat keahlian lulusan.</p>
                    </div>
                    <div class="p-4 rounded-xl bg-paper border border-line">
                        <span class="text-[11px] font-extrabold uppercase text-navy">04 &bull; Rekrutmen BKK</span>
                        <h3 class="font-display font-bold text-sm text-ink mt-1">Job Fair &amp; Penyaluran Kerja</h3>
                        <p class="text-xs text-ink-muted mt-1">Bursa Kerja Khusus (BKK) rutin menggelar Job Fair tahunan untuk rekrutmen langsung lulusan SKENSA.</p>
                    </div>
                </div>
            </div>

            {{-- Data Statistik Lulusan (BMW) & Testimoni Alumni --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                {{-- Left Column (lg:col-span-5): Statistik Keterserapan Lulusan & Foto Job Fair --}}
                <div class="lg:col-span-5 rounded-2xl bg-navy text-paper border-2 border-ink p-7 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-wider">
                                Data Tracer Vokasi &amp; BKK
                            </span>
                            <a href="https://tracervokasi.kemendikdasmen.go.id" target="_blank" rel="noopener" class="text-xs text-yellow-skensa hover:underline">
                                Tracer Vokasi &nearr;
                            </a>
                        </div>

                        <h3 class="font-display font-extrabold text-2xl text-paper">
                            Statistik Keterserapan Lulusan (BMW)
                        </h3>
                        <p class="text-xs sm:text-sm text-paper/80 leading-relaxed">
                            Sebaran jejak alumni SMK Negeri 1 Denpasar dalam 1 tahun setelah kelulusan berdasarkan pemetaan Bursa Kerja Khusus (BKK) dan Tracer Vokasi Kemendikdasmen:
                        </p>

                        {{-- Progress Bars Statistik BMW --}}
                        <div class="space-y-3.5 pt-2">
                            <div>
                                <div class="flex justify-between text-xs font-bold mb-1">
                                    <span class="text-paper">Bekerja di Industri Dalam &amp; Luar Negeri</span>
                                    <span class="text-yellow-skensa tabular-nums">62%</span>
                                </div>
                                <div class="w-full h-2.5 rounded-full bg-paper/15 overflow-hidden">
                                    <div class="h-full bg-yellow-skensa rounded-full" style="width: 62%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between text-xs font-bold mb-1">
                                    <span class="text-paper">Melanjutkan Pendidikan Tinggi (PTN / Politeknik / PTS)</span>
                                    <span class="text-yellow-skensa tabular-nums">26%</span>
                                </div>
                                <div class="w-full h-2.5 rounded-full bg-paper/15 overflow-hidden">
                                    <div class="h-full bg-cyan-400 rounded-full" style="width: 26%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between text-xs font-bold mb-1">
                                    <span class="text-paper">Wirausaha Mandiri &amp; Pekerja Lepas Kreatif</span>
                                    <span class="text-yellow-skensa tabular-nums">12%</span>
                                </div>
                                <div class="w-full h-2.5 rounded-full bg-paper/15 overflow-hidden">
                                    <div class="h-full bg-emerald-400 rounded-full" style="width: 12%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-5 border-t border-paper/15 flex items-center gap-4">
                        <img src="/images/showcase/job_fair_2026.jpg" alt="Job Fair SMKN 1 Denpasar" width="96" height="64" loading="lazy" class="w-24 h-16 rounded-xl object-cover border border-paper/25 shrink-0">
                        <div class="text-xs">
                            <span class="font-bold text-yellow-skensa block">Job Fair SMKN 1 Denpasar 2026</span>
                            <span class="text-paper/80">Puluhan perusahaan mitra hadir merekrut langsung lulusan kelas XII di kampus SKENSA.</span>
                        </div>
                    </div>
                </div>

                {{-- Right Column (lg:col-span-7): 3 Kartu Testimoni Alumni --}}
                <div class="lg:col-span-7 flex flex-col justify-between gap-4">
                    @php
                        $alumniTestimonials = [
                            [
                                'name' => 'I Putu Gede Pratama Putra',
                                'grad_year' => 'Lulusan 2023 • Rekayasa Perangkat Lunak (RPL)',
                                'role' => 'Software Engineer di Perusahaan Teknologi Bali & Mahasiswa TI',
                                'quote' => 'Pembelajaran berbasis proyek dan sertifikasi kompetensi LSP-P1 di SKENSA membuat saya langsung siap menangani pengembangan sistem produksi sejak lulus sekolah.',
                            ],
                            [
                                'name' => 'I Made Arya Wirawan',
                                'grad_year' => 'Lulusan 2022 • Teknik Pemanasan, Tata Udara & Pendinginan (TPTUP)',
                                'role' => 'HVAC Specialist di Mitra Daikin Air Conditioning',
                                'quote' => 'Fasilitas bengkel Daikin Center of Excellence di SMKN 1 Denpasar sangat identik dengan peralatan kerja di lapangan, sehingga masa adaptasi kerja saya berlangsung sangat cepat.',
                            ],
                            [
                                'name' => 'Ni Luh Putu Dian Maharani',
                                'grad_year' => 'Lulusan 2023 • Desain Pemodelan & Informasi Bangunan (DPIB)',
                                'role' => 'BIM Modeler & Drafter di Konsultan Arsitektur Denpasar',
                                'quote' => 'Disiplin kerja dan penguasaan AutoCAD serta pemodelan BIM 3D yang diajarkan guru-guru SKENSA menjadi bekal utama saya berkarier di industri konstruksi Bali.',
                            ],
                        ];
                    @endphp

                    @foreach($alumniTestimonials as $alumni)
                        <div class="p-6 rounded-2xl bg-paper-2 border-2 border-ink flex flex-col justify-between hover:border-navy transition-colors">
                            <p class="text-sm text-ink leading-relaxed italic">
                                "{{ $alumni['quote'] }}"
                            </p>
                            <div class="mt-4 pt-3 border-t border-line flex flex-wrap items-center justify-between gap-2">
                                <div>
                                    <h4 class="font-display font-extrabold text-base text-navy">{{ $alumni['name'] }}</h4>
                                    <span class="text-xs font-semibold text-ink-muted block">{{ $alumni['role'] }}</span>
                                </div>
                                <span class="px-3 py-1 rounded-lg bg-navy text-yellow-skensa text-[11px] font-extrabold uppercase tracking-wider">
                                    {{ $alumni['grad_year'] }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- KATEGORI 5: PRESTASI & KESISWAAN (ETALASE JUARA, OSIS/MPK, EKSKUL)    --}}
    {{-- ===================================================================== --}}
    <section id="prestasi-kesiswaan" class="py-20 bg-paper-2 border-b-2 border-ink">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
            {{-- Bagian 5A: Etalase Prestasi Akademik & Non-Akademik --}}
            <div>
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                    <div>
                        <span class="inline-block px-3 py-1 rounded-md bg-navy text-yellow-skensa text-xs font-extrabold uppercase tracking-widest">
                            Hall of Fame &bull; Rekor 157+ Prestasi Nasional
                        </span>
                        <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-3">
                            Etalase <span class="marker-highlight">Prestasi</span> Siswa SKENSA
                        </h2>
                    </div>
                    <a href="{{ route('achievements.index') }}" class="px-5 py-2.5 rounded-xl bg-navy text-paper text-xs font-extrabold uppercase tracking-wider hover:bg-navy-700 transition-colors">
                        Direktori Prestasi Lengkap &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                    {{-- Foto Dokumentasi Penerimaan Penghargaan / LKS 2026 --}}
                    <div class="lg:col-span-5 rounded-2xl bg-navy text-paper border-2 border-ink overflow-hidden flex flex-col justify-between shadow-lg">
                        <div class="relative h-64 overflow-hidden border-b-2 border-ink">
                            <img src="/images/showcase/lks_2026.jpg" alt="Lomba Kompetensi Siswa LKS Bidang Teknologi Provinsi Bali 2026" loading="lazy" class="w-full h-full object-cover">
                            <span class="absolute top-3.5 left-3.5 px-3 py-1 rounded bg-yellow-skensa text-ink text-xs font-extrabold uppercase">
                                Tuan Rumah &amp; Juara Umum LKS
                            </span>
                        </div>
                        <div class="p-6 space-y-3 flex-1 flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-widest text-yellow-skensa">Capaian Kota, Provinsi, Nasional &amp; Internasional</span>
                                <h3 class="font-display font-extrabold text-2xl text-paper mt-1">
                                    Dominasi Medali Lomba Kompetensi Siswa (LKS) &amp; Ajang Talenta Vokasi
                                </h3>
                                <p class="text-xs sm:text-sm text-paper/85 mt-2 leading-relaxed">
                                    SMK Negeri 1 Denpasar secara konsisten meraih medali emas pada ajang LKS tingkat Kota Denpasar, Provinsi Bali, hingga mewakili Bali di tingkat Nasional serta kolaborasi teknologi internasional.
                                </p>
                            </div>
                            <div class="pt-3 border-t border-paper/15 flex items-center justify-between text-xs font-bold text-yellow-skensa">
                                <span>Akademik, Teknologi &amp; Olahraga/Seni</span>
                                <a href="{{ route('achievements.index') }}" class="underline hover:text-paper">Lihat Semua &rarr;</a>
                            </div>
                        </div>
                    </div>

                    {{-- Daftar Kejuaraan dari Database --}}
                    <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        @foreach($achievements as $achievement)
                            <article class="p-6 rounded-2xl bg-paper border-2 border-ink flex flex-col justify-between hover:border-navy transition-colors">
                                <div>
                                    <div class="flex flex-wrap items-center gap-2 mb-3">
                                        <span class="px-2.5 py-1 rounded bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase">
                                            {{ $achievement->medal }}
                                        </span>
                                        <span class="px-2.5 py-1 rounded bg-navy text-paper text-[11px] font-bold uppercase">
                                            Tingkat {{ ucfirst($achievement->level) }}
                                        </span>
                                        <span class="text-xs font-bold text-ink-muted tabular-nums ml-auto">{{ $achievement->year }}</span>
                                    </div>
                                    <h3 class="font-display font-extrabold text-lg text-ink leading-snug">{{ $achievement->title }}</h3>
                                    <p class="text-xs text-ink-muted mt-1.5 leading-relaxed">{{ $achievement->competition_name }}</p>
                                </div>
                                <div class="mt-5 pt-3 border-t border-line flex items-center justify-between text-xs font-bold">
                                    <span class="text-navy truncate pr-2">{{ $achievement->winner_name }}</span>
                                    <span class="px-2.5 py-0.5 rounded bg-paper-2 border border-line text-ink shrink-0">
                                        {{ $achievement->major?->code ?? 'SKENSA' }}
                                    </span>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Bagian 5B: Organisasi Siswa (OSIS / MPK) & Ekstrakurikuler --}}
            <div class="pt-12 border-t-2 border-line">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                    {{-- Profil OSIS / MPK & Video SUBAKTI 2026 --}}
                    <div class="lg:col-span-5 space-y-6">
                        <div>
                            <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Kepemimpinan &amp; Bakat Siswa</span>
                            <h3 class="font-display font-extrabold text-3xl text-ink mt-1">
                                OSIS, MPK &amp; <span class="marker-highlight">Ekstrakurikuler</span>
                            </h3>
                            <p class="text-sm text-ink-muted mt-2 leading-relaxed">
                                Wadah aktualisasi kepemimpinan, olahraga, seni budaya Bali, dan klub inovasi teknologi melalui <strong>OSIS &amp; MPK SMK Negeri 1 Denpasar</strong>.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-paper border-2 border-ink overflow-hidden">
                            <img src="/images/showcase/paskibra_osis.jpg" alt="OSIS, MPK, dan Paskibra SMK Negeri 1 Denpasar" loading="lazy" class="w-full h-48 object-cover border-b-2 border-ink">
                            <div class="p-5 space-y-2">
                                <span class="px-2.5 py-0.5 rounded bg-navy text-yellow-skensa text-[10px] font-extrabold uppercase tracking-wider">
                                    Organisasi Kesiswaan Resmi
                                </span>
                                <h4 class="font-display font-extrabold text-lg text-ink">OSIS &amp; Majelis Perwakilan Kelas (MPK) SKENSA</h4>
                                <p class="text-xs text-ink-muted leading-relaxed">
                                    Motor penggerak agenda tahunan siswa seperti <strong>SUBAKTI (Skensa Unjuk Bakat dan Aksi)</strong>, <strong>HUT SKENSA</strong>, <strong>Gelora SKENSA</strong>, <strong>“When I Grow Up” Spirit Day!</strong>, dan <strong>Jegeg Bagus SKENSA</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- 4 Klaster Ekstrakurikuler & Dokumentasi SUBAKTI --}}
                    <div class="lg:col-span-7 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="p-5 rounded-2xl bg-paper border-2 border-ink">
                                <span class="px-2.5 py-1 rounded bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase">01 &bull; Kepemimpinan &amp; Bela Negara</span>
                                <h4 class="font-display font-extrabold text-lg text-ink mt-2.5">Paskibra, Pramuka &amp; PMR</h4>
                                <p class="text-xs text-ink-muted mt-1.5 leading-relaxed">
                                    Pramuka Wajib &amp; Regu Inti, Pasukan Pengibar Bendera (Paskibra SKENSA), Palang Merah Remaja (PMR), serta Kerohanian (KHD/KMK/Rohis).
                                </p>
                            </div>

                            <div class="p-5 rounded-2xl bg-paper border-2 border-ink">
                                <span class="px-2.5 py-1 rounded bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase">02 &bull; Teknologi &amp; Akademik</span>
                                <h4 class="font-display font-extrabold text-lg text-ink mt-2.5">IT Club, Robotik &amp; KIR</h4>
                                <p class="text-xs text-ink-muted mt-1.5 leading-relaxed">
                                    Skensa IT &amp; Cybersecurity Club, Robotik &amp; IoT, Kelompok Ilmiah Remaja (KIR), English Debate Club, dan Japanese Club.
                                </p>
                            </div>

                            <div class="p-5 rounded-2xl bg-paper border-2 border-ink">
                                <span class="px-2.5 py-1 rounded bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase">03 &bull; Olahraga &amp; Bela Diri</span>
                                <h4 class="font-display font-extrabold text-lg text-ink mt-2.5">Basket, Futsal, Voli &amp; Silat</h4>
                                <p class="text-xs text-ink-muted mt-1.5 leading-relaxed">
                                    Bola Basket, Bola Voli, Futsal &amp; Sepak Bola, Bulu Tangkis, Pencak Silat Bakti Negara, Karate, Taekwondo, dan E-Sports SKENSA.
                                </p>
                            </div>

                            <div class="p-5 rounded-2xl bg-paper border-2 border-ink">
                                <span class="px-2.5 py-1 rounded bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase">04 &bull; Seni, Budaya &amp; Media</span>
                                <h4 class="font-display font-extrabold text-lg text-ink mt-2.5">Tabuh/Tari Bali, Musik &amp; Jurnalistik</h4>
                                <p class="text-xs text-ink-muted mt-1.5 leading-relaxed">
                                    Seni Tabuh (Karawitan) &amp; Tari Tradisional Bali, Teater, Paduan Suara, Band/Musik Modern, serta Jurnalistik &amp; Sinematografi SKENSA.
                                </p>
                            </div>
                        </div>

                        {{-- Kartu Dokumentasi Agenda Tahunan SUBAKTI 2026 --}}
                        <div class="p-5 rounded-2xl bg-navy text-paper border-2 border-ink flex flex-col sm:flex-row items-center gap-5">
                            <img src="/images/showcase/subakti_2026.jpg" alt="SUBAKTI 2026 Skensa Unjuk Bakat dan Aksi" width="180" height="108" loading="lazy" class="w-full sm:w-44 h-28 rounded-xl object-cover border border-yellow-skensa/40 shrink-0">
                            <div class="space-y-2">
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-yellow-skensa">Dokumentasi Agenda Tahunan Kesiswaan</span>
                                <h4 class="font-display font-bold text-base sm:text-lg text-paper">
                                    Rangkaian Lomba SUBAKTI (Skensa Unjuk Bakat dan Aksi) 2026
                                </h4>
                                <div class="flex flex-wrap gap-3 pt-1">
                                    <a href="https://www.youtube.com/watch?v=Fsez1chT7Jw" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-yellow-skensa text-ink text-xs font-extrabold uppercase">
                                        <span>Tonton Video SUBAKTI 2026</span>
                                        <span>&nearr;</span>
                                    </a>
                                    <a href="https://www.youtube.com/watch?v=pKUz527SIPs" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-paper/10 text-paper text-xs font-bold uppercase hover:bg-paper/20">
                                        <span>Video HUT ke-63 SKENSA</span>
                                        <span>&nearr;</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- KATEGORI 6: BERITA, KALENDER AGENDA & INFORMASI LENGKAP PPDB / SPMB   --}}
    {{-- ===================================================================== --}}
    <section id="pengumuman-resmi" class="py-20 bg-paper border-b-2 border-ink">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
            {{-- Bagian 6A: Berita, Pengumuman & Kalender Agenda Kegiatan --}}
            <div>
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-navy">Media, Publikasi &amp; Kalender Akademik</span>
                        <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-1">
                            Berita, Pengumuman &amp; <span class="marker-highlight">Agenda</span>
                        </h2>
                    </div>
                    <a href="{{ route('publications.index') }}" class="text-xs font-bold uppercase tracking-wider text-navy hover:underline">
                        Lihat Seluruh Arsip Publikasi &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    {{-- Pengumuman Utama Kelulusan (lg:col-span-5) --}}
                    <div class="lg:col-span-5">
                        <div class="rounded-2xl bg-navy text-paper border-2 border-ink p-7 h-full flex flex-col justify-between shadow-lg">
                            <div class="space-y-4">
                                <span class="inline-block px-3 py-1 rounded-md bg-yellow-skensa text-ink font-display font-extrabold text-xs uppercase tracking-wider">
                                    Pengumuman Resmi &bull; 1 Mei 2025
                                </span>

                                <h3 class="font-display font-extrabold text-2xl text-paper leading-tight">
                                    Kelulusan Kelas XII Tahun Ajaran 2024/2025
                                </h3>

                                <p class="text-sm text-paper/85 leading-relaxed">
                                    Pengumuman kelulusan siswa kelas XII SMK Negeri 1 Denpasar tahun ajaran 2024/2025 ditetapkan pada tanggal <strong class="text-yellow-skensa">5 Mei 2025</strong> secara daring melalui portal resmi <strong class="text-yellow-skensa">https://lulus.smkn1denpasar.sch.id</strong> mulai pukul 08.00 WIB.
                                </p>
                            </div>

                            <div class="mt-6 pt-5 border-t border-paper/15 flex flex-wrap items-center gap-3">
                                <a
                                    href="https://lulus.smkn1denpasar.sch.id"
                                    target="_blank"
                                    rel="noopener"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-yellow-skensa text-ink font-display font-extrabold text-xs uppercase tracking-wider hover:bg-paper transition-colors"
                                >
                                    <span>Portal Kelulusan</span>
                                    <span>&nearr;</span>
                                </a>
                                <a
                                    href="{{ route('publications.index', ['kategori' => 'pengumuman']) }}"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-paper/10 text-paper font-bold text-xs uppercase tracking-wider hover:bg-paper/20 transition-colors"
                                >
                                    <span>Arsip Pengumuman</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Artikel Berita Terkini (lg:col-span-4) --}}
                    <div class="lg:col-span-4 flex flex-col gap-4">
                        @foreach($posts->take(2) as $post)
                            <article class="p-5 rounded-2xl bg-paper-2 border-2 border-ink flex flex-col justify-between hover:border-navy transition-colors flex-1">
                                <div>
                                    <div class="flex items-center justify-between gap-2 text-[11px] text-ink-muted mb-2">
                                        <span class="font-extrabold uppercase tracking-wider text-navy px-2 py-0.5 rounded bg-paper border border-line">
                                            {{ $post->category }}
                                        </span>
                                        <time datetime="{{ optional($post->published_at)->toDateString() }}" class="tabular-nums font-semibold">
                                            {{ optional($post->published_at)->translatedFormat('d M Y') ?? 'Mei 2025' }}
                                        </time>
                                    </div>
                                    <h3 class="font-display font-extrabold text-base text-ink leading-snug">
                                        <a href="{{ route('publications.show', $post->slug) }}" class="hover:text-navy">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="text-xs text-ink-muted mt-1.5 line-clamp-2 leading-relaxed">
                                        {{ $post->excerpt }}
                                    </p>
                                </div>
                                <a href="{{ route('publications.show', $post->slug) }}" class="mt-3 text-xs font-extrabold uppercase tracking-wider text-navy hover:underline">
                                    Baca Berita &rarr;
                                </a>
                            </article>
                        @endforeach
                    </div>

                    {{-- Kalender Akademik / Jadwal Agenda Kegiatan (lg:col-span-3) --}}
                    <div class="lg:col-span-3 rounded-2xl bg-paper-2 border-2 border-ink p-5 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-extrabold uppercase tracking-widest text-navy block mb-1">Kalender Akademik</span>
                            <h3 class="font-display font-extrabold text-lg text-ink mb-4 pb-2 border-b border-line">
                                Agenda &amp; Kegiatan
                            </h3>

                            <div class="space-y-3.5">
                                @forelse($events as $event)
                                    <div class="p-3 rounded-xl bg-paper border border-line">
                                        <span class="text-[10px] font-extrabold uppercase text-navy block tabular-nums">
                                            {{ optional($event->start_time)->translatedFormat('d F Y') }}
                                        </span>
                                        <h4 class="font-display font-bold text-xs text-ink mt-0.5 leading-snug">{{ $event->title }}</h4>
                                        <span class="text-[11px] text-ink-muted block mt-0.5">{{ $event->location }}</span>
                                    </div>
                                @empty
                                    <div class="p-3 rounded-xl bg-paper border border-line">
                                        <span class="text-[10px] font-extrabold uppercase text-navy block">Mei - Juli 2025</span>
                                        <h4 class="font-display font-bold text-xs text-ink mt-0.5">Pelaksanaan SPMB / PPDB Provinsi Bali</h4>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <a href="{{ route('publications.index') }}" class="mt-4 pt-3 border-t border-line text-xs font-extrabold uppercase tracking-wider text-navy hover:underline block">
                            Lihat Kalender Penuh &rarr;
                        </a>
                    </div>
                </div>
            </div>

            {{-- Bagian 6B: Pusat Informasi PPDB / SPMB SMK Negeri 1 Denpasar --}}
            <div id="informasi-ppdb" class="rounded-3xl bg-navy text-paper border-2 border-ink p-8 lg:p-12 shadow-xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                    {{-- Left Column: Juknis, Syarat & Tombol Pendaftaran / Brosur PDF --}}
                    <div class="lg:col-span-6 space-y-5">
                        <span class="inline-block px-3.5 py-1 rounded-full bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-widest">
                            Penerimaan Peserta Didik Baru (PPDB / SPMB)
                        </span>
                        <h3 class="font-display font-extrabold text-3xl sm:text-4xl text-paper leading-tight">
                            Informasi Pendaftaran Siswa Baru SMK Negeri 1 Denpasar
                        </h3>
                        <p class="text-sm text-paper/85 leading-relaxed">
                            Pendaftaran calon peserta didik baru SMK Negeri 1 Denpasar dilaksanakan secara daring (online) mengikuti Petunjuk Teknis Dinas Pendidikan, Kepemudaan, dan Olahraga Provinsi Bali.
                        </p>

                        <div class="p-5 rounded-2xl bg-navy-700/90 border border-paper/20 space-y-2.5">
                            <h4 class="font-display font-bold text-sm uppercase tracking-wider text-yellow-skensa">
                                Syarat Umum Pendaftaran:
                            </h4>
                            <ul class="space-y-1.5 text-xs sm:text-sm text-paper/90">
                                <li>&bull; Ijazah SMP/MTs/Sederajat atau Surat Keterangan Lulus asli.</li>
                                <li>&bull; Berusia paling tinggi 21 tahun pada tanggal 1 Juli tahun berjalan.</li>
                                <li>&bull; Kartu Keluarga (KK) dan Akta Kelahiran asli.</li>
                                <li>&bull; Nilai Rapor SMP/MTs Semester 1 s.d. Semester 5.</li>
                                <li>&bull; Surat Keterangan Sehat dan Tidak Buta Warna (untuk program keahlian teknik tertentu).</li>
                            </ul>
                        </div>

                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            <a
                                href="https://spmb.baliprov.go.id"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl bg-yellow-skensa text-ink font-display font-extrabold text-xs sm:text-sm uppercase tracking-wider hover:bg-paper transition-colors"
                            >
                                <span>Portal Pendaftaran Online</span>
                                <span>&nearr;</span>
                            </a>
                            <a
                                href="/media/brosur-ppdb-smkn1-denpasar.pdf"
                                download="Brosur-PPDB-SMKN1-Denpasar.pdf"
                                class="inline-flex items-center gap-2.5 px-5 py-3.5 rounded-xl bg-paper/10 border border-paper/30 text-paper font-display font-bold text-xs sm:text-sm uppercase tracking-wider hover:bg-paper/20 transition-colors"
                            >
                                <span>Unduh Brosur PPDB (PDF)</span>
                                <span>&darr;</span>
                            </a>
                        </div>
                    </div>

                    {{-- Right Column: Timeline 4 Tahapan Seleksi & Jalur PPDB --}}
                    <div class="lg:col-span-6 space-y-5">
                        <h4 class="font-display font-extrabold text-lg uppercase tracking-wider text-yellow-skensa">
                            Timeline Tahapan Seleksi &amp; Jalur Pendaftaran
                        </h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-5 rounded-2xl bg-paper/10 border border-paper/20">
                                <span class="px-2.5 py-0.5 rounded bg-yellow-skensa text-ink text-[10px] font-extrabold uppercase">Tahap 01 &bull; Juni</span>
                                <h5 class="font-display font-bold text-base text-paper mt-2">Sosialisasi &amp; Pembuatan Akun</h5>
                                <p class="text-xs text-paper/80 mt-1 leading-relaxed">
                                    Pengunduhan juknis, konsultasi pemilihan 12 konsentrasi keahlian, dan pembuatan akun pendaftaran daring.
                                </p>
                            </div>

                            <div class="p-5 rounded-2xl bg-paper/10 border border-paper/20">
                                <span class="px-2.5 py-0.5 rounded bg-yellow-skensa text-ink text-[10px] font-extrabold uppercase">Tahap 02 &bull; Juni</span>
                                <h5 class="font-display font-bold text-base text-paper mt-2">Pendaftaran &amp; Unggah Berkas</h5>
                                <p class="text-xs text-paper/80 mt-1 leading-relaxed">
                                    Pemilihan jalur seleksi (Afirmasi, Domisili/Zonasi, Prestasi Akademik/Non-Akademik, &amp; Ranking Nilai Rapor) serta verifikasi dokumen.
                                </p>
                            </div>

                            <div class="p-5 rounded-2xl bg-paper/10 border border-paper/20">
                                <span class="px-2.5 py-0.5 rounded bg-yellow-skensa text-ink text-[10px] font-extrabold uppercase">Tahap 03 &bull; Juli</span>
                                <h5 class="font-display font-bold text-base text-paper mt-2">Pengumuman Hasil Seleksi</h5>
                                <p class="text-xs text-paper/80 mt-1 leading-relaxed">
                                    Penetapan dan pengumuman resmi calon peserta didik yang diterima di SMK Negeri 1 Denpasar secara terbuka.
                                </p>
                            </div>

                            <div class="p-5 rounded-2xl bg-paper/10 border border-paper/20">
                                <span class="px-2.5 py-0.5 rounded bg-yellow-skensa text-ink text-[10px] font-extrabold uppercase">Tahap 04 &bull; Juli</span>
                                <h5 class="font-display font-bold text-base text-paper mt-2">Daftar Ulang &amp; MPLS</h5>
                                <p class="text-xs text-paper/80 mt-1 leading-relaxed">
                                    Pendaftaran ulang peserta didik baru dilanjutkan Masa Pengenalan Lingkungan Sekolah (MPLS) SKENSA.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- KATEGORI 7: KONTAK, SALURAN KOMUNIKASI & EMBED PETA GOOGLE MAPS       --}}
    {{-- ===================================================================== --}}
    <section id="lokasi-kontak" class="py-20 bg-paper-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-paper border-2 border-ink overflow-hidden shadow-lg grid grid-cols-1 lg:grid-cols-12">
                {{-- Kolom Kiri (lg:col-span-5): Informasi Lokasi, Alamat Kode Pos, Telepon/WA, Email & Medsos --}}
                <div class="lg:col-span-5 p-8 lg:p-10 flex flex-col justify-between space-y-6 border-b-2 lg:border-b-0 lg:border-r-2 border-ink">
                    <div class="space-y-4">
                        <span class="inline-block px-3 py-1 rounded bg-navy text-yellow-skensa text-xs font-extrabold uppercase tracking-widest">
                            Lokasi &amp; Saluran Komunikasi Resmi
                        </span>
                        <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-ink">
                            Hubungi SMK Negeri 1 Denpasar
                        </h2>

                        <div class="space-y-3 pt-2 text-sm">
                            <div>
                                <span class="block text-[11px] font-extrabold uppercase tracking-wider text-navy">Alamat Fisik Lengkap &amp; Kode Pos</span>
                                <p class="text-ink-muted mt-0.5 leading-relaxed">
                                    Jalan HOS. Cokroaminoto No. 84, Kelurahan Ubung, Kecamatan Denpasar Utara, Kota Denpasar, Provinsi Bali <strong class="text-ink">80118</strong>
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                                <div class="p-3.5 rounded-xl bg-paper-2 border border-line">
                                    <span class="block text-[10px] font-bold uppercase text-ink-muted">Telepon &amp; WhatsApp</span>
                                    <a href="https://wa.me/6281236396662" target="_blank" rel="noopener" class="font-display font-extrabold text-base text-navy hover:underline tabular-nums mt-0.5 block">
                                        {{ $settings['contact_phone'] ?? '081236396662' }}
                                    </a>
                                </div>

                                <div class="p-3.5 rounded-xl bg-paper-2 border border-line">
                                    <span class="block text-[10px] font-bold uppercase text-ink-muted">Email Resmi Sekolah</span>
                                    <a href="mailto:{{ $settings['contact_email'] ?? 'fo@smkn1denpasar.sch.id' }}" class="font-display font-extrabold text-sm text-navy hover:underline mt-0.5 block truncate">
                                        {{ $settings['contact_email'] ?? 'fo@smkn1denpasar.sch.id' }}
                                    </a>
                                </div>
                            </div>

                            <div>
                                <span class="block text-[11px] font-extrabold uppercase tracking-wider text-navy mb-2">Media Sosial Resmi SKENSA</span>
                                <div class="flex flex-wrap gap-2">
                                    <a href="https://instagram.com/smkn1denpasar" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-lg bg-paper-2 border border-line text-xs font-bold text-ink hover:bg-navy hover:text-paper transition-colors">
                                        Instagram
                                    </a>
                                    <a href="https://www.youtube.com/@smkn1denpasar" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-lg bg-paper-2 border border-line text-xs font-bold text-ink hover:bg-navy hover:text-paper transition-colors">
                                        YouTube
                                    </a>
                                    <a href="https://www.facebook.com/smknegeri1denpasar" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-lg bg-paper-2 border border-line text-xs font-bold text-ink hover:bg-navy hover:text-paper transition-colors">
                                        Facebook
                                    </a>
                                    <a href="https://www.tiktok.com/@smkn1denpasar" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-lg bg-paper-2 border border-line text-xs font-bold text-ink hover:bg-navy hover:text-paper transition-colors">
                                        TikTok
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-line flex flex-wrap gap-3">
                        <a
                            href="{{ route('contact.index') }}"
                            class="px-5 py-3 rounded-xl bg-navy text-paper font-display font-bold text-xs uppercase tracking-wider hover:bg-navy-700 transition-colors"
                        >
                            Kirim Pesan Form Humas &rarr;
                        </a>
                        <a
                            href="https://maps.app.goo.gl/5kRHGNBWvKrcPzVY6"
                            target="_blank"
                            rel="noopener"
                            class="px-4 py-3 rounded-xl bg-paper-2 border border-line text-ink font-display font-bold text-xs uppercase tracking-wider hover:border-navy transition-colors"
                        >
                            Buka Rute Maps &nearr;
                        </a>
                    </div>
                </div>

                {{-- Kolom Kanan (lg:col-span-7): Embed Peta Digital Google Maps Interaktif --}}
                <div class="lg:col-span-7 min-h-[380px] lg:min-h-full bg-navy/10 relative">
                    <iframe
                        title="Peta Lokasi SMK Negeri 1 Denpasar"
                        src="https://www.google.com/maps?q=SMK+Negeri+1+Denpasar+Jl.+HOS+Cokroaminoto+No.84+Denpasar&output=embed"
                        class="w-full h-full min-h-[380px] border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>
    </section>

@endsection
