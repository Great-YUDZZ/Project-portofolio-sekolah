<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', ($siteSettings['school_name'] ?? 'SMK Negeri 1 Denpasar') . ' - ' . ($siteSettings['school_tagline'] ?? 'Abhyasad Dharyate Vidya'))</title>
    <meta name="description" content="@yield('meta_description', $siteSettings['hero_subtitle'] ?? 'Sekolah Menengah Kejuruan Pusat Keunggulan Teknologi dan Rekayasa di Provinsi Bali.')">
    <link rel="icon" type="image/png" href="/images/logo_emblem.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-paper text-ink antialiased selection:bg-yellow-skensa selection:text-ink min-h-screen flex flex-col">

    {{-- Top Utility Bar --}}
    <div class="bg-navy text-paper border-b border-navy-700 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-9 flex items-center justify-between">
            <div class="flex items-center gap-4 truncate">
                <span class="font-semibold tracking-wider text-yellow-skensa uppercase">NPSN {{ $siteSettings['school_npsn'] ?? '50103118' }}</span>
                <span class="hidden sm:inline text-paper/40">|</span>
                <span class="hidden sm:inline text-paper/80 italic">{{ $siteSettings['school_motto'] ?? 'Abhyasad Dharyate Vidya' }}</span>
            </div>
            <div class="flex items-center gap-4 shrink-0">
                <a href="{{ route('ecosystem.index') }}" class="hover:text-yellow-skensa transition-colors">Ekosistem Digital</a>
                <span class="text-paper/40">|</span>
                @auth
                    @if(auth()->user()->role->value === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="font-semibold text-yellow-skensa hover:underline">Panel Admin</a>
                    @else
                        <a href="{{ route('lms.dashboard') }}" class="font-semibold text-yellow-skensa hover:underline">Dashboard LMS</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-yellow-skensa hover:underline">Portal Login SKENSA</a>
                @endauth
            </div>
        </div>
    </div>

    {{-- Sticky Editorial Navbar --}}
    <header class="sticky top-0 z-40 bg-paper/95 backdrop-blur-sm border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
            {{-- Brand Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3.5 group shrink-0">
                <img src="/images/logo_emblem.png" alt="Logo SMK Negeri 1 Denpasar" class="w-11 h-11 object-contain transition-transform duration-300 group-hover:scale-105">
                <div>
                    <span class="block font-display font-extrabold text-lg leading-none tracking-tight text-navy">SMKN 1 DENPASAR</span>
                    <span class="block text-[11px] font-semibold tracking-widest uppercase text-ink-muted mt-1">SKENSA BALI • EST. {{ $siteSettings['school_founded'] ?? '1962' }}</span>
                </div>
            </a>

            {{-- Primary Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-1" aria-label="Navigasi Utama">
                <a href="{{ route('home') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('home') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2' }}">Beranda</a>
                <a href="{{ route('profile.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('profile.*') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2' }}">Profil</a>
                <a href="{{ route('majors.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('majors.*') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2' }}">13 Jurusan</a>
                <a href="{{ route('works.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('works.*') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2' }}">Karya Siswa</a>
                <a href="{{ route('achievements.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('achievements.*') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2' }}">Prestasi</a>
                <a href="{{ route('publications.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('publications.*') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2' }}">Publikasi</a>
                <a href="{{ route('staff.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('staff.*') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2' }}">SDM</a>
                <a href="{{ route('gallery.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('gallery.*') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2' }}">Galeri</a>
                <a href="{{ route('contact.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('contact.*') ? 'bg-navy text-paper' : 'text-ink hover:bg-paper-2' }}">Kontak</a>
            </nav>

            {{-- Right Actions: Search + 9-Dot Kompetensi Launcher + Mobile Button --}}
            <div class="flex items-center gap-2.5">
                <form action="{{ route('search.index') }}" method="GET" class="hidden md:flex items-center bg-paper-2 border border-line rounded-lg px-3 py-1.5 focus-within:border-navy">
                    <input
                        type="search"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari jurusan, berita..."
                        class="bg-transparent text-xs text-ink placeholder:text-ink-muted focus:outline-none w-36 xl:w-44"
                        aria-label="Pencarian Global"
                    >
                    <button type="submit" class="text-ink-muted hover:text-navy text-xs font-bold uppercase tracking-wider ml-1">Cari</button>
                </form>

                {{-- 9-Dot Mega-Drawer Trigger (Inspired by smkn1denpasar.sch.id) --}}
                <button
                    type="button"
                    id="mega-menu-toggle"
                    aria-expanded="false"
                    aria-controls="mega-menu-drawer"
                    class="inline-flex items-center gap-2.5 px-3.5 py-2 rounded-lg bg-navy text-paper hover:bg-navy-700 transition-colors text-xs font-bold tracking-wider uppercase cursor-pointer"
                    title="Buka 9 Bidang & 13 Konsentrasi Keahlian"
                >
                    <svg class="w-4 h-4 text-yellow-skensa" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <circle cx="5" cy="5" r="2"/><circle cx="12" cy="5" r="2"/><circle cx="19" cy="5" r="2"/>
                        <circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/>
                        <circle cx="5" cy="19" r="2"/><circle cx="12" cy="19" r="2"/><circle cx="19" cy="19" r="2"/>
                    </svg>
                    <span class="hidden sm:inline">Kompetensi</span>
                </button>

                {{-- Mobile Hamburger --}}
                <button
                    type="button"
                    id="mobile-menu-toggle"
                    class="lg:hidden p-2 rounded-lg border border-line bg-paper-2 text-ink hover:bg-line/40"
                    aria-label="Buka Menu Navigasi"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation Panel --}}
        <div id="mobile-menu-panel" class="hidden lg:hidden border-t border-line bg-paper px-4 pt-3 pb-6 space-y-3">
            <form action="{{ route('search.index') }}" method="GET" class="flex items-center bg-paper-2 border border-line rounded-lg px-3 py-2">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari jurusan, karya, berita..." class="bg-transparent text-sm text-ink w-full focus:outline-none">
                <button type="submit" class="text-xs font-bold uppercase text-navy ml-2">Cari</button>
            </form>
            <div class="grid grid-cols-2 gap-2 text-sm font-semibold">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded bg-paper-2 hover:bg-navy hover:text-paper">Beranda</a>
                <a href="{{ route('profile.index') }}" class="px-3 py-2 rounded bg-paper-2 hover:bg-navy hover:text-paper">Profil Sekolah</a>
                <a href="{{ route('majors.index') }}" class="px-3 py-2 rounded bg-paper-2 hover:bg-navy hover:text-paper">13 Jurusan</a>
                <a href="{{ route('works.index') }}" class="px-3 py-2 rounded bg-paper-2 hover:bg-navy hover:text-paper">Karya Siswa</a>
                <a href="{{ route('achievements.index') }}" class="px-3 py-2 rounded bg-paper-2 hover:bg-navy hover:text-paper">Prestasi</a>
                <a href="{{ route('publications.index') }}" class="px-3 py-2 rounded bg-paper-2 hover:bg-navy hover:text-paper">Publikasi</a>
                <a href="{{ route('staff.index') }}" class="px-3 py-2 rounded bg-paper-2 hover:bg-navy hover:text-paper">Direktori SDM</a>
                <a href="{{ route('gallery.index') }}" class="px-3 py-2 rounded bg-paper-2 hover:bg-navy hover:text-paper">Galeri</a>
                <a href="{{ route('ecosystem.index') }}" class="px-3 py-2 rounded bg-paper-2 hover:bg-navy hover:text-paper">Ekosistem Digital</a>
                <a href="{{ route('contact.index') }}" class="px-3 py-2 rounded bg-paper-2 hover:bg-navy hover:text-paper">Hubungi Kami</a>
            </div>
        </div>

        {{-- 9-Dot Mega-Drawer Panel --}}
        <div
            id="mega-menu-drawer"
            class="hidden opacity-0 translate-y-2 transition-all duration-200 absolute left-0 right-0 top-full bg-paper border-b-2 border-navy shadow-xl z-50"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between pb-4 mb-6 border-b border-line">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-navy">Matriks Akademik SKENSA</span>
                        <h3 class="font-display text-xl font-extrabold text-ink mt-0.5">9 Bidang Keahlian & 13 Konsentrasi Keahlian</h3>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('majors.index') }}" class="text-xs font-bold uppercase tracking-wider text-navy hover:underline">Lihat Katalog Lengkap</a>
                        <button type="button" id="mega-menu-close" class="px-3 py-1.5 rounded border border-line text-xs font-bold uppercase hover:bg-paper-2 cursor-pointer">Tutup [ESC]</button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-h-[65vh] overflow-y-auto pr-1">
                    @foreach($navFields as $field)
                        <div class="p-4 rounded-xl bg-paper-2/70 border border-line">
                            <div class="text-xs font-bold uppercase tracking-wider text-navy mb-2">{{ $field->name }}</div>
                            <ul class="space-y-1.5">
                                @foreach($field->majors as $navMajor)
                                    <li>
                                        <a href="{{ route('majors.show', $navMajor->slug) }}" class="flex items-center justify-between text-sm font-medium text-ink hover:text-navy group py-0.5">
                                            <span>{{ $navMajor->name }}</span>
                                            <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-paper border border-line group-hover:bg-yellow-skensa group-hover:border-yellow-skensa">{{ $navMajor->code }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </header>

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
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Global Lightbox Modal for Gallery & Karya --}}
    <div id="skensa-lightbox" class="hidden fixed inset-0 z-50 bg-ink/90 items-center justify-center p-4">
        <div class="max-w-4xl w-full bg-paper rounded-2xl overflow-hidden border border-line">
            <div class="flex items-center justify-between px-6 py-4 border-b border-line bg-paper-2">
                <h3 id="skensa-lightbox-title" class="font-display font-bold text-lg text-ink">Pratinjau Dokumentasi</h3>
                <button type="button" id="skensa-lightbox-close" class="px-3 py-1 rounded bg-navy text-paper text-xs font-bold uppercase cursor-pointer">Tutup [ESC]</button>
            </div>
            <div class="p-6 bg-ink flex items-center justify-center max-h-[70vh] overflow-hidden">
                <img id="skensa-lightbox-img" src="" alt="" class="max-h-[65vh] w-auto object-contain rounded">
            </div>
            <div class="px-6 py-4 bg-paper">
                <p id="skensa-lightbox-desc" class="text-sm text-ink-muted"></p>
            </div>
        </div>
    </div>

    {{-- Editorial Institutional Footer --}}
    <footer class="bg-navy text-paper border-t-4 border-yellow-skensa mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-navy-700">
                <div class="lg:col-span-4 space-y-4">
                    <div class="flex items-center gap-3.5">
                        <img src="/images/logo_emblem.png" alt="Logo SMK Negeri 1 Denpasar" class="w-12 h-12 object-contain bg-paper p-1 rounded-lg">
                        <div>
                            <h2 class="font-display font-extrabold text-xl tracking-tight text-paper">SMK NEGERI 1 DENPASAR</h2>
                            <p class="text-xs font-semibold uppercase tracking-widest text-yellow-skensa">{{ $siteSettings['school_motto'] ?? 'Abhyasad Dharyate Vidya' }}</p>
                        </div>
                    </div>
                    <p class="text-sm text-paper/80 leading-relaxed">
                        {{ $siteSettings['school_address'] ?? 'Jalan HOS Cokroaminoto No. 84, Kelurahan Ubung, Kecamatan Denpasar Utara, Kota Denpasar, Bali 80116' }}
                    </p>
                    <div class="text-xs text-paper/75 space-y-1">
                        <p><span class="font-bold text-yellow-skensa">Telepon:</span> {{ $siteSettings['school_phone'] ?? '081 339 276 998' }}</p>
                        <p><span class="font-bold text-yellow-skensa">Surel:</span> {{ $siteSettings['school_email'] ?? 'contact@smkn1denpasar.sch.id' }}</p>
                    </div>
                </div>

                <div class="lg:col-span-3 space-y-3">
                    <h3 class="font-display font-bold text-sm uppercase tracking-wider text-yellow-skensa">Navigasi Portofolio</h3>
                    <ul class="space-y-2 text-sm text-paper/85">
                        <li><a href="{{ route('profile.index') }}" class="hover:text-yellow-skensa transition-colors">Profil & Sejarah SKENSA</a></li>
                        <li><a href="{{ route('majors.index') }}" class="hover:text-yellow-skensa transition-colors">13 Konsentrasi Keahlian</a></li>
                        <li><a href="{{ route('works.index') }}" class="hover:text-yellow-skensa transition-colors">Showcase Karya Siswa</a></li>
                        <li><a href="{{ route('achievements.index') }}" class="hover:text-yellow-skensa transition-colors">Papan Prestasi & Juara</a></li>
                        <li><a href="{{ route('staff.index') }}" class="hover:text-yellow-skensa transition-colors">Direktori Guru & Manajemen</a></li>
                        <li><a href="{{ route('publications.index') }}" class="hover:text-yellow-skensa transition-colors">Berita & Agenda Sekolah</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-3 space-y-3">
                    <h3 class="font-display font-bold text-sm uppercase tracking-wider text-yellow-skensa">Ekosistem SKENSA</h3>
                    <ul class="space-y-2 text-sm text-paper/85">
                        <li><a href="{{ route('login') }}" class="hover:text-yellow-skensa transition-colors">LMS SKENSA Terpadu</a></li>
                        <li><a href="{{ route('ecosystem.index') }}" class="hover:text-yellow-skensa transition-colors">Bursa Kerja Khusus (BKK)</a></li>
                        <li><a href="{{ route('ecosystem.index') }}" class="hover:text-yellow-skensa transition-colors">LSP P1 SMKN 1 Denpasar</a></li>
                        <li><a href="{{ route('ecosystem.index') }}" class="hover:text-yellow-skensa transition-colors">Perpustakaan Digital</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-yellow-skensa transition-colors">Galeri Dokumentasi</a></li>
                        <li><a href="{{ route('contact.index') }}" class="hover:text-yellow-skensa transition-colors">Layanan Humas & Kontak</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-2 space-y-3">
                    <h3 class="font-display font-bold text-sm uppercase tracking-wider text-yellow-skensa">Akreditasi</h3>
                    <div class="p-4 rounded-xl bg-navy-700 border border-paper/15">
                        <div class="font-display text-3xl font-extrabold text-yellow-skensa">A</div>
                        <p class="text-xs text-paper/90 font-semibold mt-1">Unggul • SMK Pusat Keunggulan</p>
                        <p class="text-[11px] text-paper/70 mt-2">ISO 9001:2015 Certified Vocational High School</p>
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-paper/65 gap-4">
                <p>&copy; {{ date('Y') }} SMK Negeri 1 Denpasar (SKENSA). Seluruh hak cipta dilindungi.</p>
                <p>Dibangun dengan arsitektur Swiss-Brutalist Academic Editorial • Laravel 12 & GSAP</p>
            </div>
        </div>
    </footer>

</body>
</html>
