@extends('layouts.public')

@section('title', ($settings['school_name'] ?? 'SMK Negeri 1 Denpasar') . ' - ' . ($settings['school_slogan'] ?? 'Abhyāsad Dhäryate Vidyä.'))

@section('content')

    {{-- Remotion Cinematic Intro Overlay (Full-Screen GSAP Split Curtain) --}}
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
                muted
                playsinline
                poster="/media/intro.jpg"
                class="w-full h-full object-cover"
            >
                <source src="/media/intro.mp4" type="video/mp4">
                <source src="/media/intro.webm" type="video/webm">
            </video>

            <div class="absolute bottom-7 inset-x-0 px-6 sm:px-12 flex items-center justify-between text-paper/85 text-xs font-bold uppercase tracking-widest">
                <span class="hidden sm:inline">SMK NEGERI 1 DENPASAR &bull; SKENSA BALI</span>
                <button
                    type="button"
                    data-intro-skip
                    class="ml-auto px-5 py-2.5 rounded-xl bg-yellow-skensa text-ink font-extrabold hover:bg-paper transition-colors shadow-lg cursor-pointer"
                >
                    Lewati Intro [Skip]
                </button>
            </div>
        </div>
    </div>

    {{-- Section 1: Full-Width Academic Tech Hero (Stanford / MIT Style with Remotion Video Backdrop) --}}
    <section class="relative min-h-[86vh] flex items-center bg-navy text-paper border-b-2 border-ink overflow-hidden">
        {{-- Background Remotion Video with Multi-Layer Academic Dark Overlay --}}
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
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-end">
                {{-- Left Column: Academic Manifesto & Motto --}}
                <div class="lg:col-span-8 space-y-6">
                    <div data-hero-badge class="inline-flex flex-wrap items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-paper/10 backdrop-blur-md border border-paper/20 text-yellow-skensa text-xs font-bold uppercase tracking-widest">
                        <span class="w-2 h-2 rounded-full bg-yellow-skensa"></span>
                        <span>SMK Negeri 1 Denpasar &bull; {{ $settings['hero_highlight'] ?? '“When I Grow Up” Spirit Day!' }}</span>
                    </div>

                    <h1 data-hero-title class="font-display font-extrabold text-4xl sm:text-5xl lg:text-6xl text-paper leading-[1.06] tracking-tight">
                        {{ $settings['school_slogan'] ?? 'Abhyāsad Dhäryate Vidyä.' }}
                        <span class="block text-yellow-skensa mt-2 text-2xl sm:text-4xl lg:text-5xl">
                            "{{ $settings['school_slogan_meaning'] ?? 'Peliharalah ilmu sampai menjadi tradisi.' }}"
                        </span>
                    </h1>

                    <p data-hero-sub class="text-base sm:text-lg text-paper/85 leading-relaxed max-w-2xl">
                        Institusi pendidikan kejuruan teknologi, rekayasa, teknologi informasi, dan industri kreatif di Jalan HOS. Cokroaminoto No. 84 Denpasar, Bali dengan <strong class="text-yellow-skensa">9 Program Keahlian</strong> dan <strong class="text-yellow-skensa">12 Konsentrasi Keahlian</strong>.
                    </p>

                    <div data-hero-cta class="flex flex-wrap items-center gap-4 pt-2">
                        <a
                            href="#fakultas-keahlian"
                            data-magnetic
                            class="inline-flex items-center gap-3 px-6 py-3.5 rounded-xl bg-yellow-skensa text-ink font-display font-extrabold text-sm uppercase tracking-wider border-2 border-yellow-skensa hover:bg-paper transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-skensa"
                        >
                            <span>Jelajahi 9 Program &amp; 12 Jurusan</span>
                            <span aria-hidden="true">&darr;</span>
                        </a>
                        <a
                            href="#pengumuman-resmi"
                            data-magnetic
                            class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-paper/10 backdrop-blur-md text-paper font-display font-bold text-sm uppercase tracking-wider border border-paper/25 hover:bg-paper/20 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-paper"
                        >
                            <span>Pengumuman Kelulusan</span>
                        </a>
                        <button
                            type="button"
                            data-intro-replay
                            data-magnetic
                            class="inline-flex items-center gap-2 px-5 py-3.5 rounded-xl bg-paper/10 backdrop-blur-md text-paper font-display font-bold text-sm uppercase tracking-wider border border-paper/25 hover:bg-paper/20 hover:text-yellow-skensa transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-paper"
                            title="Putar Ulang Animasi Logo Intro"
                        >
                            <svg class="w-4 h-4 text-yellow-skensa shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                            </svg>
                            <span>Putar Intro</span>
                        </button>
                    </div>
                </div>

                {{-- Right Column: Authentic Institutional Metrics Card --}}
                <div data-hero-media class="lg:col-span-4">
                    <div data-tilt class="rounded-2xl bg-navy-700/80 backdrop-blur-md border border-paper/20 p-6 space-y-5 shadow-2xl">
                        <div class="flex items-center justify-between border-b border-paper/15 pb-3.5">
                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-widest text-yellow-skensa">Identitas Resmi SKENSA</span>
                                <h2 class="font-display font-bold text-base text-paper mt-0.5">Data Akademik &amp; Digital</h2>
                            </div>
                            <img src="/images/logo_emblem.png" alt="Lambang SMKN 1 Denpasar" width="36" height="36" class="w-9 h-9 object-contain">
                        </div>

                        <div class="grid grid-cols-2 gap-3.5">
                            <div class="p-3.5 rounded-xl bg-navy/70 border border-paper/10">
                                <span class="font-display font-extrabold text-2xl text-yellow-skensa tabular-nums">{{ $fields->count() ?: 9 }}</span>
                                <span class="block text-[11px] font-semibold uppercase tracking-wider text-paper/75 mt-1">Program Keahlian</span>
                            </div>
                            <div class="p-3.5 rounded-xl bg-navy/70 border border-paper/10">
                                <span class="font-display font-extrabold text-2xl text-yellow-skensa tabular-nums">{{ $majors->count() ?: 12 }}</span>
                                <span class="block text-[11px] font-semibold uppercase tracking-wider text-paper/75 mt-1">Konsentrasi Keahlian</span>
                            </div>
                            <div class="p-3.5 rounded-xl bg-navy/70 border border-paper/10">
                                <span class="font-display font-extrabold text-2xl text-paper tabular-nums">{{ $settings['stats_active_lms_users'] ?? '4.205' }}</span>
                                <span class="block text-[11px] font-semibold uppercase tracking-wider text-paper/75 mt-1">Pengguna Aktif LMS</span>
                            </div>
                            <div class="p-3.5 rounded-xl bg-navy/70 border border-paper/10">
                                <span class="font-display font-extrabold text-2xl text-paper tabular-nums">{{ $settings['stats_courses_modules'] ?? '135' }}+</span>
                                <span class="block text-[11px] font-semibold uppercase tracking-wider text-paper/75 mt-1">Kursus e-Learning</span>
                            </div>
                        </div>

                        <div class="pt-1 flex items-center justify-between text-xs text-paper/80">
                            <span>Telepon: <strong class="text-yellow-skensa tabular-nums">{{ $settings['contact_phone'] ?? '081236396662' }}</strong></span>
                            <a href="mailto:{{ $settings['contact_email'] ?? 'fo@smkn1denpasar.sch.id' }}" class="underline hover:text-yellow-skensa">
                                {{ $settings['contact_email'] ?? 'fo@smkn1denpasar.sch.id' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Quick Portal Bar (4 Official Ecosystem Links from smkn1denpasar.sch.id) --}}
            <div class="mt-14 pt-6 border-t border-paper/15 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
                <a href="https://lib.smkn1denpasar.sch.id" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-xl bg-paper/5 border border-paper/10 hover:bg-paper/15 transition-colors group">
                    <span class="w-9 h-9 rounded-lg bg-yellow-skensa/20 text-yellow-skensa flex items-center justify-center font-display font-extrabold text-xs shrink-0">LIB</span>
                    <div>
                        <span class="block font-bold text-paper group-hover:text-yellow-skensa uppercase tracking-wider">e-Library</span>
                        <span class="text-paper/65 text-[11px]">lib.smkn1denpasar.sch.id &nearr;</span>
                    </div>
                </a>
                <a href="https://lms.skensa.id" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-xl bg-paper/5 border border-paper/10 hover:bg-paper/15 transition-colors group">
                    <span class="w-9 h-9 rounded-lg bg-yellow-skensa/20 text-yellow-skensa flex items-center justify-center font-display font-extrabold text-xs shrink-0">LMS</span>
                    <div>
                        <span class="block font-bold text-paper group-hover:text-yellow-skensa uppercase tracking-wider">e-Learning SKENSA</span>
                        <span class="text-paper/65 text-[11px]">lms.skensa.id &nearr;</span>
                    </div>
                </a>
                <a href="https://tracervokasi.kemendikdasmen.go.id" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-xl bg-paper/5 border border-paper/10 hover:bg-paper/15 transition-colors group">
                    <span class="w-9 h-9 rounded-lg bg-yellow-skensa/20 text-yellow-skensa flex items-center justify-center font-display font-extrabold text-xs shrink-0">TRV</span>
                    <div>
                        <span class="block font-bold text-paper group-hover:text-yellow-skensa uppercase tracking-wider">Tracer Vokasi</span>
                        <span class="text-paper/65 text-[11px]">tracervokasi.kemendikdasmen.go.id &nearr;</span>
                    </div>
                </a>
                <a href="https://lsp-smkn1denpasar.id" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-xl bg-paper/5 border border-paper/10 hover:bg-paper/15 transition-colors group">
                    <span class="w-9 h-9 rounded-lg bg-yellow-skensa/20 text-yellow-skensa flex items-center justify-center font-display font-extrabold text-xs shrink-0">LSP</span>
                    <div>
                        <span class="block font-bold text-paper group-hover:text-yellow-skensa uppercase tracking-wider">LSP SMKN 1 Denpasar</span>
                        <span class="text-paper/65 text-[11px]">lsp-smkn1denpasar.id &nearr;</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Section 2: Infinite Marquee of Verified Industry Partners (DUDIKA) with Authentic Logos --}}
    <section class="bg-paper-2 border-b-2 border-ink py-7 overflow-hidden select-none">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-3 flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-widest text-navy">
                Jejaring Mitra Industri &amp; Dunia Kerja (DUDIKA) SKENSA:
            </span>
            <span class="hidden sm:inline text-[11px] font-semibold text-ink-muted">
                Arahkan Kursor untuk Menghentikan
            </span>
        </div>

        <div class="relative w-full overflow-hidden mask-gradient-x">
            <div class="animate-marquee flex items-center gap-6 py-2">
                @php
                    $partners = [
                        ['name' => 'PT Astra Honda Motor', 'desc' => 'Mitra Otomotif & Sepeda Motor', 'logo' => '/images/partners/honda.svg'],
                        ['name' => 'Toyota Auto2000 Bali', 'desc' => 'Mitra Teknik Kendaraan Ringan', 'logo' => '/images/partners/toyota.svg'],
                        ['name' => 'PT Telkom Indonesia', 'desc' => 'Mitra Komputer & Telekomunikasi', 'logo' => '/images/partners/telkom.svg'],
                        ['name' => 'Daikin Air Conditioning', 'desc' => 'Mitra Teknik Pendingin & Tata Udara', 'logo' => '/images/partners/daikin.svg'],
                        ['name' => 'PT PLN (Persero)', 'desc' => 'Mitra Ketenagalistrikan', 'logo' => '/images/partners/pln.svg'],
                        ['name' => 'Schneider Electric', 'desc' => 'Mitra Otomasi & Listrik Industri', 'logo' => '/images/partners/schneider.svg'],
                        ['name' => 'PT Yamaha Motor Bali', 'desc' => 'Mitra Praktik Otomotif Roda Dua', 'logo' => '/images/partners/yamaha.svg'],
                        ['name' => 'Imaji Kryamaha Software', 'desc' => 'Mitra Rekayasa Perangkat Lunak', 'logo' => '/images/partners/imaji.svg'],
                        ['name' => 'PT Casa Amertha Arsitektur', 'desc' => 'Mitra Desain & Konstruksi Bangunan', 'logo' => '/images/partners/casa_amertha.svg'],
                        ['name' => 'Komatsu Heavy Equipment', 'desc' => 'Mitra Teknik Pemesinan', 'logo' => '/images/partners/komatsu.svg'],
                    ];
                @endphp

                {{-- Loop 1 --}}
                @foreach($partners as $partner)
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

                {{-- Loop 2 (Duplicate for Seamless Infinite Marquee) --}}
                @foreach($partners as $partner)
                    <div class="flex items-center gap-3.5 px-4 py-2.5 rounded-2xl bg-paper border border-line shadow-xs shrink-0 hover:border-navy transition-all" aria-hidden="true">
                        <div class="w-16 h-9 rounded-lg bg-white border border-line/60 flex items-center justify-center p-1 shrink-0 overflow-hidden">
                            <img src="{{ $partner['logo'] }}" alt="Logo {{ $partner['name'] }}" class="max-h-7 max-w-[56px] w-auto h-auto object-contain">
                        </div>
                        <div>
                            <span class="block font-display font-extrabold text-xs text-ink leading-tight">{{ $partner['name'] }}</span>
                            <span class="block text-[10px] text-ink-muted mt-0.5">{{ $partner['desc'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Section 3: 4 Karakter Utama SKENSA (Data Resmi lms.skensa.id) --}}
    <section class="py-16 bg-paper border-b-2 border-ink">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-navy">Fondasi Nilai &amp; Karakter SKENSA</span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-1">
                        4 Pilar Karakter <span class="marker-highlight">Utama</span>
                    </h2>
                </div>
                <p class="text-sm text-ink-muted max-w-md">
                    Nilai dasar pembentuk jati diri peserta didik SMK Negeri 1 Denpasar dalam mengamalkan <em>{{ $settings['school_slogan'] ?? 'Abhyāsad Dhäryate Vidyä.' }}</em>
                </p>
            </div>

            @php
                $characterValues = json_decode($settings['character_values'] ?? '[]', true) ?: [
                    ['code' => '01', 'title' => 'Siap', 'desc' => 'Siaga menghadapi tantangan, berkomitmen mencapai tujuan.'],
                    ['code' => '02', 'title' => 'Kompeten', 'desc' => 'Keselarasan pengetahuan dan keterampilan dalam melaksanakan tugas.'],
                    ['code' => '03', 'title' => 'Disiplin', 'desc' => 'Pembiasaan terstruktur dengan penuh tanggung jawab.'],
                    ['code' => '04', 'title' => 'Beretika', 'desc' => 'Menjunjung tinggi nilai etika dan norma dalam berkehidupan sosial.'],
                ];
            @endphp

            <div data-reveal-stagger class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($characterValues as $idx => $char)
                    <div data-reveal-item data-tilt class="p-6 rounded-2xl bg-paper-2 border-2 border-ink flex flex-col justify-between hover:border-navy transition-all">
                        <div class="flex items-center justify-between mb-6">
                            <span class="px-3 py-1 rounded-lg bg-navy text-yellow-skensa font-display font-extrabold text-xs tabular-nums">
                                PILAR {{ $char['code'] ?? str_pad((string) ($idx + 1), 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="w-2.5 h-2.5 rounded-full bg-navy"></span>
                        </div>
                        <div>
                            <h3 class="font-display font-extrabold text-2xl text-ink">{{ $char['title'] }}</h3>
                            <p class="text-sm text-ink-muted mt-2 leading-relaxed">{{ $char['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Section 4: Interactive Academic Faculty Explorer (Split View + Bento Grid for 9 Programs & 12 Majors) --}}
    <section id="fakultas-keahlian" class="py-20 bg-paper-2 border-b-2 border-ink">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12 pb-6 border-b-2 border-line">
                <div>
                    <span class="inline-block px-3 py-1 rounded-md bg-navy text-yellow-skensa text-xs font-extrabold uppercase tracking-widest">
                        Struktur Akademik Resmi smkn1denpasar.sch.id
                    </span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-ink mt-3">
                        9 Program &amp; 12 <span class="marker-highlight">Konsentrasi Keahlian</span>
                    </h2>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-ink-muted tabular-nums">
                        Menampilkan: <strong id="faculty-active-count" class="text-navy font-extrabold">{{ $majors->count() }}</strong> Konsentrasi Keahlian
                    </span>
                    <a
                        href="{{ route('majors.index') }}"
                        data-magnetic
                        class="px-4 py-2.5 rounded-xl bg-navy text-paper text-xs font-bold uppercase tracking-wider hover:bg-navy-700 transition-colors"
                    >
                        Halaman Katalog Penuh &rarr;
                    </a>
                </div>
            </div>

            {{-- Split View Layout: Left Sticky 9 Program Tabs + Right Interactive Bento Cards --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                {{-- Left Column: Sticky 9 Program Keahlian Selector --}}
                <div class="lg:col-span-4 lg:sticky lg:top-28 bg-paper rounded-2xl border-2 border-ink p-4 space-y-1.5 shadow-sm">
                    <div class="px-3 py-2 border-b border-line mb-2 flex items-center justify-between">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Filter Program Keahlian</span>
                        <span class="text-[11px] font-bold text-ink-muted tabular-nums">9 Bidang</span>
                    </div>

                    {{-- "Semua Program" Button --}}
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

                    {{-- 9 Individual Program Keahlian Buttons --}}
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

                {{-- Right Column: Interactive Bento Showcase of 12 Konsentrasi Keahlian --}}
                <div class="lg:col-span-8">
                    <div id="faculty-cards-grid" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($majors as $index => $major)
                            <article
                                data-faculty-card
                                data-field-id="{{ $major->field_id }}"
                                data-tilt
                                class="rounded-2xl bg-paper border-2 border-ink overflow-hidden flex flex-col justify-between hover:border-navy transition-all group shadow-xs"
                            >
                                <div>
                                    {{-- Top Visual Banner with Department Code & Program Badge --}}
                                    <div class="relative h-44 bg-navy overflow-hidden border-b-2 border-ink">
                                        <img
                                            src="{{ $major->image ?: '/images/gedung_skensa.jpg' }}"
                                            alt="{{ $major->name }}"
                                            loading="lazy"
                                            class="w-full h-full object-cover opacity-55 group-hover:scale-105 transition-transform duration-500"
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

                                        <div class="absolute bottom-3 left-3.5 right-3.5 flex items-end justify-between">
                                            <span class="text-[11px] font-extrabold uppercase tracking-widest text-yellow-skensa tabular-nums">
                                                Konsentrasi #{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Card Body --}}
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
                                                    Fokus Kompetensi:
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

                                {{-- Card Footer --}}
                                <div class="px-6 pb-6 pt-3 border-t border-line bg-paper-2/50">
                                    @if(!empty($major->career_prospects))
                                        <div class="flex flex-wrap gap-1.5 mb-4">
                                            @foreach(array_slice((array) $major->career_prospects, 0, 2) as $prospect)
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
                                        <span>Detail Kurikulum {{ $major->code }}</span>
                                        <span aria-hidden="true">&rarr;</span>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 5: Pengumuman & Berita Resmi Sekolah (Data Asli smkn1denpasar.sch.id) --}}
    <section id="pengumuman-resmi" class="py-20 bg-paper border-b-2 border-ink">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-navy">Publikasi &amp; Informasi Resmi</span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-1">
                        Pengumuman &amp; <span class="marker-highlight">Berita</span> SKENSA
                    </h2>
                </div>
                <a href="{{ route('publications.index') }}" class="text-xs font-bold uppercase tracking-wider text-navy hover:underline">
                    Lihat Seluruh Arsip Publikasi &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                {{-- Highlighted Official Graduation Announcement Card from smkn1denpasar.sch.id --}}
                <div class="lg:col-span-7">
                    <div class="rounded-2xl bg-navy text-paper border-2 border-ink p-8 h-full flex flex-col justify-between shadow-lg">
                        <div class="space-y-4">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <span class="px-3 py-1 rounded-md bg-yellow-skensa text-ink font-display font-extrabold text-xs uppercase tracking-wider">
                                    Pengumuman Resmi &bull; 1 Mei 2025
                                </span>
                                <span class="text-xs font-semibold text-paper/75">
                                    Kemendikdasmen RI
                                </span>
                            </div>

                            <h3 class="font-display font-extrabold text-2xl sm:text-3xl text-paper leading-tight">
                                Kelulusan Kelas XII Tahun Ajaran 2024/2025
                            </h3>

                            <p class="text-sm sm:text-base text-paper/85 leading-relaxed">
                                Pengumuman kelulusan bagi siswa kelas XII SMK Negeri 1 Denpasar tahun ajaran 2024/2025 ditetapkan pada tanggal <strong class="text-yellow-skensa">5 Mei 2025</strong> mengacu pada kebijakan Kementerian Pendidikan Dasar dan Menengah (Kemendikdasmen).
                            </p>

                            <p class="text-sm text-paper/80 leading-relaxed">
                                Pengumuman dilakukan secara daring melalui laman resmi <strong class="text-yellow-skensa">https://lulus.smkn1denpasar.sch.id</strong> yang dapat diakses mulai pukul <strong class="text-yellow-skensa">08.00 WIB</strong>, guna menghindari kerumunan dan potensi konvoi atau aksi corat-coret yang tidak dianjurkan.
                            </p>
                        </div>

                        <div class="mt-8 pt-5 border-t border-paper/15 flex flex-wrap items-center gap-4">
                            <a
                                href="https://lulus.smkn1denpasar.sch.id"
                                target="_blank"
                                rel="noopener"
                                data-magnetic
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-yellow-skensa text-ink font-display font-extrabold text-xs uppercase tracking-wider hover:bg-paper transition-colors"
                            >
                                <span>Buka Portal Kelulusan Resmi</span>
                                <span>&nearr;</span>
                            </a>
                            <a
                                href="{{ route('publications.index', ['kategori' => 'pengumuman']) }}"
                                class="inline-flex items-center gap-2 px-4 py-3 rounded-xl bg-paper/10 text-paper font-bold text-xs uppercase tracking-wider hover:bg-paper/20 transition-colors"
                            >
                                <span>Baca Selengkapnya</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Dynamic Posts from Database --}}
                <div class="lg:col-span-5 flex flex-col gap-5">
                    @foreach($posts as $post)
                        <article class="p-6 rounded-2xl bg-paper-2 border-2 border-ink flex flex-col justify-between hover:border-navy transition-colors flex-1">
                            <div>
                                <div class="flex items-center justify-between gap-2 text-xs text-ink-muted mb-2.5">
                                    <span class="font-extrabold uppercase tracking-wider text-navy px-2.5 py-0.5 rounded bg-paper border border-line">
                                        {{ $post->category }}
                                    </span>
                                    <time datetime="{{ optional($post->published_at)->toDateString() }}" class="tabular-nums font-semibold">
                                        {{ optional($post->published_at)->translatedFormat('d F Y') ?? 'Mei 2025' }}
                                    </time>
                                </div>
                                <h3 class="font-display font-extrabold text-lg text-ink leading-snug">
                                    <a href="{{ route('publications.show', $post->slug) }}" class="hover:text-navy">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="text-sm text-ink-muted mt-2 line-clamp-3 leading-relaxed">
                                    {{ $post->excerpt }}
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-line flex items-center justify-between">
                                <a href="{{ route('publications.show', $post->slug) }}" class="text-xs font-extrabold uppercase tracking-wider text-navy hover:underline">
                                    Baca Rilis Resmi &rarr;
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Section 6: Kontak & Lokasi Resmi SMK Negeri 1 Denpasar --}}
    <section class="py-16 bg-paper-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-paper border-2 border-ink p-8 lg:p-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-3">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Informasi &amp; Layanan Resmi</span>
                    <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-ink">
                        Hubungi SMK Negeri 1 Denpasar
                    </h2>
                    <p class="text-sm text-ink-muted leading-relaxed">
                        {{ $settings['contact_address'] ?? 'Jalan HOS. Cokroaminoto No. 84 Denpasar, Bali 80118' }}
                    </p>
                    <div class="flex flex-wrap items-center gap-6 pt-2 text-sm">
                        <div>
                            <span class="block text-[11px] font-bold uppercase text-ink-muted">Telepon / WhatsApp</span>
                            <a href="tel:{{ $settings['contact_phone'] ?? '081236396662' }}" class="font-display font-extrabold text-lg text-navy hover:underline tabular-nums">
                                {{ $settings['contact_phone'] ?? '081236396662' }}
                            </a>
                        </div>
                        <div>
                            <span class="block text-[11px] font-bold uppercase text-ink-muted">Surel Resmi</span>
                            <a href="mailto:{{ $settings['contact_email'] ?? 'fo@smkn1denpasar.sch.id' }}" class="font-display font-extrabold text-lg text-navy hover:underline">
                                {{ $settings['contact_email'] ?? 'fo@smkn1denpasar.sch.id' }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 flex flex-wrap lg:justify-end gap-3">
                    <a
                        href="{{ route('contact.index') }}"
                        data-magnetic
                        class="px-5 py-3 rounded-xl bg-navy text-paper font-display font-bold text-xs uppercase tracking-wider hover:bg-navy-700 transition-colors"
                    >
                        Halaman Kontak &amp; Peta &rarr;
                    </a>
                    <a
                        href="https://maps.app.goo.gl/5kRHGNBWvKrcPzVY6"
                        target="_blank"
                        rel="noopener"
                        class="px-5 py-3 rounded-xl bg-paper-2 border-2 border-ink text-ink font-display font-bold text-xs uppercase tracking-wider hover:border-navy transition-colors"
                    >
                        Buka Google Maps &nearr;
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
