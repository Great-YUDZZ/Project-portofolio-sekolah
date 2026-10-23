@extends('layouts.public')

@section('title', 'SMK Negeri 1 Denpasar (SKENSA) - Abhyasad Dharyate Vidya')

@section('content')

    {{-- Remotion Cinematic Intro Overlay (Full-Screen GSAP Split Curtain) --}}
    <div
        id="skensa-intro-overlay"
        aria-hidden="false"
        class="fixed inset-0 z-50 flex items-center justify-center overflow-hidden select-none"
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
                <source src="/media/intro.webm" type="video/webm">
                <source src="/media/intro.mp4" type="video/mp4">
            </video>

            <div class="absolute bottom-7 inset-x-0 px-6 sm:px-12 flex items-center justify-between text-paper/85 text-xs font-bold uppercase tracking-widest">
                <span class="hidden sm:inline">SMK NEGERI 1 DENPASAR • SKENSA BALI</span>
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

    {{-- Section 1: Hero Architectural Split Screen --}}
    <section data-hero-section class="relative border-b-2 border-ink bg-paper overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-22">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <div data-hero-animate class="inline-flex items-center gap-3 px-3.5 py-1.5 rounded-full bg-paper-2 border border-line text-xs font-bold uppercase tracking-widest text-navy">
                        <span class="w-2 h-2 rounded-full bg-yellow-skensa"></span>
                        <span>SMK Pusat Keunggulan • Berdiri 24 September 1962</span>
                    </div>

                    <h1 data-hero-animate class="font-display font-extrabold text-4xl sm:text-5xl lg:text-6xl tracking-tight text-ink leading-[1.06]">
                        Membangun Generasi Vokasi <span class="marker-highlight">Unggul</span> Berbasis Teknologi & Budaya.
                    </h1>

                    <p data-hero-animate class="text-base sm:text-lg text-ink-muted leading-relaxed max-w-2xl">
                        {{ $settings['hero_subtitle'] ?? 'SMK Negeri 1 Denpasar (SKENSA) memadukan 9 Bidang Keahlian dan 13 Konsentrasi Keahlian berstandar industri global dengan filosofi Abhyasad Dharyate Vidya: dari latihan dan ketekunan lahir ilmu pengetahuan yang kokoh.' }}
                    </p>

                    <div data-hero-animate class="flex flex-wrap items-center gap-3.5 pt-2">
                        <a href="{{ route('majors.index') }}" class="px-6 py-3.5 rounded-xl bg-navy text-paper font-bold text-sm uppercase tracking-wider hover:bg-navy-700 transition-colors">
                            Jelajahi 13 Jurusan
                        </a>
                        <a href="{{ route('works.index') }}" class="px-6 py-3.5 rounded-xl bg-yellow-skensa text-ink font-extrabold text-sm uppercase tracking-wider hover:brightness-95 transition">
                            Showcase Karya Siswa
                        </a>
                        <button
                            type="button"
                            onclick="sessionStorage.removeItem('skensa_intro_seen'); window.location.reload();"
                            class="px-4 py-3.5 rounded-xl border border-line bg-paper-2 text-ink text-xs font-bold uppercase tracking-wider hover:border-navy cursor-pointer"
                        >
                            Putar Ulang Intro
                        </button>
                    </div>

                    {{-- Quick Institutional Badges --}}
                    <div data-hero-animate class="pt-6 border-t border-line grid grid-cols-3 gap-4 max-w-lg">
                        <div>
                            <span class="block text-xs font-bold uppercase tracking-wider text-ink-muted">NPSN Resmi</span>
                            <span class="font-display font-extrabold text-lg text-navy">{{ $settings['school_npsn'] ?? '50103118' }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold uppercase tracking-wider text-ink-muted">Akreditasi</span>
                            <span class="font-display font-extrabold text-lg text-navy">A (Unggul)</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold uppercase tracking-wider text-ink-muted">Sertifikasi</span>
                            <span class="font-display font-extrabold text-lg text-navy">LSP P1 BNSP</span>
                        </div>
                    </div>
                </div>

                {{-- Right Visual Frame with GSAP Zoom & Rotating Emblem Cog --}}
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-2xl overflow-hidden border-2 border-ink bg-navy aspect-[4/4.4]">
                        <img
                            data-hero-zoom-img
                            src="/images/gedung_skensa.jpg"
                            alt="Gedung Utama SMK Negeri 1 Denpasar"
                            class="w-full h-full object-cover"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/20 to-transparent"></div>

                        <div class="absolute bottom-5 left-5 right-5 p-5 rounded-xl bg-paper/95 border border-line">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-[11px] font-bold uppercase tracking-widest text-navy">Kampus Cokroaminoto 84</span>
                                    <p class="font-display font-extrabold text-base text-ink mt-0.5">Abhyasad Dharyate Vidya</p>
                                </div>
                                <img
                                    data-hero-cog
                                    src="/images/logo_emblem.png"
                                    alt="Emblem SKENSA"
                                    class="w-11 h-11 object-contain"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 2: Animated School Metrics (GSAP Counters) --}}
    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <div class="p-5 rounded-xl bg-navy-700/80 border border-paper/15">
                    <div class="font-display font-extrabold text-3xl sm:text-4xl text-yellow-skensa" data-counter="{{ $settings['stat_students'] ?? 2640 }}" data-suffix="+">2.640+</div>
                    <p class="text-xs font-bold uppercase tracking-wider text-paper/80 mt-2">Siswa Aktif</p>
                </div>
                <div class="p-5 rounded-xl bg-navy-700/80 border border-paper/15">
                    <div class="font-display font-extrabold text-3xl sm:text-4xl text-yellow-skensa" data-counter="{{ $settings['stat_teachers'] ?? 186 }}">186</div>
                    <p class="text-xs font-bold uppercase tracking-wider text-paper/80 mt-2">Pendidik & Tendik</p>
                </div>
                <div class="p-5 rounded-xl bg-navy-700/80 border border-paper/15">
                    <div class="font-display font-extrabold text-3xl sm:text-4xl text-yellow-skensa" data-counter="{{ $fields->count() ?: 9 }}">9</div>
                    <p class="text-xs font-bold uppercase tracking-wider text-paper/80 mt-2">Bidang Keahlian</p>
                </div>
                <div class="p-5 rounded-xl bg-navy-700/80 border border-paper/15">
                    <div class="font-display font-extrabold text-3xl sm:text-4xl text-yellow-skensa" data-counter="{{ $majors->count() ?: 13 }}">13</div>
                    <p class="text-xs font-bold uppercase tracking-wider text-paper/80 mt-2">Konsentrasi Keahlian</p>
                </div>
                <div class="p-5 rounded-xl bg-navy-700/80 border border-paper/15">
                    <div class="font-display font-extrabold text-3xl sm:text-4xl text-yellow-skensa" data-counter="{{ $settings['stat_classrooms'] ?? 72 }}">72</div>
                    <p class="text-xs font-bold uppercase tracking-wider text-paper/80 mt-2">Rombongan Belajar</p>
                </div>
                <div class="p-5 rounded-xl bg-navy-700/80 border border-paper/15">
                    <div class="font-display font-extrabold text-3xl sm:text-4xl text-yellow-skensa" data-counter="{{ $settings['stat_partners'] ?? 140 }}" data-suffix="+">140+</div>
                    <p class="text-xs font-bold uppercase tracking-wider text-paper/80 mt-2">Mitra Industri DUDI</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 3: Sambutan Kepala Sekolah & Filosofi SKENSA --}}
    <section class="py-20 border-b border-line bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5" data-reveal>
                    <div class="relative rounded-2xl overflow-hidden border-2 border-ink bg-paper-2">
                        <img src="/images/hero_waka.jpg" alt="Jajaran Pimpinan SMK Negeri 1 Denpasar" class="w-full h-80 sm:h-96 object-cover">
                        <div class="p-5 bg-navy text-paper border-t-2 border-yellow-skensa">
                            <span class="text-xs font-bold uppercase tracking-widest text-yellow-skensa">Kepala SMK Negeri 1 Denpasar</span>
                            <h3 class="font-display font-bold text-lg mt-0.5">{{ $settings['principal_name'] ?? 'I Wayan Mustika, S.Pd., M.Pd.' }}</h3>
                            <p class="text-xs text-paper/75 mt-1">Manajemen Mutu Vokasi & Teaching Factory SKENSA</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 space-y-5" data-reveal data-reveal-delay="0.1">
                    <span class="text-xs font-bold uppercase tracking-widest text-navy px-3 py-1 rounded bg-paper-2 border border-line">Pengantar Pimpinan</span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink leading-tight">
                        Transformasi Pendidikan Vokasi Menuju <span class="marker-highlight">Kemandirian</span> Industri.
                    </h2>
                    <p class="text-ink-muted leading-relaxed">
                        Sejak berdiri pada 24 September 1962 sebagai STM Negeri Denpasar, SMK Negeri 1 Denpasar terus berevolusi menjadi rujukan pendidikan kejuruan di Bali dan Indonesia. Kurikulum kami disusun bersama mitra Dunia Usaha dan Dunia Industri (DUDI) agar setiap lulusan siap berkarya, berwirausaha, maupun melanjutkan studi ke jenjang perguruan tinggi.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="p-4 rounded-xl bg-paper-2 border border-line">
                            <h4 class="font-display font-bold text-base text-navy">Teaching Factory Aktif</h4>
                            <p class="text-xs text-ink-muted mt-1 leading-relaxed">Pembelajaran berbasis produksi dan layanan nyata berstandar industri di 13 jurusan.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-paper-2 border border-line">
                            <h4 class="font-display font-bold text-base text-navy">Uji Kompetensi LSP-P1</h4>
                            <p class="text-xs text-ink-muted mt-1 leading-relaxed">Sertifikasi kompetensi berlisensi BNSP langsung di Tempat Uji Kompetensi sekolah.</p>
                        </div>
                    </div>
                    <div class="pt-3">
                        <a href="{{ route('profile.index') }}" class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-wider text-navy hover:underline">
                            <span>Baca Sejarah & Visi Misi Lengkap</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 4: GSAP Horizontal Pinned Scroll - 13 Konsentrasi Keahlian --}}
    <section data-majors-pin class="bg-paper-2 border-b-2 border-ink py-16 lg:py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-navy">Eksplorasi Kompetensi SKENSA</span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-1">
                        13 Konsentrasi <span class="marker-highlight">Keahlian</span> Unggulan
                    </h2>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden lg:flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-ink-muted">
                        <span>Kartu Aktif:</span>
                        <span class="font-display text-lg font-extrabold text-navy" data-majors-current>01</span>
                        <span>/ {{ str_pad((string) $majors->count(), 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <a href="{{ route('majors.index') }}" class="px-4 py-2.5 rounded-lg bg-navy text-paper text-xs font-bold uppercase tracking-wider hover:bg-navy-700">
                        Lihat Semua Jurusan
                    </a>
                </div>
            </div>

            {{-- Progress Bar for Horizontal Pin --}}
            <div class="hidden lg:block w-full h-1.5 bg-line rounded-full overflow-hidden mt-5">
                <div data-majors-progress class="h-full bg-navy origin-left scale-x-0"></div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div data-majors-track class="flex flex-col lg:flex-row gap-6 lg:w-max">
                @foreach($majors as $index => $major)
                    <article
                        data-major-card
                        class="w-full lg:w-[370px] shrink-0 rounded-2xl bg-paper border-2 border-ink p-6 flex flex-col justify-between hover:border-navy transition-colors"
                    >
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-4">
                                <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded bg-navy text-yellow-skensa">
                                    {{ $major->code }}
                                </span>
                                <span class="text-xs font-bold text-ink-muted">
                                    #{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }} • {{ $major->field?->name }}
                                </span>
                            </div>

                            <h3 class="font-display font-extrabold text-xl text-ink leading-snug">
                                {{ $major->name }}
                            </h3>

                            <p class="text-sm text-ink-muted mt-3 leading-relaxed line-clamp-3">
                                {{ $major->summary }}
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-line">
                            @if(!empty($major->career_prospects))
                                <div class="flex flex-wrap gap-1.5 mb-4">
                                    @foreach(array_slice((array) $major->career_prospects, 0, 2) as $prospect)
                                        <span class="text-[11px] font-semibold px-2.5 py-0.5 rounded bg-paper-2 border border-line text-ink">
                                            {{ $prospect }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <a href="{{ route('majors.show', $major->slug) }}" class="inline-flex items-center justify-between w-full px-4 py-2.5 rounded-xl bg-paper-2 hover:bg-yellow-skensa text-ink font-bold text-xs uppercase tracking-wider transition-colors">
                                <span>Kurikulum & Lab {{ $major->code }}</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Section 5: Showcase Karya Inovasi Siswa --}}
    <section class="py-20 bg-paper border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-navy">Teaching Factory & Produk Kreatif</span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-1">
                        Karya & <span class="marker-highlight">Inovasi</span> Siswa SKENSA
                    </h2>
                </div>
                <a href="{{ route('works.index') }}" class="text-xs font-bold uppercase tracking-wider text-navy hover:underline">
                    Jelajahi Seluruh Karya &rarr;
                </a>
            </div>

            @if($featuredWorks->isEmpty())
                <div class="p-10 rounded-2xl bg-paper-2 border border-line text-center">
                    <p class="font-display font-bold text-lg text-ink">Belum Ada Karya Ditampilkan</p>
                    <p class="text-sm text-ink-muted mt-1">Data karya siswa akan segera diperbarui oleh tim kurator jurusan.</p>
                </div>
            @else
                <div data-reveal-stagger class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($featuredWorks as $work)
                        <article data-reveal-item class="rounded-2xl bg-paper-2/60 border border-line overflow-hidden flex flex-col justify-between hover:border-navy transition-colors">
                            <div>
                                <div class="aspect-video bg-navy relative overflow-hidden border-b border-line">
                                    <img
                                        src="{{ $work->thumbnail ?: '/images/hero_siswa.jpg' }}"
                                        alt="{{ $work->title }}"
                                        class="w-full h-full object-cover"
                                    >
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-navy/90 text-yellow-skensa text-[11px] font-bold uppercase">
                                        {{ $work->major?->code ?? 'SKENSA' }} • {{ $work->year }}
                                    </span>
                                </div>
                                <div class="p-6">
                                    <h3 class="font-display font-bold text-lg text-ink leading-snug">{{ $work->title }}</h3>
                                    <p class="text-xs font-semibold text-navy mt-1">{{ $work->student_name }} ({{ $work->class_name }})</p>
                                    <p class="text-sm text-ink-muted mt-3 line-clamp-3 leading-relaxed">{{ $work->description }}</p>
                                </div>
                            </div>
                            <div class="px-6 pb-5 pt-3 border-t border-line flex items-center justify-between">
                                <button
                                    type="button"
                                    data-lightbox-src="{{ $work->thumbnail ?: '/images/hero_siswa.jpg' }}"
                                    data-lightbox-title="{{ $work->title }} ({{ $work->student_name }})"
                                    data-lightbox-desc="{{ $work->description }}"
                                    class="text-xs font-bold uppercase tracking-wider text-navy hover:underline cursor-pointer"
                                >
                                    Pratinjau Karya
                                </button>
                                @if($work->project_url)
                                    <a href="{{ $work->project_url }}" target="_blank" rel="noopener" class="text-xs font-bold uppercase text-ink hover:text-navy">
                                        Tautan Proyek &nearr;
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Section 6: Prestasi & Kejuaraan Terkini --}}
    <section class="py-20 bg-paper-2 border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-navy">Rekam Jejak Kompetisi</span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-1">
                        Papan <span class="marker-highlight">Prestasi</span> Siswa & Sekolah
                    </h2>
                </div>
                <a href="{{ route('achievements.index') }}" class="text-xs font-bold uppercase tracking-wider text-navy hover:underline">
                    Lihat Direktori Prestasi &rarr;
                </a>
            </div>

            <div data-reveal-stagger class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($achievements as $achievement)
                    <div data-reveal-item class="p-6 rounded-2xl bg-paper border border-line flex flex-col sm:flex-row items-start justify-between gap-4">
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded bg-yellow-skensa text-ink text-xs font-extrabold uppercase">
                                    {{ $achievement->medal }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded bg-navy text-paper text-xs font-bold uppercase">
                                    Tingkat {{ ucfirst($achievement->level) }}
                                </span>
                                <span class="text-xs font-bold text-ink-muted">{{ $achievement->year }}</span>
                            </div>
                            <h3 class="font-display font-bold text-lg text-ink">{{ $achievement->title }}</h3>
                            <p class="text-sm text-ink-muted">{{ $achievement->competition_name }}</p>
                            <p class="text-xs font-bold text-navy">Peraih: {{ $achievement->winner_name }} ({{ $achievement->major?->code ?? 'Tim SKENSA' }})</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Section 7: Berita, Pengumuman & Agenda Sekolah --}}
    <section class="py-20 bg-paper border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                {{-- Kolom Berita --}}
                <div class="lg:col-span-8">
                    <div class="flex items-end justify-between mb-8">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-navy">Jurnal & Informasi Resmi</span>
                            <h2 class="font-display font-extrabold text-3xl text-ink mt-1">Berita & Pengumuman</h2>
                        </div>
                        <a href="{{ route('publications.index') }}" class="text-xs font-bold uppercase tracking-wider text-navy hover:underline">Semua Berita &rarr;</a>
                    </div>

                    <div class="space-y-5">
                        @foreach($posts as $post)
                            <article class="p-6 rounded-2xl bg-paper-2/60 border border-line hover:border-navy transition-colors">
                                <div class="flex items-center gap-3 text-xs font-bold uppercase tracking-wider text-navy mb-2">
                                    <span class="px-2.5 py-0.5 rounded bg-yellow-skensa text-ink">{{ $post->category }}</span>
                                    <span class="text-ink-muted">{{ optional($post->published_at)->format('d M Y') ?? '2026' }}</span>
                                </div>
                                <h3 class="font-display font-bold text-xl text-ink hover:text-navy">
                                    <a href="{{ route('publications.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="text-sm text-ink-muted mt-2 leading-relaxed">{{ $post->excerpt }}</p>
                                <div class="mt-4">
                                    <a href="{{ route('publications.show', $post->slug) }}" class="text-xs font-bold uppercase tracking-wider text-navy hover:underline">
                                        Baca Selengkapnya &rarr;
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                {{-- Kolom Agenda --}}
                <div class="lg:col-span-4">
                    <div class="mb-8">
                        <span class="text-xs font-bold uppercase tracking-widest text-navy">Kalender Akademik</span>
                        <h2 class="font-display font-extrabold text-3xl text-ink mt-1">Agenda Kegiatan</h2>
                    </div>

                    <div class="space-y-4">
                        @foreach($events as $event)
                            <div class="p-5 rounded-2xl bg-navy text-paper border border-navy-700">
                                <div class="text-xs font-bold uppercase tracking-widest text-yellow-skensa">
                                    {{ optional($event->start_date)->format('d M Y') }}
                                </div>
                                <h3 class="font-display font-bold text-base text-paper mt-1">{{ $event->title }}</h3>
                                <p class="text-xs text-paper/75 mt-1">Lokasi: {{ $event->location }}</p>
                                <p class="text-xs text-paper/85 mt-2 leading-relaxed">{{ $event->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 8: Ekosistem Digital & Portal LMS SKENSA --}}
    <section class="py-20 bg-paper-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-navy text-paper p-8 sm:p-12 border-2 border-ink">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-6 space-y-4">
                        <span class="inline-block px-3 py-1 rounded bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-wider">
                            Single Digital Ecosystem
                        </span>
                        <h2 class="font-display font-extrabold text-3xl sm:text-4xl leading-tight">
                            Terhubung Langsung dengan LMS SKENSA & Layanan Akademik.
                        </h2>
                        <p class="text-sm sm:text-base text-paper/80 leading-relaxed">
                            Akses manajemen kelas, modul pembelajaran seluruh 13 konsentrasi keahlian, pengumpulan tugas, ujian CBT terintegrasi, hingga bursa kerja alumni dalam satu ekosistem terpadu.
                        </p>
                        <div class="flex flex-wrap gap-3 pt-2">
                            <a href="{{ route('login') }}" class="px-6 py-3 rounded-xl bg-yellow-skensa text-ink font-extrabold text-xs uppercase tracking-wider">
                                Masuk ke LMS SKENSA
                            </a>
                            <a href="{{ route('ecosystem.index') }}" class="px-6 py-3 rounded-xl border border-paper/30 text-paper font-bold text-xs uppercase tracking-wider hover:bg-navy-700">
                                Lihat 6 Layanan Digital
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($ecosystemLinks->take(4) as $eco)
                            <a href="{{ $eco->url }}" class="p-5 rounded-2xl bg-navy-700 border border-paper/15 hover:border-yellow-skensa transition-colors block">
                                <span class="text-[11px] font-bold uppercase tracking-widest text-yellow-skensa">{{ $eco->category }}</span>
                                <h3 class="font-display font-bold text-lg text-paper mt-1">{{ $eco->name }}</h3>
                                <p class="text-xs text-paper/75 mt-2 line-clamp-2 leading-relaxed">{{ $eco->description }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
