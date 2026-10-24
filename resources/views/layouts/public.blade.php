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

    {{-- Official SMKN 1 Denpasar Navbar (Exact Match with smkn1denpasar.sch.id) --}}
    <header id="site-navbar" class="sticky top-0 z-40 bg-[#ECEDF2]/95 backdrop-blur-md border-b border-black/5 transition-transform duration-300 ease-out will-change-transform translate-y-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-24 flex items-center justify-between gap-6">
            {{-- Left: Logo + Divider + 9-Dot Kompetensi Dropdown --}}
            <div class="flex items-center gap-6 shrink-0">
                <a href="{{ route('home') }}" class="flex items-center focus-visible:outline-none">
                    <img
                        src="/images/logo_emblem.png"
                        alt="Logo SMK Negeri 1 Denpasar"
                        width="58"
                        height="58"
                        fetchpriority="high"
                        class="w-14 h-14 object-contain"
                    >
                </a>

                {{-- Vertical Divider --}}
                <div class="hidden sm:block h-8 w-px bg-slate-300"></div>

                {{-- 9-Dot Kompetensi Dropdown --}}
                <div class="relative group hidden sm:block">
                    <button
                        type="button"
                        class="inline-flex items-center gap-2.5 py-2 text-[15px] font-medium text-[#0E1133] hover:text-[#2B4EFF] transition-colors cursor-pointer focus-visible:outline-none"
                    >
                        <svg class="w-4 h-4 text-[#0E1133] group-hover:text-[#2B4EFF] transition-colors" viewBox="0 0 18 18" fill="currentColor" aria-hidden="true">
                            <circle cx="2.5" cy="2.5" r="1.75"/><circle cx="9" cy="2.5" r="1.75"/><circle cx="15.5" cy="2.5" r="1.75"/>
                            <circle cx="2.5" cy="9" r="1.75"/><circle cx="9" cy="9" r="1.75"/><circle cx="15.5" cy="9" r="1.75"/>
                            <circle cx="2.5" cy="15.5" r="1.75"/><circle cx="9" cy="15.5" r="1.75"/><circle cx="15.5" cy="15.5" r="1.75"/>
                        </svg>
                        <span>Kompetensi</span>
                    </button>

                    {{-- Kompetensi Dropdown Menu --}}
                    <div class="invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 absolute left-0 top-full pt-3 w-60 z-50">
                        <ul class="bg-white shadow-xl border border-slate-100 py-1">
                            @foreach($navFields as $field)
                                <li class="border-b border-slate-100 last:border-b-0">
                                    <a
                                        href="{{ route('majors.index', ['bidang' => $field->slug]) }}"
                                        class="block px-5 py-3 text-[13px] font-medium text-[#0E1133] hover:bg-[#2B4EFF] hover:text-white transition-colors"
                                    >
                                        {{ $field->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Right: Primary Nav Links + Inline Search Box --}}
            <div class="flex items-center gap-8">
                <nav class="hidden lg:flex items-center gap-7 text-[15px] font-medium text-[#0E1133]" aria-label="Navigasi Utama">
                    {{-- 1. Home --}}
                    <a
                        href="{{ route('home') }}"
                        class="py-2 hover:text-[#2B4EFF] transition-colors {{ request()->routeIs('home') ? 'text-[#2B4EFF]' : 'text-[#0E1133]' }}"
                    >
                        Home
                    </a>

                    {{-- 2. Program (Cascading Multi-Level Flyout Dropdown) --}}
                    <div class="relative group">
                        <a
                            href="{{ route('majors.index') }}"
                            class="inline-flex items-center gap-1 py-2 hover:text-[#2B4EFF] transition-colors group-hover:text-[#2B4EFF] {{ request()->routeIs('majors.*') ? 'text-[#2B4EFF]' : 'text-[#0E1133]' }}"
                        >
                            <span>Program</span>
                            <svg class="w-3.5 h-3.5 mt-0.5 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>

                        {{-- First Level Dropdown: 9 Program Keahlian --}}
                        <div class="invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 absolute left-0 top-full pt-4 w-56 z-50">
                            <ul class="bg-white shadow-xl border border-slate-100">
                                @foreach($navFields as $field)
                                    <li class="relative group/sub border-b border-slate-100 last:border-b-0">
                                        <a
                                            href="{{ route('majors.index', ['bidang' => $field->slug]) }}"
                                            class="flex items-center justify-between gap-2 px-5 py-3.5 text-[13px] font-medium text-[#0E1133] group-hover/sub:bg-[#2B4EFF] group-hover/sub:text-white transition-colors leading-snug"
                                        >
                                            <span>{{ $field->name }}</span>
                                            <svg class="w-3.5 h-3.5 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>

                                        {{-- Second Level Flyout to the Right: Konsentrasi Keahlian --}}
                                        @if($field->majors->isNotEmpty())
                                            <div class="invisible opacity-0 translate-x-1 group-hover/sub:visible group-hover/sub:opacity-100 group-hover/sub:translate-x-0 transition-all duration-150 absolute left-full top-0 w-60 z-50">
                                                <ul class="bg-white shadow-xl border border-slate-100">
                                                    @foreach($field->majors as $navMajor)
                                                        <li class="border-b border-slate-100 last:border-b-0">
                                                            <a
                                                                href="{{ route('majors.show', $navMajor->slug) }}"
                                                                class="block px-5 py-3.5 text-[13px] font-medium text-[#0E1133] hover:bg-[#2B4EFF] hover:text-white transition-colors leading-snug"
                                                            >
                                                                {{ $navMajor->name }} ({{ $navMajor->code }})
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- 3. Blog --}}
                    <div class="relative group">
                        <a
                            href="{{ route('publications.index') }}"
                            class="inline-flex items-center gap-1 py-2 hover:text-[#2B4EFF] transition-colors group-hover:text-[#2B4EFF] {{ request()->routeIs('publications.*') && request('kategori') !== 'agenda' ? 'text-[#2B4EFF]' : 'text-[#0E1133]' }}"
                        >
                            <span>Blog</span>
                            <svg class="w-3.5 h-3.5 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                        <div class="invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 absolute left-0 top-full pt-4 w-48 z-50">
                            <ul class="bg-white shadow-xl border border-slate-100">
                                <li class="border-b border-slate-100">
                                    <a href="{{ route('publications.index', ['kategori' => 'berita']) }}" class="block px-5 py-3.5 text-[13px] font-medium text-[#0E1133] hover:bg-[#2B4EFF] hover:text-white transition-colors">
                                        Berita
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('publications.index', ['kategori' => 'pengumuman']) }}" class="block px-5 py-3.5 text-[13px] font-medium text-[#0E1133] hover:bg-[#2B4EFF] hover:text-white transition-colors">
                                        Pengumuman
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- 4. Agenda --}}
                    <a
                        href="{{ route('publications.index', ['kategori' => 'agenda']) }}"
                        class="py-2 hover:text-[#2B4EFF] transition-colors {{ request('kategori') === 'agenda' ? 'text-[#2B4EFF]' : 'text-[#0E1133]' }}"
                    >
                        Agenda
                    </a>

                    {{-- 5. Tentang --}}
                    <div class="relative group">
                        <a
                            href="{{ route('profile.index') }}"
                            class="inline-flex items-center gap-1 py-2 hover:text-[#2B4EFF] transition-colors group-hover:text-[#2B4EFF] {{ request()->routeIs('profile.*') || request()->routeIs('staff.*') || request()->routeIs('gallery.*') ? 'text-[#2B4EFF]' : 'text-[#0E1133]' }}"
                        >
                            <span>Tentang</span>
                            <svg class="w-3.5 h-3.5 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                        <div class="invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 absolute left-0 top-full pt-4 w-48 z-50">
                            <ul class="bg-white shadow-xl border border-slate-100">
                                <li class="border-b border-slate-100">
                                    <a href="{{ route('profile.index') }}#sejarah" class="block px-5 py-3.5 text-[13px] font-medium text-[#0E1133] hover:bg-[#2B4EFF] hover:text-white transition-colors">
                                        Sejarah
                                    </a>
                                </li>
                                <li class="border-b border-slate-100">
                                    <a href="{{ route('profile.index') }}#visi-misi" class="block px-5 py-3.5 text-[13px] font-medium text-[#0E1133] hover:bg-[#2B4EFF] hover:text-white transition-colors">
                                        Visi &amp; Misi
                                    </a>
                                </li>
                                <li class="border-b border-slate-100">
                                    <a href="{{ route('gallery.index') }}" class="block px-5 py-3.5 text-[13px] font-medium text-[#0E1133] hover:bg-[#2B4EFF] hover:text-white transition-colors">
                                        Fasilitas
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('staff.index') }}" class="block px-5 py-3.5 text-[13px] font-medium text-[#0E1133] hover:bg-[#2B4EFF] hover:text-white transition-colors">
                                        Staff
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- 6. Kontak --}}
                    <a
                        href="{{ route('contact.index') }}"
                        class="py-2 hover:text-[#2B4EFF] transition-colors {{ request()->routeIs('contact.*') ? 'text-[#2B4EFF]' : 'text-[#0E1133]' }}"
                    >
                        Kontak
                    </a>
                </nav>

                {{-- Far Right: White Search Input Box + Mobile Hamburger --}}
                <div class="flex items-center gap-3">
                    <form action="{{ route('search.index') }}" method="GET" class="hidden sm:flex items-center bg-white rounded-md px-4 py-2.5 w-52 lg:w-60 shadow-2xs border border-transparent focus-within:border-[#2B4EFF] transition-colors">
                        <button type="submit" aria-label="Cari" class="text-[#0E1133] hover:text-[#2B4EFF] mr-2.5 shrink-0 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                        <input
                            type="search"
                            name="q"
                            value="{{ request('q') }}"
                            autocomplete="off"
                            placeholder=""
                            aria-label="Cari"
                            class="w-full bg-transparent text-sm text-[#0E1133] focus:outline-none"
                        >
                    </form>

                    {{-- Mobile Hamburger --}}
                    <button
                        type="button"
                        id="mobile-menu-toggle"
                        class="lg:hidden p-2.5 rounded-lg bg-white text-[#0E1133] border border-slate-200 focus-visible:outline-none"
                        aria-label="Buka Menu Navigasi"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
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
