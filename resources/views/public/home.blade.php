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
    {{-- ===================================================================== --}}
    {{-- SECTION 1: HERO MAJESTIC FULL-WIDTH BANNER & QUICK STATS (ALA SMANSA)  --}}
    {{-- ===================================================================== --}}
    <section class="relative min-h-[580px] lg:min-h-[640px] flex items-center bg-navy text-paper border-b-2 border-ink overflow-hidden">
        {{-- Background Media / Backdrop --}}
        <div class="absolute inset-0 z-0">
            <video
                autoplay
                muted
                loop
                playsinline
                preload="auto"
                poster="/images/showcase/drone_kampus.jpg"
                class="w-full h-full object-cover opacity-40 scale-105"
            >
                <source src="/media/intro.webm" type="video/webm">
                <source src="/media/intro.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-r from-navy via-navy/85 to-navy/35"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-navy via-transparent to-navy/40"></div>
        </div>

        {{-- Main Hero Container --}}
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-28 sm:py-20 lg:py-24 w-full">
            <div class="max-w-3xl space-y-5 sm:space-y-6">
                <div data-hero-badge class="inline-flex flex-wrap items-center gap-2 px-3.5 py-1.5 sm:px-4 sm:py-2 rounded-full bg-paper/10 backdrop-blur-md border border-yellow-skensa/50 text-yellow-skensa text-[11px] sm:text-xs md:text-sm font-bold uppercase tracking-widest shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-yellow-skensa shrink-0"></span>
                    <span>SMK Negeri 1 Denpasar &bull; {{ $settings['hero_highlight'] ?? '“When I Grow Up” Spirit Day!' }}</span>
                </div>

                <h1 data-hero-title class="font-display font-extrabold text-3xl sm:text-5xl lg:text-6xl text-paper leading-[1.12] sm:leading-[1.08] tracking-tight">
                    {{ $settings['school_slogan'] ?? 'Abhyāsad Dhäryate Vidyä.' }}
                    <span class="block text-yellow-skensa mt-2 sm:mt-3 text-xl sm:text-3xl lg:text-4xl font-bold">
                        "{{ $settings['school_slogan_meaning'] ?? 'Peliharalah ilmu sampai menjadi tradisi.' }}"
                    </span>
                </h1>

                <p class="text-paper/85 text-sm sm:text-base lg:text-lg leading-relaxed max-w-2xl">
                    Sekolah Menengah Kejuruan Pusat Keunggulan (SMK PK) berbasis <em>Teaching Factory</em> dan sertifikasi profesi berlisensi <strong>LSP-P1 BNSP</strong> di Provinsi Bali.
                </p>

                <div data-hero-cta class="flex flex-col sm:flex-row sm:items-center gap-3 pt-2">
                    <a
                        href="#informasi-ppdb"
                        data-magnetic
                        class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-xl bg-yellow-skensa text-ink font-display font-extrabold text-xs sm:text-sm uppercase tracking-wider border-2 border-yellow-skensa hover:bg-paper transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-skensa shadow-md text-center min-h-[44px]"
                    >
                        <span>Pendaftaran PPDB / SPMB</span>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <a
                            href="#fakultas-keahlian"
                            data-magnetic
                            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-xl bg-paper/10 backdrop-blur-md text-paper font-display font-bold text-xs sm:text-sm uppercase tracking-wider border border-paper/30 hover:bg-paper/20 hover:text-yellow-skensa transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-paper min-h-[44px] text-center"
                        >
                            <span>12 Jurusan</span>
                            <span aria-hidden="true">&darr;</span>
                        </a>
                        <button
                            type="button"
                            data-intro-replay
                            data-magnetic
                            class="inline-flex items-center justify-center gap-2 px-4 py-3.5 rounded-xl bg-paper/10 backdrop-blur-md text-paper font-display font-bold text-xs sm:text-sm uppercase tracking-wider border border-paper/25 hover:bg-paper/20 hover:text-yellow-skensa transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-paper min-h-[44px]"
                            title="Putar Ulang Animasi Logo Intro"
                        >
                            <svg class="w-4 h-4 text-yellow-skensa shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                            </svg>
                            <span class="hidden xs:inline">Intro</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Floating Quick Stats Bar (Mengambang di Kaki Banner Hero) --}}
        <div class="absolute bottom-0 inset-x-0 z-20 bg-navy-950/85 backdrop-blur-md border-t border-paper/15 py-3 sm:py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2.5 sm:gap-4 text-xs sm:text-sm font-semibold text-paper/90 divide-y-0 sm:divide-x divide-paper/10">
                    <div class="flex items-center gap-2.5 sm:gap-3 py-1 sm:px-3">
                        <span class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-yellow-skensa text-ink font-extrabold flex items-center justify-center shrink-0 text-xs sm:text-sm">A</span>
                        <div class="min-w-0">
                            <span class="block font-bold text-paper text-xs sm:text-sm truncate">Akreditasi A</span>
                            <span class="text-[10px] sm:text-[11px] text-paper/60 block truncate">BAN-S/M &bull; SMK PK</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5 sm:gap-3 py-1 sm:px-3">
                        <span class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-paper/15 text-yellow-skensa font-extrabold flex items-center justify-center shrink-0 text-xs sm:text-sm">2.6k</span>
                        <div class="min-w-0">
                            <span class="block font-bold text-paper text-xs sm:text-sm truncate">2.680+ Siswa</span>
                            <span class="text-[10px] sm:text-[11px] text-paper/60 block truncate">4.205 User LMS</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5 sm:gap-3 py-1 sm:px-3">
                        <span class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-paper/15 text-yellow-skensa font-extrabold flex items-center justify-center shrink-0 text-xs sm:text-sm">12</span>
                        <div class="min-w-0">
                            <span class="block font-bold text-paper text-xs sm:text-sm truncate">12 Jurusan</span>
                            <span class="text-[10px] sm:text-[11px] text-paper/60 block truncate">LSP-P1 BNSP</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5 sm:gap-3 py-1 sm:px-3">
                        <span class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-paper/15 text-yellow-skensa font-extrabold flex items-center justify-center shrink-0 text-xs sm:text-sm">185</span>
                        <div class="min-w-0">
                            <span class="block font-bold text-paper text-xs sm:text-sm truncate">185+ Guru</span>
                            <span class="text-[10px] sm:text-[11px] text-paper/60 block truncate">Pendidik Vokasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- SECTION 2: SAMBUTAN KEPALA SEKOLAH (2 KOLOM LAPANG ALA SMANSA)        --}}
    {{-- ===================================================================== --}}
    <section id="sambutan-kepala-sekolah" class="py-20 bg-paper-2 border-b-2 border-ink">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
                {{-- Kolom Kiri: Potret Kepala Sekolah dengan Floating Nameplate Badge ala SMANSA --}}
                <div class="lg:col-span-5 flex flex-col items-center">
                    <div class="relative w-full max-w-[360px] rounded-3xl overflow-hidden border-2 border-ink bg-navy shadow-xl group">
                        <img
                            src="/images/kepala-sekolah-i-wayan-mustika.jpg"
                            alt="I Wayan Mustika, S.Pd., M.Pd. - Kepala SMK Negeri 1 Denpasar"
                            width="400"
                            height="480"
                            loading="lazy"
                            class="w-full h-[400px] object-cover object-top group-hover:scale-103 transition-transform duration-500"
                        >
                        <div class="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-navy via-navy/80 to-transparent"></div>
                    </div>

                    {{-- Floating Nameplate Card (Seperti Gaya SMANSA) --}}
                    <div class="relative -mt-8 z-10 w-[90%] max-w-[330px] p-4 rounded-2xl bg-paper border-2 border-ink shadow-lg text-center">
                        <h3 class="font-display font-extrabold text-lg text-ink">
                            I Wayan Mustika, S.Pd., M.Pd.
                        </h3>
                        <p class="text-xs font-bold uppercase tracking-wider text-navy mt-0.5">
                            Kepala SMK Negeri 1 Denpasar
                        </p>
                        <span class="inline-block mt-2 px-2.5 py-0.5 rounded-md bg-yellow-skensa/20 border border-yellow-skensa/50 text-ink text-[10px] font-extrabold uppercase">
                            SMK Pusat Keunggulan &bull; LSP-P1 BNSP
                        </span>
                    </div>

                    {{-- Legalitas & Sejarah Singkat --}}
                    <div class="mt-4 text-center text-xs text-ink-muted">
                        <p>NPSN: <strong>50103118</strong> &bull; Berdiri: <strong>24 September 1962</strong></p>
                        <p>SK Pendirian: No. 17/D.J.P.T/B1/1962</p>
                    </div>
                </div>

                {{-- Kolom Kanan: Sambutan Resmi & Visi Misi --}}
                <div class="lg:col-span-7 space-y-6">
                    <div>
                        <span class="inline-block px-3 py-1 rounded-md bg-navy text-yellow-skensa text-xs font-extrabold uppercase tracking-widest">
                            Sambutan Kepala Sekolah
                        </span>
                        <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-3 leading-tight">
                            Mewujudkan Insan Vokasi yang Unggul, Berkarakter, dan Siap Kerja Global
                        </h2>
                    </div>

                    <div class="prose max-w-none text-ink text-sm sm:text-base leading-relaxed space-y-3">
                        <p class="font-semibold text-navy italic">
                            "Om Swastyastu, Assalamu’alaikum Warahmatullahi Wabarakatuh, Salam Sejahtera, Rahayu."
                        </p>
                        <p>
                            Selamat datang di situs resmi <strong>SMK Negeri 1 Denpasar (SKENSA)</strong>. Sejak berdiri pada tahun 1962 sebagai STM Negeri Denpasar, kami konsisten mengemban amanah melahirkan generasi teknisi dan insan kreatif yang tidak hanya menguasai keahlian industri terkini, namun juga berakar kuat pada nilai luhur semboyan <em>Abhyāsad Dhäryate Vidyä</em> (Peliharalah ilmu sampai menjadi tradisi).
                        </p>
                        <p>
                            Melalui kurikulum berbasis <em>Teaching Factory</em>, kemitraan strategis dengan puluhan industri nasional dan multinasional, serta sertifikasi keahlian berstandar nasional (LSP-P1 BNSP), kami memastikan setiap peserta didik siap melangkah ke dunia kerja, melanjutkan ke perguruan tinggi, maupun membangun wirausaha mandiri.
                        </p>
                    </div>

                    {{-- 4 Pilar Karakter SKENSA (SISIKOBER) --}}
                    <div class="pt-2">
                        <span class="block text-xs font-extrabold uppercase tracking-wider text-navy mb-3">
                            4 Pilar Budaya Kerja &amp; Karakter Siswa:
                        </span>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                            <div class="p-3 rounded-xl bg-paper border border-line text-center">
                                <span class="block font-display font-extrabold text-navy text-base">Siap</span>
                                <span class="text-[11px] text-ink-muted">Tangguh &amp; Siaga</span>
                            </div>
                            <div class="p-3 rounded-xl bg-paper border border-line text-center">
                                <span class="block font-display font-extrabold text-navy text-base">Kompeten</span>
                                <span class="text-[11px] text-ink-muted">Sertifikasi Profesi</span>
                            </div>
                            <div class="p-3 rounded-xl bg-paper border border-line text-center">
                                <span class="block font-display font-extrabold text-navy text-base">Disiplin</span>
                                <span class="text-[11px] text-ink-muted">Budaya Industri</span>
                            </div>
                            <div class="p-3 rounded-xl bg-paper border border-line text-center">
                                <span class="block font-display font-extrabold text-navy text-base">Beretika</span>
                                <span class="text-[11px] text-ink-muted">Kearifan Lokal</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        <a href="{{ route('profile.index') }}" class="px-5 py-2.5 rounded-xl bg-navy text-paper text-xs font-extrabold uppercase tracking-wider hover:bg-navy-700 transition-colors">
                            Profil &amp; Sejarah Sekolah &rarr;
                        </a>
                        <a href="{{ route('staff.index') }}" class="px-5 py-2.5 rounded-xl bg-paper border-2 border-ink text-ink text-xs font-extrabold uppercase tracking-wider hover:border-navy transition-colors">
                            Direktori Pimpinan &amp; Guru &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- SECTION 3: YOUTUBE CINEMA HUB (VIDEO BESAR + PLAYLIST KANAN)          --}}
    {{-- ===================================================================== --}}
    <section id="skensa-cinema-hub" class="py-20 bg-paper border-b-2 border-ink">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <span class="inline-block px-3 py-1 rounded-md bg-navy text-yellow-skensa text-xs font-extrabold uppercase tracking-widest">
                        Galeri Multimedia &amp; Video Resmi
                    </span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-3">
                        Eksplorasi Profil &amp; <span class="marker-highlight">Aktivitas Kampus</span>
                    </h2>
                </div>
                <a
                    href="https://www.youtube.com/@smkn1denpasar/videos"
                    target="_blank"
                    rel="noopener"
                    class="text-xs font-extrabold uppercase tracking-wider text-navy hover:underline"
                >
                    Kanal Resmi YouTube @smkn1denpasar &nearr;
                </a>
            </div>

            @php
                $cinemaVideos = [
                    [
                        'id' => 'uTDYUJLP3xY',
                        'title' => 'Profil Konsentrasi Keahlian (Jurusan) SMKN 1 Denpasar',
                        'category' => 'Profil Keahlian',
                        'desc' => 'Eksplorasi 9 program keahlian dan 12 konsentrasi keahlian di SMK Negeri 1 Denpasar berbasis industri dan sertifikasi LSP-P1 BNSP.',
                    ],
                    [
                        'id' => 'PGel3Be5L_E',
                        'title' => 'Pengalaman Belajar & Praktik Kejuruan di SMKN 1 Denpasar',
                        'category' => 'Kehidupan Kampus',
                        'desc' => 'Melihat langsung suasana belajar teori, praktik bengkel standar industri, kedisiplinan budaya kerja, dan atmosfer belajar di SKENSA.',
                    ],
                    [
                        'id' => 'Fsez1chT7Jw',
                        'title' => 'Rangkaian Lomba SUBAKTI (Skensa Unjuk Bakat dan Aksi) 2026',
                        'category' => 'Kesiswaan & Bakat',
                        'desc' => 'Ajang unjuk kreativitas, seni, bakat, kepemimpinan, dan sportivitas peserta didik antarkelas dan jenjang di SMK Negeri 1 Denpasar.',
                    ],
                    [
                        'id' => 'rJlYfmmF4ns',
                        'title' => 'GELORA SKENSA 2026 (Pentas Seni, Budaya & Dies Natalis)',
                        'category' => 'Seni & Budaya Bali',
                        'desc' => 'Perayaan puncak kreativitas siswa, pentas tari tradisi Bali, musik modern, serta perayaan kebersamaan keluarga besar civitas akademika.',
                    ],
                    [
                        'id' => '-_COP-1rjm8',
                        'title' => 'Lomba Kompetensi Siswa (LKS) Bidang Teknologi Provinsi Bali 2026',
                        'category' => 'Prestasi & Kejuaraan',
                        'desc' => 'Perjuangan dan prestasi kontingen siswa SKENSA dalam ajang kejuaraan keterampilan vokasi paling bergengsi tingkat provinsi dan nasional.',
                    ],
                    [
                        'id' => 'dhtzwyXzde4',
                        'title' => 'Uji Kompetensi Keahlian (UKK) SMK Negeri 1 Denpasar Tahun 2026',
                        'category' => 'Sertifikasi Profesi',
                        'desc' => 'Pengujian kompetensi keahlian siswa kelas XII yang dinilai langsung oleh asesor industri rekanan DUDIKA dan sertifikasi BNSP.',
                    ],
                    [
                        'id' => 'xddd6luVGYE',
                        'title' => 'Job Fair & Rekrutmen Bursa Kerja Khusus (BKK) SKENSA 2026',
                        'category' => 'Penyaluran Kerja',
                        'desc' => 'Penyaluran lulusan langsung ke dunia industri melalui bursa kerja khusus dan walk-in interview oleh puluhan perusahaan mitra.',
                    ],
                    [
                        'id' => 'V-t1AKQo0Uo',
                        'title' => 'Peresmian Daikin Center of Excellence di SMKN 1 Denpasar',
                        'category' => 'Mitra Industri DUDI',
                        'desc' => 'Kerja sama strategis peresmian laboratorium tata udara berstandar global PT Daikin Airconditioning Indonesia di SKENSA.',
                    ],
                ];
            @endphp

            {{-- Grid Video Cinema 12 Kolom (8 Kolom Player Kiri + 4 Kolom Playlist Kanan) --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                {{-- Kolom Kiri: Player Utama Layar Besar (lg:col-span-8) --}}
                <div class="lg:col-span-8 space-y-4">
                    <div class="relative aspect-video w-full rounded-2xl overflow-hidden border-2 border-ink bg-black shadow-2xl">
                        <iframe
                            id="cinema-main-iframe"
                            class="w-full h-full"
                            src="https://www.youtube.com/embed/uTDYUJLP3xY?rel=0"
                            title="Video Utama SKENSA"
                            loading="lazy"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                        ></iframe>
                    </div>

                    {{-- Metadata Video Aktif --}}
                    <div class="p-6 rounded-2xl bg-paper-2 border-2 border-ink flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <span id="cinema-active-badge" class="px-2.5 py-0.5 rounded bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase tracking-wider">
                                Profil Keahlian
                            </span>
                            <h3 id="cinema-active-title" class="font-display font-extrabold text-xl text-ink leading-snug">
                                Profil Konsentrasi Keahlian (Jurusan) SMKN 1 Denpasar
                            </h3>
                            <p id="cinema-active-desc" class="text-xs text-ink-muted leading-relaxed max-w-2xl">
                                Eksplorasi 9 program keahlian dan 12 konsentrasi keahlian di SMK Negeri 1 Denpasar berbasis industri dan sertifikasi LSP-P1 BNSP.
                            </p>
                        </div>
                        <a
                            id="cinema-active-link"
                            href="https://www.youtube.com/watch?v=uTDYUJLP3xY"
                            target="_blank"
                            rel="noopener"
                            class="px-4 py-2.5 rounded-xl bg-navy text-paper text-xs font-bold uppercase tracking-wider hover:bg-navy-700 transition-colors shrink-0 text-center"
                        >
                            Tonton di YouTube &nearr;
                        </a>
                    </div>
                </div>

                {{-- Playlist: Horizontal Touch Carousel di Mobile/Tablet, Vertikal Sidebar di Desktop (lg:col-span-4) --}}
                <div class="lg:col-span-4 rounded-2xl border-2 border-ink bg-paper-2 overflow-hidden flex flex-col lg:h-[580px] shadow-sm">
                    <div class="p-4 bg-navy text-paper border-b-2 border-ink flex items-center justify-between">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-yellow-skensa">Playlist Video Resmi</span>
                        <span class="text-[11px] font-bold text-paper/70">8 Video Pilihan &bull; Geser &rarr;</span>
                    </div>

                    {{-- Scroll Container: Horizontal di Mobile/Tablet, Vertikal di Desktop --}}
                    <div class="flex lg:flex-col overflow-x-auto lg:overflow-y-auto p-3 gap-3 lg:space-y-2.5 lg:gap-0 divide-y-0 lg:divide-y lg:divide-line/60 snap-x snap-mandatory touch-pan-x">
                        @foreach($cinemaVideos as $cIdx => $cVideo)
                            <button
                                type="button"
                                data-cinema-item
                                data-video-id="{{ $cVideo['id'] }}"
                                data-video-title="{{ $cVideo['title'] }}"
                                data-video-category="{{ $cVideo['category'] }}"
                                data-video-desc="{{ $cVideo['desc'] }}"
                                class="w-64 sm:w-72 lg:w-full shrink-0 snap-start text-left p-3 rounded-xl transition-all cursor-pointer flex gap-3 items-center group {{ $cIdx === 0 ? 'bg-navy text-paper shadow-md' : 'hover:bg-paper text-ink bg-paper/60 lg:bg-transparent border border-line/40 lg:border-0' }}"
                            >
                                <div class="relative w-24 h-16 sm:w-28 sm:h-18 rounded-lg overflow-hidden shrink-0 border border-ink/40 bg-navy-800">
                                    <img
                                        src="https://img.youtube.com/vi/{{ $cVideo['id'] }}/mqdefault.jpg"
                                        alt="{{ $cVideo['title'] }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform"
                                    >
                                    <span class="absolute bottom-1 right-1 px-1.5 py-0.2 rounded bg-black/80 text-[9px] font-bold text-white">YT</span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <span class="block text-[10px] font-extrabold uppercase tracking-wider {{ $cIdx === 0 ? 'text-yellow-skensa' : 'text-navy' }}" data-item-cat>
                                        {{ $cVideo['category'] }}
                                    </span>
                                    <h4 class="font-display font-bold text-xs line-clamp-2 leading-snug mt-0.5" data-item-title>
                                        {{ $cVideo['title'] }}
                                    </h4>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- SECTION 4: FASILITAS PENUNJANG PEMBELAJARAN (BENGKEL, LAB & SARANA)   --}}
    {{-- ===================================================================== --}}
    <section id="fasilitas-kampus" class="py-20 bg-paper-2 border-b-2 border-ink">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Infrastruktur Kampus 16.610 m&sup2;</span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-1">
                        Fasilitas Penunjang <span class="marker-highlight">Pembelajaran &amp; Praktik</span>
                    </h2>
                </div>
                <a href="{{ route('gallery.index') }}" class="text-xs font-extrabold uppercase tracking-wider text-navy hover:underline">
                    Lihat Galeri Fasilitas Lengkap &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- 1. Laboratorium Jaringan Komputer & Fiber Optik (TKJ) --}}
                <div class="rounded-2xl bg-paper border-2 border-ink overflow-hidden flex flex-col justify-between shadow-xs hover:border-navy transition-all">
                    <div class="relative h-52 bg-navy border-b-2 border-ink overflow-hidden">
                        <img src="/images/showcase/lab_fiber.jpg" alt="Praktik Splicing Fiber Optik Jurusan Teknik Komputer dan Jaringan (TKJ) SMKN 1 Denpasar" loading="lazy" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-md bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase tracking-wider">
                            Jurusan TKJ
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-display font-extrabold text-lg text-ink">Laboratorium Jaringan &amp; Fiber Optik (TKJ)</h3>
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
                <div class="rounded-2xl bg-paper border-2 border-ink overflow-hidden flex flex-col justify-between shadow-xs hover:border-navy transition-all">
                    <div class="relative h-52 bg-navy border-b-2 border-ink overflow-hidden">
                        <img src="/images/showcase/ukk_2026.jpg" alt="Praktik Konstruksi dan Uji Kompetensi Keahlian TKP SMKN 1 Denpasar" loading="lazy" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-md bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase tracking-wider">
                            Jurusan TKP &amp; DPIB
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-display font-extrabold text-lg text-ink">Workshop Konstruksi Gedung &amp; Studio BIM</h3>
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
                <div class="rounded-2xl bg-paper border-2 border-ink overflow-hidden flex flex-col justify-between shadow-xs hover:border-navy transition-all">
                    <div class="relative h-52 bg-navy border-b-2 border-ink overflow-hidden">
                        <img src="/images/showcase/daikin_coe.jpg" alt="Peresmian Daikin Center of Excellence SMKN 1 Denpasar" loading="lazy" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-md bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase tracking-wider">
                            Center of Excellence
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-display font-extrabold text-lg text-ink">Daikin Center of Excellence &amp; Bengkel Rekayasa</h3>
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
                <div class="rounded-2xl bg-paper border-2 border-ink overflow-hidden flex flex-col justify-between shadow-xs hover:border-navy transition-all">
                    <div class="relative h-52 bg-navy border-b-2 border-ink overflow-hidden">
                        <img src="/images/showcase/lapangan_upacara.jpg" alt="Lapangan Olahraga, Perpustakaan, dan Aula SMKN 1 Denpasar" loading="lazy" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-md bg-yellow-skensa text-ink text-[11px] font-extrabold uppercase tracking-wider">
                            Sarana Umum Kampus
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-display font-extrabold text-lg text-ink">Perpustakaan Digital (e-Library), Lapangan &amp; Aula</h3>
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
    </section>

    {{-- ===================================================================== --}}
    {{-- SECTION 5: 12 JURUSAN FULL-SCREEN HORIZONTAL SLIDER (DESKRIPSI KIRI)  --}}
    {{-- ===================================================================== --}}
    @php
        $majorSlidePhotos = [
            'TKJ'   => '/images/showcase/lab_fiber.jpg',
            'TKP'   => '/images/showcase/ukk_2026.jpg',
            'DPIB'  => '/images/showcase/ukk_2026.jpg',
            'TPTUP' => '/images/showcase/daikin_coe.jpg',
            'RPL'   => '/images/showcase/lks_2026.jpg',
            'DKV'   => '/images/showcase/pengalaman_belajar.jpg',
            'PRF'   => '/images/showcase/pengalaman_belajar.jpg',
            'TITL'  => '/images/showcase/daikin_coe.jpg',
            'TAV'   => '/images/showcase/lab_fiber.jpg',
            'ELIN'  => '/images/showcase/lab_fiber.jpg',
            'TPM'   => '/images/showcase/daikin_coe.jpg',
            'TKR'   => '/images/showcase/daikin_coe.jpg',
            'TSM'   => '/images/showcase/daikin_coe.jpg',
        ];
    @endphp
    <section id="fakultas-keahlian" class="relative min-h-[85vh] lg:min-h-[92vh] flex flex-col justify-between bg-navy text-paper border-b-2 border-ink overflow-hidden py-10 lg:py-14 select-none">
        {{-- Section Top Header Bar --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10 flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
            <div>
                <span class="inline-block px-3 py-1 rounded bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-widest">
                    Direktori Akademik &amp; Konsentrasi Keahlian
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-paper mt-2">
                    12 Konsentrasi Keahlian Unggulan SKENSA
                </h2>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-xs font-bold uppercase tracking-wider text-paper/70">
                    Geser Kiri/Kanan &bull; <strong id="major-slider-indicator" class="text-yellow-skensa font-mono font-extrabold">01 / {{ str_pad((string)$majors->count(), 2, '0', STR_PAD_LEFT) }}</strong>
                </span>
                <div class="flex items-center gap-2">
                    <button
                        type="button"
                        id="major-slide-prev"
                        aria-label="Jurusan Sebelumnya"
                        class="w-10 h-10 rounded-xl bg-paper/10 border border-paper/30 hover:bg-yellow-skensa hover:text-ink text-paper flex items-center justify-center transition-colors cursor-pointer"
                    >
                        &larr;
                    </button>
                    <button
                        type="button"
                        id="major-slide-next"
                        aria-label="Jurusan Berikutnya"
                        class="w-10 h-10 rounded-xl bg-paper/10 border border-paper/30 hover:bg-yellow-skensa hover:text-ink text-paper flex items-center justify-center transition-colors cursor-pointer"
                    >
                        &rarr;
                    </button>
                </div>
            </div>
        </div>

        {{-- Full Screen Horizontal Carousel Viewport --}}
        <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex-1 flex items-center z-10">
            <div id="major-slider-viewport" class="relative w-full overflow-hidden rounded-3xl border-2 border-paper/20 shadow-2xl bg-black">
                <div id="major-slider-track" class="flex transition-transform duration-500 ease-out" style="transform: translateX(0%);">
                    @foreach($majors as $mIdx => $mItem)
                        @php
                            $slideImg = $mItem->image ?: ($majorSlidePhotos[strtoupper($mItem->code)] ?? '/images/showcase/drone_kampus.jpg');
                        @endphp
                        <div class="w-full shrink-0 relative h-[68vh] min-h-[460px] sm:h-[560px] lg:h-[620px] overflow-hidden" data-major-slide-index="{{ $mIdx }}">
                            {{-- Background Image with Gradient Overlay --}}
                            <img
                                src="{{ $slideImg }}"
                                alt="{{ $mItem->name }}"
                                class="w-full h-full object-cover object-center"
                                loading="lazy"
                            >
                            {{-- Heavy Gradient Overlay for Bottom-Left Text Clarity --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-950/80 to-transparent"></div>
                            <div class="absolute inset-0 bg-gradient-to-r from-navy-950/90 via-navy-950/50 to-transparent"></div>

                            {{-- Badge Top Right --}}
                            <div class="absolute top-4 right-4 sm:top-6 sm:right-6 flex items-center gap-2">
                                <span class="px-3 py-1 sm:px-3.5 sm:py-1.5 rounded-xl bg-yellow-skensa text-ink font-display font-extrabold text-xs sm:text-sm uppercase tracking-wider shadow-lg">
                                    {{ $mItem->code }}
                                </span>
                                <span class="hidden sm:inline-block px-3 py-1.5 rounded-xl bg-navy/90 backdrop-blur-md border border-paper/20 text-paper text-xs font-bold uppercase tracking-wider">
                                    {{ $mItem->field?->name }}
                                </span>
                            </div>

                            {{-- DESKRIPSI SINGKAT DI BAGIAN KIRI BAWAH --}}
                            <div class="absolute bottom-4 left-4 right-4 sm:right-auto sm:bottom-10 sm:left-10 max-w-2xl space-y-2.5 sm:space-y-4">
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-md bg-paper/20 backdrop-blur-md border border-yellow-skensa/60 text-yellow-skensa font-mono font-extrabold text-[10px] sm:text-xs uppercase tracking-widest">
                                        {{ str_pad((string)($mIdx + 1), 2, '0', STR_PAD_LEFT) }} / {{ str_pad((string)$majors->count(), 2, '0', STR_PAD_LEFT) }} &bull; JURUSAN
                                    </span>
                                    <span class="text-[10px] sm:text-xs font-bold text-paper/70 uppercase">
                                        LSP-P1 BNSP
                                    </span>
                                </div>

                                <h3 class="font-display font-extrabold text-xl sm:text-3xl lg:text-4xl text-paper leading-tight tracking-tight">
                                    {{ $mItem->name }}
                                </h3>

                                <p class="text-xs sm:text-sm text-paper/85 leading-relaxed line-clamp-2 sm:line-clamp-3 max-w-xl">
                                    {{ $mItem->description ?: $mItem->summary }}
                                </p>

                                @if(!empty($mItem->career_prospects))
                                    <div class="hidden sm:flex flex-wrap gap-1.5 pt-0.5 sm:pt-1">
                                        @foreach(array_slice((array) $mItem->career_prospects, 0, 3) as $prospect)
                                            <span class="text-[10px] sm:text-[11px] font-semibold px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-lg bg-paper/10 backdrop-blur-xs border border-paper/20 text-yellow-skensa">
                                                {{ $prospect }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="pt-1 sm:pt-2">
                                    <a
                                        href="{{ route('majors.show', $mItem->slug) }}"
                                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 sm:px-6 sm:py-3 rounded-xl bg-yellow-skensa text-ink hover:bg-paper font-display font-extrabold text-xs uppercase tracking-wider transition-colors shadow-lg min-h-[44px]"
                                    >
                                        <span>Lihat Detail Jurusan</span>
                                        <span aria-hidden="true">&rarr;</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Dots Pagination di Bawah Slider --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10 flex items-center justify-center gap-2 pt-6">
            @foreach($majors as $dIdx => $dItem)
                <button
                    type="button"
                    data-major-dot="{{ $dIdx }}"
                    aria-label="Pilih Jurusan {{ $dItem->code }}"
                    class="h-2 rounded-full transition-all cursor-pointer {{ $dIdx === 0 ? 'w-8 bg-yellow-skensa' : 'w-2 bg-paper/30 hover:bg-paper/60' }}"
                ></button>
            @endforeach
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. YouTube Cinema Hub Switcher
            const cinemaItems = document.querySelectorAll('[data-cinema-item]');
            const mainIframe = document.getElementById('cinema-main-iframe');
            const activeBadge = document.getElementById('cinema-active-badge');
            const activeTitle = document.getElementById('cinema-active-title');
            const activeDesc = document.getElementById('cinema-active-desc');
            const activeLink = document.getElementById('cinema-active-link');

            cinemaItems.forEach(item => {
                item.addEventListener('click', () => {
                    const videoId = item.getAttribute('data-video-id');
                    const videoTitle = item.getAttribute('data-video-title');
                    const videoCategory = item.getAttribute('data-video-category');
                    const videoDesc = item.getAttribute('data-video-desc');

                    if (mainIframe) {
                        mainIframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
                    }
                    if (activeBadge) activeBadge.textContent = videoCategory;
                    if (activeTitle) activeTitle.textContent = videoTitle;
                    if (activeDesc) activeDesc.textContent = videoDesc;
                    if (activeLink) activeLink.href = `https://www.youtube.com/watch?v=${videoId}`;

                    cinemaItems.forEach(el => {
                        const isCurrent = el === item;
                        const catSpan = el.querySelector('[data-item-cat]');
                        if (isCurrent) {
                            el.classList.add('bg-navy', 'text-paper', 'shadow-md');
                            el.classList.remove('hover:bg-paper', 'text-ink');
                            if (catSpan) {
                                catSpan.classList.add('text-yellow-skensa');
                                catSpan.classList.remove('text-navy');
                            }
                        } else {
                            el.classList.remove('bg-navy', 'text-paper', 'shadow-md');
                            el.classList.add('hover:bg-paper', 'text-ink');
                            if (catSpan) {
                                catSpan.classList.remove('text-yellow-skensa');
                                catSpan.classList.add('text-navy');
                            }
                        }
                    });
                });
            });

            // 2. 12 Jurusan Full-Screen Horizontal Slider
            const sliderTrack = document.getElementById('major-slider-track');
            const prevBtn = document.getElementById('major-slide-prev');
            const nextBtn = document.getElementById('major-slide-next');
            const indicator = document.getElementById('major-slider-indicator');
            const dots = document.querySelectorAll('[data-major-dot]');
            const totalSlides = dots.length;
            let currentSlide = 0;

            const updateSlider = (index) => {
                currentSlide = (index + totalSlides) % totalSlides;
                if (sliderTrack) {
                    sliderTrack.style.transform = `translateX(-${currentSlide * 100}%)`;
                }
                if (indicator) {
                    const padCur = String(currentSlide + 1).padStart(2, '0');
                    const padTot = String(totalSlides).padStart(2, '0');
                    indicator.textContent = `${padCur} / ${padTot}`;
                }
                dots.forEach((dot, dIdx) => {
                    if (dIdx === currentSlide) {
                        dot.classList.add('w-8', 'bg-yellow-skensa');
                        dot.classList.remove('w-2', 'bg-paper/30', 'hover:bg-paper/60');
                    } else {
                        dot.classList.remove('w-8', 'bg-yellow-skensa');
                        dot.classList.add('w-2', 'bg-paper/30', 'hover:bg-paper/60');
                    }
                });
            };

            prevBtn?.addEventListener('click', () => updateSlider(currentSlide - 1));
            nextBtn?.addEventListener('click', () => updateSlider(currentSlide + 1));

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const idx = parseInt(dot.getAttribute('data-major-dot'), 10);
                    if (!isNaN(idx)) updateSlider(idx);
                });
            });

            // Touch / Swipe support
            const viewport = document.getElementById('major-slider-viewport');
            let startX = 0;
            let endX = 0;

            viewport?.addEventListener('touchstart', (e) => {
                startX = e.changedTouches[0].screenX;
            }, { passive: true });

            viewport?.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].screenX;
                if (startX - endX > 45) {
                    updateSlider(currentSlide + 1);
                } else if (endX - startX > 45) {
                    updateSlider(currentSlide - 1);
                }
            }, { passive: true });

            // Keyboard Arrow navigation when in view
            document.addEventListener('keydown', (e) => {
                const section = document.getElementById('fakultas-keahlian');
                if (!section) return;
                const rect = section.getBoundingClientRect();
                const inView = rect.top < window.innerHeight && rect.bottom > 0;
                if (!inView) return;

                if (e.key === 'ArrowLeft') {
                    updateSlider(currentSlide - 1);
                } else if (e.key === 'ArrowRight') {
                    updateSlider(currentSlide + 1);
                }
            });
        });
    </script>

@endsection
