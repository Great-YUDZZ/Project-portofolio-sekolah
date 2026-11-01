<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Panel SMKN 1 Denpasar</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full text-slate-800 antialiased font-sans selection:bg-amber-100 selection:text-amber-900">
    <div class="min-h-full flex flex-col lg:flex-row">
        <!-- Sidebar Navigation -->
        <aside id="panel-sidebar" class="w-full lg:w-72 bg-[#071C3F] text-slate-200 flex-shrink-0 flex flex-col border-r border-slate-800 lg:min-h-screen">
            <!-- Sidebar Header -->
            <div class="p-5 border-b border-slate-800/80 flex items-center justify-between">
                <a href="{{ route('panel.dashboard') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo_emblem.png') }}" alt="Logo Skensa" class="w-9 h-9 object-contain drop-shadow" />
                    <div>
                        <div class="text-xs uppercase tracking-widest text-amber-400 font-semibold">Panel Terpadu</div>
                        <div class="text-base font-bold text-white tracking-tight group-hover:text-amber-300 transition-colors">SMKN 1 Denpasar</div>
                    </div>
                </a>
                <button id="sidebar-mobile-toggle" class="lg:hidden p-2 text-slate-400 hover:text-white rounded-lg focus:outline-none" aria-label="Toggle Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- User Badge Box -->
            <div class="px-5 py-4 bg-slate-900/60 border-b border-slate-800/80 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-amber-500/20 border border-amber-500/40 text-amber-300 flex items-center justify-center font-bold text-sm uppercase">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <div class="min-w-0 flex-1">
                    <div class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</div>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="inline-block text-[11px] font-medium px-2 py-0.5 rounded {{ Auth::user()->isAdmin() ? 'bg-rose-950 text-rose-300 border border-rose-800' : (Auth::user()->isGuru() ? 'bg-amber-950 text-amber-300 border border-amber-800' : 'bg-emerald-950 text-emerald-300 border border-emerald-800') }}">
                            {{ Auth::user()->role_label }}
                        </span>
                        @if(Auth::user()->major)
                            <span class="text-[11px] text-slate-400 font-mono font-medium truncate">
                                {{ Auth::user()->major->code }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Nav Links -->
            <nav id="sidebar-nav-menu" class="flex-1 p-4 space-y-1 overflow-y-auto">
                <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-3 mb-2">Utama</div>

                <!-- Dashboard -->
                <a href="{{ route('panel.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('panel.dashboard') ? 'bg-amber-500 text-slate-950 font-semibold shadow-sm' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- Posts (Berita & Pengumuman) -->
                <a href="{{ route('panel.posts.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('panel.posts.*') ? 'bg-amber-500 text-slate-950 font-semibold shadow-sm' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <span>{{ Auth::user()->isSiswa() ? 'Berita Saya' : 'Berita & Pengumuman' }}</span>
                </a>

                @if(Auth::user()->isAdmin() || Auth::user()->isGuru())
                    <!-- Review Queue -->
                    @php
                        $pendingReviewsCount = \App\Models\Post::pending()
                            ->when(Auth::user()->isGuru() && Auth::user()->major_id, function($q) {
                                $q->where('major_id', Auth::user()->major_id);
                            })
                            ->count();
                    @endphp
                    <a href="{{ route('panel.review.index') }}"
                       class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('panel.review.*') ? 'bg-amber-500 text-slate-950 font-semibold shadow-sm' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Moderasi Berita</span>
                        </div>
                        @if($pendingReviewsCount > 0)
                            <span class="px-2 py-0.5 text-xs font-bold rounded-full {{ request()->routeIs('panel.review.*') ? 'bg-slate-900 text-amber-300' : 'bg-amber-500 text-slate-950' }}">
                                {{ $pendingReviewsCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Galeri Kegiatan -->
                    <a href="{{ route('panel.gallery.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('panel.gallery.*') ? 'bg-amber-500 text-slate-950 font-semibold shadow-sm' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Galeri Kegiatan</span>
                    </a>

                    <!-- Pengguna / Siswa -->
                    @php
                        $pendingStudentsCount = 0;
                        if (Auth::user()->isAdmin()) {
                            $pendingStudentsCount = \App\Models\User::where('role', 'siswa')->where('status', \App\Enums\UserStatus::Pending)->count();
                        } elseif (Auth::user()->isGuru() && Auth::user()->major_id) {
                            $pendingStudentsCount = \App\Models\User::where('role', 'siswa')->where('major_id', Auth::user()->major_id)->where('status', \App\Enums\UserStatus::Pending)->count();
                        }
                    @endphp
                    <a href="{{ route('panel.users.index') }}"
                       class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('panel.users.*') ? 'bg-amber-500 text-slate-950 font-semibold shadow-sm' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>{{ Auth::user()->isAdmin() ? 'Manajemen Pengguna' : 'Verifikasi Siswa' }}</span>
                        </div>
                        @if($pendingStudentsCount > 0)
                            <span class="px-2 py-0.5 text-xs font-bold rounded-full {{ request()->routeIs('panel.users.*') ? 'bg-slate-900 text-amber-300' : 'bg-amber-500 text-slate-950' }}">
                                {{ $pendingStudentsCount }}
                            </span>
                        @endif
                    </a>
                @endif

                @if(Auth::user()->isAdmin())
                    <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-3 pt-4 mb-2">Administrasi Sistem</div>

                    <!-- Staff -->
                    <a href="{{ route('panel.staff.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('panel.staff.*') ? 'bg-amber-500 text-slate-950 font-semibold shadow-sm' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Tenaga Pendidik & Staf</span>
                    </a>

                    <!-- Server Monitor -->
                    <a href="{{ route('panel.server.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('panel.server.*') ? 'bg-amber-500 text-slate-950 font-semibold shadow-sm' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>Beban Server & Sistem</span>
                    </a>

                    <!-- Audit Log -->
                    <a href="{{ route('panel.audit.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('panel.audit.*') ? 'bg-amber-500 text-slate-950 font-semibold shadow-sm' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Catatan Keamanan</span>
                    </a>
                @endif
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-slate-800/80 space-y-2">
                <a href="{{ route('home') }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-3 py-2 text-xs font-semibold rounded-lg bg-slate-800/80 text-slate-300 hover:text-white hover:bg-slate-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span>Lihat Halaman Publik</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 text-xs font-semibold rounded-lg text-rose-300 bg-rose-950/40 hover:bg-rose-900/60 border border-rose-900/60 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Workspace Content -->
        <main class="flex-1 flex flex-col min-w-0 bg-slate-50">
            <!-- Topbar Header -->
            <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between sticky top-0 z-20">
                <div class="flex items-center gap-3">
                    <h1 class="text-xl font-bold text-slate-900 tracking-tight">@yield('page-title', 'Dashboard')</h1>
                    @yield('header-badge')
                </div>
                <div class="flex items-center gap-3">
                    @yield('header-actions')
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-100 border border-slate-200 text-xs text-slate-600 font-mono">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Sistem Aktif</span>
                    </div>
                </div>
            </header>

            <!-- Flash Notifications -->
            <div class="px-6 pt-5">
                @if(session('success') || session('status'))
                    <div data-toast class="mb-4 rounded-xl bg-emerald-50 border border-emerald-200 p-4 text-sm text-emerald-800 flex items-start justify-between shadow-xs">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('success') ?: session('status') }}</span>
                        </div>
                        <button type="button" data-toast-close class="text-emerald-500 hover:text-emerald-800 font-bold">&times;</button>
                    </div>
                @endif

                @if(session('warning'))
                    <div data-toast class="mb-4 rounded-xl bg-amber-50 border border-amber-200 p-4 text-sm text-amber-800 flex items-start justify-between shadow-xs">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>{{ session('warning') }}</span>
                        </div>
                        <button type="button" data-toast-close class="text-amber-500 hover:text-amber-800 font-bold">&times;</button>
                    </div>
                @endif

                @if(isset($errors) && $errors->any())
                    <div data-toast class="mb-4 rounded-xl bg-rose-50 border border-rose-200 p-4 text-sm text-rose-800 flex items-start justify-between shadow-xs">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-rose-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <div class="font-semibold mb-1">Terdapat beberapa kendala yang perlu diperiksa:</div>
                                <ul class="list-disc list-inside space-y-0.5">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" data-toast-close class="text-rose-500 hover:text-rose-800 font-bold">&times;</button>
                    </div>
                @endif
            </div>

            <!-- Page Body -->
            <div class="flex-1 p-6">
                @yield('content')
            </div>

            <!-- Panel Footer -->
            <footer class="px-6 py-4 border-t border-slate-200 bg-white text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-2">
                <div>SMKN 1 Denpasar &copy; {{ date('Y') }} - Panel Terpadu Portofolio & Informasi Akademik</div>
                <div class="flex items-center gap-4 text-slate-400">
                    <span>Versi Sistem 2.4-Hardened</span>
                    <span>Protokol Keamanan RBAC Aktif</span>
                </div>
            </footer>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
