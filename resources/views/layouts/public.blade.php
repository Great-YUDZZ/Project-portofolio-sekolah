<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', ($siteSettings['school_name'] ?? 'SMK Negeri 1 Denpasar') . ' - ' . ($siteSettings['school_slogan'] ?? 'Abhyāsad Dhäryate Vidyä.'))</title>
    <meta name="description" content="@yield('meta_description', ($siteSettings['school_slogan'] ?? 'Abhyāsad Dhäryate Vidyä.') . ' - ' . ($siteSettings['school_slogan_meaning'] ?? 'Peliharalah ilmu sampai menjadi tradisi.'))">
    <link rel="icon" type="image/png" href="/images/logo_emblem.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-paper text-ink antialiased selection:bg-yellow-skensa selection:text-ink min-h-screen flex flex-col">

    {{-- Skip to Content Link for Accessibility --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-50 focus:px-4 focus:py-2 focus:rounded-lg focus:bg-yellow-skensa focus:text-ink focus:font-bold focus:shadow-lg">
        Langsung ke Konten Utama
    </a>

    {{-- Academic Mega-Menu Navbar (Stanford / MIT Style) --}}
    <header id="site-navbar" class="sticky top-0 z-40 bg-paper/95 backdrop-blur-md border-b border-line transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-6">
            {{-- Brand Identity --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3.5 group shrink-0 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-navy focus-visible:ring-offset-2 rounded-xl pr-2">
                <img
                    src="/images/logo_emblem.png"
                    alt="Logo SMK Negeri 1 Denpasar"
                    width="44"
                    height="44"
                    fetchpriority="high"
                    class="w-11 h-11 object-contain transition-transform duration-300 group-hover:scale-105"
                >
                <div>
                    <span class="block font-display font-extrabold text-base sm:text-lg leading-none tracking-tight text-navy">SMK&nbsp;NEGERI&nbsp;1&nbsp;DENPASAR</span>
                    <span class="block text-[11px] font-semibold tracking-wider text-ink-muted mt-1">{{ $siteSettings['school_slogan'] ?? 'Abhyāsad Dhäryate Vidyä.' }}</span>
                </div>
            </a>

            {{-- Primary Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-1" aria-label="Navigasi Utama">
                {{-- 1. Beranda --}}
                <a
                    href="{{ route('home') }}"
                    class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-navy {{ request()->routeIs('home') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2 hover:text-navy' }}"
                >
                    Beranda
                </a>

                {{-- 2. Program Keahlian (Two-Column Interactive University Mega-Menu) --}}
                <div class="static group" data-nav-dropdown>
                    <button
                        type="button"
                        id="mega-menu-toggle"
                        aria-expanded="false"
                        aria-controls="mega-menu-drawer"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-sm font-semibold transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-navy {{ request()->routeIs('majors.*') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2 hover:text-navy' }}"
                    >
                        <span>Program Keahlian</span>
                        <span class="px-1.5 py-0.5 text-[10px] font-extrabold rounded bg-yellow-skensa text-ink tabular-nums">9</span>
                        <svg class="w-3.5 h-3.5 opacity-70 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Full-Width Two-Column Academic Mega-Menu Panel --}}
                    <div
                        id="mega-menu-drawer"
                        class="invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 group-focus-within:visible group-focus-within:opacity-100 group-focus-within:translate-y-0 transition-all duration-200 absolute left-0 right-0 top-full bg-paper border-b-2 border-navy shadow-2xl z-50"
                    >
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-7">
                            <div class="flex items-center justify-between pb-4 mb-5 border-b border-line">
                                <div class="flex items-center gap-3">
                                    <span class="px-2.5 py-1 rounded-md bg-navy text-yellow-skensa text-[11px] font-extrabold uppercase tracking-widest">Katalog Akademik Resmi</span>
                                    <span class="text-xs font-semibold text-ink-muted">9 Program Keahlian &bull; 12 Konsentrasi Keahlian SMK Negeri 1 Denpasar</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('majors.index') }}" class="text-xs font-extrabold uppercase tracking-wider text-navy hover:underline">
                                        Indeks Seluruh Jurusan &rarr;
                                    </a>
                                    <button type="button" id="mega-menu-close" class="px-2.5 py-1 rounded-lg border border-line text-[11px] font-bold uppercase text-ink-muted hover:text-ink hover:bg-paper-2 cursor-pointer">
                                        ESC
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-6">
                                {{-- Left Column: 9 Program Keahlian Selector --}}
                                <div class="col-span-5 border-r border-line pr-5 space-y-1">
                                    <span class="block text-[10px] font-extrabold uppercase tracking-widest text-ink-muted px-3 mb-2">
                                        Pilih Program Keahlian (9 Bidang)
                                    </span>
                                    @foreach($navFields as $fIdx => $field)
                                        <button
                                            type="button"
                                            data-mega-field-btn="{{ $field->id }}"
                                            class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-left transition-all cursor-pointer {{ $fIdx === 0 ? 'bg-navy text-paper font-bold' : 'text-ink hover:bg-paper-2 font-semibold' }}"
                                        >
                                            <div class="flex items-center gap-2.5 min-w-0">
                                                <span class="text-[11px] font-extrabold tabular-nums opacity-75">{{ str_pad((string) ($fIdx + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                                <span class="text-sm truncate">{{ $field->name }}</span>
                                            </div>
                                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-md {{ $fIdx === 0 ? 'bg-yellow-skensa text-ink' : 'bg-paper-2 text-ink-muted' }} tabular-nums shrink-0" data-mega-badge>
                                                {{ $field->majors->count() }} Jurusan
                                            </span>
                                        </button>
                                    @endforeach
                                </div>

                                {{-- Right Column: Active Program's Konsentrasi Keahlian Details --}}
                                <div class="col-span-7 pl-1 flex flex-col justify-between">
                                    @foreach($navFields as $fIdx => $field)
                                        <div
                                            data-mega-field-panel="{{ $field->id }}"
                                            class="{{ $fIdx === 0 ? 'block' : 'hidden' }} space-y-4"
                                        >
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <span class="text-[11px] font-extrabold uppercase tracking-widest text-navy">Program Keahlian {{ str_pad((string) ($fIdx + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                                    <h3 class="font-display font-extrabold text-xl text-ink">{{ $field->name }}</h3>
                                                </div>
                                                <a href="{{ route('majors.index', ['bidang' => $field->slug]) }}" class="text-xs font-bold text-navy hover:underline">
                                                    Filter Bidang Ini &rarr;
                                                </a>
                                            </div>

                                            <div class="grid grid-cols-1 {{ $field->majors->count() > 1 ? ' sm:grid-cols-2' : '' }} gap-4 pt-1">
                                                @foreach($field->majors as $navMajor)
                                                    <a
                                                        href="{{ route('majors.show', $navMajor->slug) }}"
                                                        class="group/card p-5 rounded-2xl bg-paper-2/80 border-2 border-line hover:border-navy hover:bg-paper transition-all flex flex-col justify-between"
                                                    >
                                                        <div>
                                                            <div class="flex items-center justify-between gap-2 mb-3">
                                                                <span class="px-2.5 py-1 rounded-lg bg-navy text-yellow-skensa font-display font-extrabold text-xs tracking-wider">
                                                                    {{ $navMajor->code }}
                                                                </span>
                                                                <span class="text-[11px] font-bold text-navy group-hover/card:translate-x-0.5 transition-transform">
                                                                    Detail Jurusan &rarr;
                                                                </span>
                                                            </div>
                                                            <h4 class="font-display font-extrabold text-base text-ink group-hover/card:text-navy transition-colors leading-snug">
                                                                {{ $navMajor->name }}
                                                            </h4>
                                                            <p class="text-xs text-ink-muted mt-2 leading-relaxed line-clamp-2">
                                                                {{ $navMajor->summary }}
                                                            </p>
                                                        </div>

                                                        @if(!empty($navMajor->competencies))
                                                            <div class="mt-4 pt-3 border-t border-line/80 flex flex-wrap gap-1.5">
                                                                @foreach(array_slice((array) $navMajor->competencies, 0, 2) as $comp)
                                                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-paper border border-line text-ink-muted truncate max-w-full">
                                                                        {{ $comp }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Bottom Quick Bar inside Mega-Menu --}}
                                    <div class="mt-6 pt-4 border-t border-line flex items-center justify-between text-xs text-ink-muted">
                                        <span>Semboyan: <strong class="text-ink">{{ $siteSettings['school_slogan'] ?? 'Abhyāsad Dhäryate Vidyä.' }}</strong> ({{ $siteSettings['school_slogan_meaning'] ?? 'Peliharalah ilmu sampai menjadi tradisi.' }})</span>
                                        <a href="https://lsp-smkn1denpasar.id" target="_blank" rel="noopener" class="font-bold text-navy hover:underline">
                                            LSP SMKN 1 Denpasar &nearr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 3. Pengumuman & Berita --}}
                <div class="relative group" data-nav-dropdown>
                    <a
                        href="{{ route('publications.index') }}"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-sm font-semibold transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-navy {{ request()->routeIs('publications.*') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2 hover:text-navy' }}"
                    >
                        <span>Pengumuman &amp; Berita</span>
                        <svg class="w-3.5 h-3.5 opacity-70 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <div class="invisible opacity-0 translate-y-1.5 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 group-focus-within:visible group-focus-within:opacity-100 group-focus-within:translate-y-0 transition-all duration-200 absolute left-0 top-full pt-2 w-80 z-50">
                        <div class="bg-paper rounded-2xl border-2 border-ink shadow-xl p-2 space-y-1">
                            <a href="{{ route('publications.index', ['kategori' => 'pengumuman']) }}" class="block px-3.5 py-2.5 rounded-xl hover:bg-paper-2 transition-colors">
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-navy">Pengumuman Resmi</span>
                                <span class="block font-display font-bold text-sm text-ink mt-0.5">Kelulusan Kelas XII TA 2024/2025</span>
                                <span class="block text-xs text-ink-muted mt-0.5">Akses daring via lulus.smkn1denpasar.sch.id</span>
                            </a>
                            <a href="{{ route('publications.index', ['kategori' => 'berita']) }}" class="block px-3.5 py-2.5 rounded-xl hover:bg-paper-2 transition-colors border-t border-line">
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-navy">Sorotan Kegiatan</span>
                                <span class="block font-display font-bold text-sm text-ink mt-0.5">“When I Grow Up” Spirit Day!</span>
                                <span class="block text-xs text-ink-muted mt-0.5">Lihat seluruh publikasi resmi sekolah</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- 4. Portal Digital Resmi (4 Official Subdomains from smkn1denpasar.sch.id) --}}
                <div class="relative group" data-nav-dropdown>
                    <a
                        href="{{ route('ecosystem.index') }}"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-sm font-semibold transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-navy {{ request()->routeIs('ecosystem.*') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2 hover:text-navy' }}"
                    >
                        <span>Portal Digital</span>
                        <svg class="w-3.5 h-3.5 opacity-70 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <div class="invisible opacity-0 translate-y-1.5 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 group-focus-within:visible group-focus-within:opacity-100 group-focus-within:translate-y-0 transition-all duration-200 absolute right-0 top-full pt-2 w-80 z-50">
                        <div class="bg-paper rounded-2xl border-2 border-ink shadow-xl p-2 space-y-1">
                            @foreach($navEcosystemLinks as $ecoLink)
                                <a href="{{ $ecoLink->url }}" target="_blank" rel="noopener" class="block px-3.5 py-2.5 rounded-xl hover:bg-paper-2 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <span class="font-display font-bold text-sm text-navy">{{ $ecoLink->title }}</span>
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-paper-2 border border-line text-ink-muted">{{ $ecoLink->badge }} &nearr;</span>
                                    </div>
                                    <span class="block text-xs text-ink-muted mt-0.5 line-clamp-1">{{ $ecoLink->subtitle }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- 5. Kontak --}}
                <a
                    href="{{ route('contact.index') }}"
                    class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-navy {{ request()->routeIs('contact.*') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2 hover:text-navy' }}"
                >
                    Kontak
                </a>
            </nav>

            {{-- Right Actions: Instant Search + Direct e-Learning CTA + Mobile Hamburger --}}
            <div class="flex items-center gap-2.5">
                {{-- Search Modal Trigger Button --}}
                <button
                    type="button"
                    id="search-modal-trigger"
                    aria-label="Buka Pencarian Cepat"
                    class="inline-flex items-center gap-2.5 px-3 py-2 rounded-xl bg-paper-2 border border-line hover:border-navy text-ink-muted hover:text-ink transition-colors text-xs font-medium cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-navy"
                >
                    <svg class="w-4 h-4 text-navy shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span class="hidden sm:inline pr-1">Cari Jurusan…</span>
                    <kbd class="hidden xl:inline-block px-1.5 py-0.5 text-[10px] font-bold bg-paper border border-line rounded text-ink-muted">Ctrl&nbsp;K</kbd>
                </button>

                {{-- Direct Link to Official e-Learning (lms.skensa.id) --}}
                <a
                    href="https://lms.skensa.id"
                    target="_blank"
                    rel="noopener"
                    class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-navy text-paper hover:bg-navy-700 transition-colors text-xs font-bold tracking-wider uppercase focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-navy focus-visible:ring-offset-2"
                >
                    <span class="w-2 h-2 rounded-full bg-yellow-skensa"></span>
                    <span>e-Learning</span>
                </a>

                {{-- Mobile Hamburger --}}
                <button
                    type="button"
                    id="mobile-menu-toggle"
                    class="lg:hidden p-2 rounded-xl border border-line bg-paper-2 text-ink hover:bg-line/40 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-navy"
                    aria-label="Buka Menu Navigasi"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation Panel --}}
        <div id="mobile-menu-panel" class="hidden lg:hidden border-t border-line bg-paper px-4 pt-3 pb-6 space-y-4 max-h-[80vh] overflow-y-auto">
            <form action="{{ route('search.index') }}" method="GET" class="flex items-center bg-paper-2 border border-line rounded-xl px-3.5 py-2 focus-within:border-navy">
                <input
                    type="search"
                    name="q"
                    value="{{ request('q') }}"
                    autocomplete="off"
                    placeholder="Cari dari 9 program & 12 konsentrasi keahlian…"
                    aria-label="Kata kunci pencarian"
                    class="bg-transparent text-sm text-ink w-full focus:outline-none"
                >
                <button type="submit" class="text-xs font-bold uppercase text-navy ml-2">Cari</button>
            </form>

            <div class="grid grid-cols-2 gap-2 text-sm font-semibold">
                <a href="{{ route('home') }}" class="px-3.5 py-2.5 rounded-xl bg-paper-2 hover:bg-navy hover:text-paper transition-colors">Beranda</a>
                <a href="{{ route('majors.index') }}" class="px-3.5 py-2.5 rounded-xl bg-paper-2 hover:bg-navy hover:text-paper transition-colors">12 Jurusan</a>
                <a href="{{ route('publications.index') }}" class="px-3.5 py-2.5 rounded-xl bg-paper-2 hover:bg-navy hover:text-paper transition-colors">Pengumuman</a>
                <a href="{{ route('contact.index') }}" class="px-3.5 py-2.5 rounded-xl bg-paper-2 hover:bg-navy hover:text-paper transition-colors">Kontak Resmi</a>
            </div>

            <div class="border-t border-line pt-3">
                <span class="block text-[10px] font-extrabold uppercase tracking-widest text-ink-muted mb-2">9 Program Keahlian Resmi</span>
                <div class="space-y-2">
                    @foreach($navFields as $field)
                        <div class="p-3 rounded-xl bg-paper-2 border border-line">
                            <span class="block text-xs font-extrabold uppercase text-navy mb-1">{{ $field->name }}</span>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($field->majors as $navMajor)
                                    <a href="{{ route('majors.show', $navMajor->slug) }}" class="text-xs font-semibold px-2.5 py-1 rounded-lg bg-paper border border-line text-ink hover:border-navy">
                                        {{ $navMajor->code }} - {{ $navMajor->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </header>

    {{-- Instant Search Command Modal (Ctrl+K / Cmd+K) --}}
    <div
        id="search-command-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="search-modal-title"
        class="hidden fixed inset-0 z-50 bg-ink/75 backdrop-blur-xs items-start justify-center pt-20 sm:pt-28 p-4"
    >
        <div class="w-full max-w-xl rounded-2xl bg-paper border-2 border-ink shadow-2xl overflow-hidden">
            <div class="px-5 py-3.5 bg-navy text-paper flex items-center justify-between">
                <span id="search-modal-title" class="text-xs font-bold uppercase tracking-widest text-yellow-skensa">Pencarian Akademik SKENSA</span>
                <button type="button" id="search-modal-close" class="text-xs font-bold uppercase text-paper/80 hover:text-paper cursor-pointer">Tutup [ESC]</button>
            </div>
            <form action="{{ route('search.index') }}" method="GET" class="p-5">
                <label for="global-search-input" class="sr-only">Cari program keahlian, konsentrasi keahlian, atau pengumuman</label>
                <div class="flex items-center gap-3 bg-paper-2 border-2 border-line focus-within:border-navy rounded-xl px-4 py-3">
                    <svg class="w-5 h-5 text-navy shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input
                        id="global-search-input"
                        type="search"
                        name="q"
                        value="{{ request('q') }}"
                        autocomplete="off"
                        placeholder="Ketik kode jurusan (TKP, DPIB, TAV, ELIN, TITL, TPTUP, TPM, TSM, TKR, TKJ, RPL, DKV, PRF)…"
                        class="w-full bg-transparent text-base text-ink placeholder:text-ink-muted focus:outline-none"
                    >
                    <button type="submit" class="px-4 py-1.5 rounded-lg bg-navy text-paper text-xs font-bold uppercase tracking-wider hover:bg-navy-700 cursor-pointer shrink-0">
                        Cari
                    </button>
                </div>
                <div class="mt-4 flex flex-wrap items-center gap-2 text-xs text-ink-muted">
                    <span class="font-semibold text-ink">Akses Cepat:</span>
                    <a href="{{ route('majors.show', 'rpl') }}" class="px-2.5 py-1 rounded-md bg-paper-2 border border-line hover:border-navy text-ink">RPL</a>
                    <a href="{{ route('majors.show', 'tkj') }}" class="px-2.5 py-1 rounded-md bg-paper-2 border border-line hover:border-navy text-ink">TKJ</a>
                    <a href="{{ route('majors.show', 'dpib') }}" class="px-2.5 py-1 rounded-md bg-paper-2 border border-line hover:border-navy text-ink">DPIB</a>
                    <a href="{{ route('majors.show', 'dkv') }}" class="px-2.5 py-1 rounded-md bg-paper-2 border border-line hover:border-navy text-ink">DKV</a>
                    <a href="{{ route('publications.index') }}" class="px-2.5 py-1 rounded-md bg-paper-2 border border-line hover:border-navy text-ink">Kelulusan 2024/2025</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Global Feedback Toast (Boundary State #4) --}}
    @if(session('toast_success') || session('error'))
        <div
            data-toast
            role="status"
            aria-live="polite"
            class="fixed bottom-6 right-6 z-50 max-w-md bg-navy text-paper border-l-4 {{ session('error') ? 'border-alert-skensa' : 'border-yellow-skensa' }} px-5 py-4 rounded-xl shadow-lg transition-all duration-300 flex items-start gap-3.5"
        >
            <div class="flex-1 text-sm">
                <p class="font-bold text-yellow-skensa uppercase tracking-wider text-xs mb-0.5">
                    {{ session('error') ? 'Peringatan Sistem' : 'Konfirmasi Sistem' }}
                </p>
                <p class="text-paper/95 leading-relaxed">{{ session('toast_success') ?? session('error') }}</p>
            </div>
            <button type="button" data-toast-close class="text-paper/60 hover:text-paper text-xs font-bold uppercase">Tutup</button>
        </div>
    @endif

    {{-- Main Page Content --}}
    <main id="main-content" class="flex-1">
        @yield('content')
    </main>

    {{-- Editorial Institutional Footer (100% Data Resmi smkn1denpasar.sch.id) --}}
    <footer class="bg-navy text-paper border-t-4 border-yellow-skensa mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-navy-700">
                {{-- Column 1: Official Identity & Contact --}}
                <div class="lg:col-span-4 space-y-4">
                    <div class="flex items-center gap-3.5">
                        <img src="/images/logo_emblem.png" alt="Logo SMK Negeri 1 Denpasar" width="48" height="48" loading="lazy" class="w-12 h-12 object-contain bg-paper p-1 rounded-lg">
                        <div>
                            <h2 class="font-display font-extrabold text-xl tracking-tight text-paper">SMK NEGERI 1 DENPASAR</h2>
                            <p class="text-xs font-semibold tracking-wider text-yellow-skensa">{{ $siteSettings['school_slogan'] ?? 'Abhyāsad Dhäryate Vidyä.' }}</p>
                        </div>
                    </div>
                    <p class="text-xs italic text-paper/80">
                        "{{ $siteSettings['school_slogan_meaning'] ?? 'Peliharalah ilmu sampai menjadi tradisi.' }}"
                    </p>
                    <p class="text-sm text-paper/90 leading-relaxed">
                        {{ $siteSettings['contact_address'] ?? 'Jalan HOS. Cokroaminoto No. 84 Denpasar, Bali 80118' }}
                    </p>
                    <div class="text-xs text-paper/85 space-y-1.5 pt-1">
                        <p><span class="font-bold text-yellow-skensa">Telepon:</span> <a href="tel:{{ $siteSettings['contact_phone'] ?? '081236396662' }}" class="hover:underline tabular-nums">{{ $siteSettings['contact_phone'] ?? '081236396662' }}</a></p>
                        <p><span class="font-bold text-yellow-skensa">Email:</span> <a href="mailto:{{ $siteSettings['contact_email'] ?? 'fo@smkn1denpasar.sch.id' }}" class="hover:underline">{{ $siteSettings['contact_email'] ?? 'fo@smkn1denpasar.sch.id' }}</a></p>
                    </div>
                </div>

                {{-- Column 2: 9 Program Keahlian --}}
                <div class="lg:col-span-5 space-y-3">
                    <h3 class="font-display font-bold text-sm uppercase tracking-wider text-yellow-skensa">9 Program &amp; 12 Konsentrasi Keahlian</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-xs text-paper/85">
                        @foreach($navFields as $field)
                            <div>
                                <span class="font-bold text-paper">{{ $field->name }}:</span>
                                <span class="text-paper/70">
                                    @foreach($field->majors as $m)
                                        <a href="{{ route('majors.show', $m->slug) }}" class="hover:text-yellow-skensa underline decoration-paper/30">{{ $m->code }}</a>{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Column 3: Tautan Ekosistem Resmi (smkn1denpasar.sch.id Footer) --}}
                <div class="lg:col-span-3 space-y-3">
                    <h3 class="font-display font-bold text-sm uppercase tracking-wider text-yellow-skensa">Tautan Resmi</h3>
                    <ul class="space-y-2.5 text-sm text-paper/85">
                        <li>
                            <a href="https://lib.smkn1denpasar.sch.id" target="_blank" rel="noopener" class="flex items-center justify-between hover:text-yellow-skensa transition-colors">
                                <span>e-Library</span>
                                <span class="text-xs text-paper/50">&nearr;</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://lms.skensa.id" target="_blank" rel="noopener" class="flex items-center justify-between hover:text-yellow-skensa transition-colors">
                                <span>e-Learning (LMS SKENSA)</span>
                                <span class="text-xs text-paper/50">&nearr;</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://tracervokasi.kemendikdasmen.go.id" target="_blank" rel="noopener" class="flex items-center justify-between hover:text-yellow-skensa transition-colors">
                                <span>Tracer Vokasi</span>
                                <span class="text-xs text-paper/50">&nearr;</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://lsp-smkn1denpasar.id" target="_blank" rel="noopener" class="flex items-center justify-between hover:text-yellow-skensa transition-colors">
                                <span>LSP SMKN 1 Denpasar</span>
                                <span class="text-xs text-paper/50">&nearr;</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://lulus.smkn1denpasar.sch.id" target="_blank" rel="noopener" class="flex items-center justify-between hover:text-yellow-skensa transition-colors">
                                <span>Portal Kelulusan</span>
                                <span class="text-xs text-paper/50">&nearr;</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-paper/65 gap-4">
                <p>&copy; {{ date('Y') }} SMK Negeri 1 Denpasar (SKENSA). Jalan HOS. Cokroaminoto No. 84 Denpasar, Bali 80118.</p>
                <div class="flex items-center gap-4">
                    <a href="https://www.facebook.com/smknegeri1denpasar" target="_blank" rel="noopener" class="hover:text-yellow-skensa">Facebook</a>
                    <a href="https://instagram.com/smkn1denpasar" target="_blank" rel="noopener" class="hover:text-yellow-skensa">Instagram</a>
                    <a href="https://youtube.com/@smkn1denpasar" target="_blank" rel="noopener" class="hover:text-yellow-skensa">YouTube</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
