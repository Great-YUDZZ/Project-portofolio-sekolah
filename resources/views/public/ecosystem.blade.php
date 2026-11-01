@extends('layouts.public')

@section('title', 'Ekosistem Layanan Digital SKENSA - SMK Negeri 1 Denpasar')

@section('content')

    {{-- Hero Section --}}
    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-reveal>
            <span class="inline-block px-3 py-1 rounded bg-ink text-white text-xs font-extrabold uppercase tracking-widest">
                Infrastruktur Digital Terintegrasi
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3 tracking-tight">Ekosistem Layanan Digital SKENSA</h1>
            <p class="text-paper/80 text-base max-w-3xl mt-2 leading-relaxed">
                Satu pintu akses resmi menuju Learning Management System (LMS) SKENSA, Bursa Kerja Khusus (BKK), Lembaga Sertifikasi Profesi (LSP-P1), Perpustakaan Digital, e-Rapor Vokasi, dan Sistem Kelulusan Daring.
            </p>

            {{-- Trust & Infrastructure Status Bar --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 pt-8 border-t border-paper/10 text-xs">
                <div class="p-3.5 rounded-xl bg-paper/5 border border-paper/10 flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shrink-0 animate-pulse"></span>
                    <div>
                        <span class="text-white font-bold block">Status Sistem</span>
                        <span class="text-paper/70 text-[11px]">99.9% Operasional</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-paper/5 border border-paper/10 flex items-center gap-3">
                    <svg class="w-4 h-4 text-white shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <div>
                        <span class="text-white font-bold block">Protokol Keamanan</span>
                        <span class="text-paper/70 text-[11px]">Enkripsi SSL / TLS 1.3</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-paper/5 border border-paper/10 flex items-center gap-3">
                    <svg class="w-4 h-4 text-white shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <div>
                        <span class="text-white font-bold block">Otentikasi Civitas</span>
                        <span class="text-paper/70 text-[11px]">Single Sign-On (SSO)</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-paper/5 border border-paper/10 flex items-center gap-3">
                    <svg class="w-4 h-4 text-white shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <span class="text-white font-bold block">Sinkronisasi Data</span>
                        <span class="text-paper/70 text-[11px]">Dapodik Kemendikdasmen</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Service Portals Grid --}}
    <section class="py-14 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8 pb-4 border-b border-line" data-reveal>
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Gerbang Akses Daring</span>
                    <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-ink mt-1">Daftar Portal Layanan Resmi</h2>
                </div>
                <p class="text-xs font-semibold text-ink-muted">
                    Pilih portal tujuan Anda untuk dialihkan ke sub-sistem resmi SKENSA.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-reveal-stagger>
                @foreach($links as $link)
                    <article class="p-6 rounded-2xl bg-paper-2/70 border border-line flex flex-col justify-between hover:border-navy hover:bg-paper-2 transition-all duration-200 group">
                        <div>
                            {{-- Header Badge & Status --}}
                            <div class="flex items-center justify-between gap-2 mb-4">
                                <span class="px-2.5 py-1 rounded bg-navy text-paper text-[10px] font-extrabold uppercase tracking-wider">
                                    {{ $link->badge ?: 'Layanan Digital' }}
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                    Aktif
                                </span>
                            </div>

                            {{-- Portal Title & Description --}}
                            <h3 class="font-display font-extrabold text-xl text-ink group-hover:text-navy transition-colors leading-snug">
                                {{ $link->title }}
                            </h3>
                            <p class="text-sm text-ink-muted mt-2.5 leading-relaxed">
                                {{ $link->subtitle }}
                            </p>
                        </div>

                        {{-- Footer: URL & Direct Action --}}
                        <div class="mt-6 pt-4 border-t border-line">
                            <div class="flex items-center justify-between text-xs text-ink-muted mb-3 font-mono">
                                <span class="truncate max-w-[220px]" title="{{ $link->url }}">{{ parse_url($link->url, PHP_URL_HOST) ?? $link->url }}</span>
                                <span class="text-[10px] uppercase font-sans font-bold text-navy">Resmi</span>
                            </div>

                            <a
                                href="{{ $link->url }}"
                                target="_blank"
                                rel="noopener"
                                class="flex items-center justify-between w-full px-4 py-2.5 rounded-xl bg-navy text-paper hover:bg-navy-700 text-xs font-bold uppercase tracking-wider transition-colors shadow-xs"
                            >
                                <span>Kunjungi Portal Layanan</span>
                                <span class="text-sm">&nearr;</span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Helpdesk & SSO Assistance Card --}}
            <div class="mt-14 p-8 rounded-2xl bg-white border-2 border-line flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 shadow-xs" data-reveal>
                <div class="space-y-2 max-w-2xl">
                    <span class="px-2.5 py-0.5 rounded bg-ink text-white text-[10px] font-extrabold uppercase tracking-wider">
                        Bantuan Akses Akun &amp; SSO
                    </span>
                    <h3 class="font-display font-bold text-xl text-ink">Mengalami Kendala Saat Masuk ke Portal Layanan?</h3>
                    <p class="text-xs text-ink-muted leading-relaxed">
                        Jika Anda siswa baru yang belum menerima aktivasi akun LMS atau lupa kata sandi akun e-Rapor dan e-Library, silakan hubungi tim Helpdesk Pusat Komputer (Puskom) SKENSA dengan menyertakan NISN atau NIP resmi.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <a
                        href="https://wa.me/6281236396662?text=Halo%20Admin%20Puskom%20SKENSA,%20saya%20membutuhkan%20bantuan%20akses%20akun%20layanan%20digital."
                        target="_blank"
                        rel="noopener"
                        class="px-5 py-2.5 rounded-xl bg-navy text-paper hover:bg-navy-700 text-xs font-bold uppercase tracking-wider transition-colors shadow-xs"
                    >
                        WhatsApp Helpdesk IT &nearr;
                    </a>
                    <a
                        href="{{ route('contact.index') }}"
                        class="px-4 py-2.5 rounded-xl bg-paper border border-line text-xs font-bold text-ink hover:border-navy uppercase tracking-wider transition-colors"
                    >
                        Formulir Bantuan
                    </a>
                </div>
            </div>

        </div>
    </section>

@endsection
