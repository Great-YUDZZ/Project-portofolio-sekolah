@extends('layouts.public')

@section('title', 'Warta, Pengumuman & Agenda Akademik - SMK Negeri 1 Denpasar')

@section('content')

    {{-- ============================================================= --}}
    {{-- HERO HEADER SECTION                                           --}}
    {{-- ============================================================= --}}
    <section class="bg-navy text-white border-b-2 border-line py-16 sm:py-20 relative overflow-hidden" data-reveal>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-white/[0.08] via-transparent to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-xs mb-4">
                <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                <span class="text-xs font-mono font-bold uppercase tracking-widest text-cyan-300">
                    Pusat Informasi &amp; Humas SKENSA
                </span>
            </div>

            <h1 class="font-display font-extrabold text-3xl sm:text-5xl lg:text-6xl text-white tracking-tight leading-tight">
                Publikasi, Pengumuman &amp; Agenda
            </h1>

            <p class="text-slate-300 text-sm sm:text-base max-w-3xl mt-4 leading-relaxed font-sans">
                Kanal komunikasi resmi sivitas akademika SMK Negeri 1 Denpasar untuk liputan kegiatan sekolah, pengumuman akademik, jadwal uji sertifikasi profesi BNSP LSP-P1, kemitraan DUDIKA, dan agenda kalender pendidikan.
            </p>

            {{-- Stat Counters --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-10 pt-8 border-t border-white/15 max-w-3xl">
                <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10">
                    <span class="block text-2xl sm:text-3xl font-display font-extrabold text-white">
                        {{ $counts['total'] }}
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-300 mt-1 block">
                        Total Warta Resmi
                    </span>
                </div>
                <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10">
                    <span class="block text-2xl sm:text-3xl font-display font-extrabold text-cyan-300">
                        {{ $counts['berita'] }}
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-300 mt-1 block">
                        Berita Sekolah
                    </span>
                </div>
                <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10">
                    <span class="block text-2xl sm:text-3xl font-display font-extrabold text-amber-400">
                        {{ $counts['pengumuman'] }}
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-300 mt-1 block">
                        Pengumuman
                    </span>
                </div>
                <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10">
                    <span class="block text-2xl sm:text-3xl font-display font-extrabold text-emerald-400">
                        {{ $counts['events'] }}
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-300 mt-1 block">
                        Agenda Mendatang
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================= --}}
    {{-- MAIN CONTENT & SIDEBAR SECTION                                --}}
    {{-- ============================================================= --}}
    <section class="py-12 sm:py-16 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- Left Column: Publications List (Col 8) --}}
            <div class="lg:col-span-8 space-y-8">

                {{-- Filter Kategori --}}
                <div class="p-4 sm:p-5 rounded-2xl bg-paper-2 border border-line flex flex-wrap items-center justify-between gap-3" data-reveal>
                    <div class="flex flex-wrap items-center gap-2">
                        @php
                            $cats = [
                                '' => 'Semua Warta (' . $counts['total'] . ')',
                                'berita' => 'Berita (' . $counts['berita'] . ')',
                                'pengumuman' => 'Pengumuman (' . $counts['pengumuman'] . ')',
                            ];
                        @endphp
                        @foreach($cats as $key => $label)
                            <a
                                href="{{ route('publications.index', array_filter(['kategori' => $key ?: null])) }}"
                                class="px-4 py-2 rounded-xl text-xs font-mono font-bold uppercase tracking-wider transition-all duration-200 {{ ($category ?? '') === $key ? 'bg-navy text-white shadow-xs' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                            >
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>

                    <span class="text-xs font-mono text-ink-muted">
                        Menampilkan {{ $posts->count() }} artikel
                    </span>
                </div>

                {{-- Posts Stream --}}
                @if($posts->isEmpty())
                    <div class="p-12 sm:p-16 rounded-3xl bg-paper-2 border border-line text-center max-w-lg mx-auto" data-reveal>
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-navy/10 text-navy flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                        <h2 class="font-display font-extrabold text-xl text-ink">Belum Ada Publikasi pada Kategori Ini</h2>
                        <p class="text-xs sm:text-sm text-ink-muted mt-2 leading-relaxed">
                            Tidak ada warta atau pengumuman yang sesuai dengan filter yang Anda tentukan saat ini.
                        </p>
                        <a
                            href="{{ route('publications.index') }}"
                            class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl bg-navy text-white text-xs font-mono font-bold uppercase tracking-wider hover:bg-navy-light transition-colors"
                        >
                            <span>Tampilkan Semua Publikasi</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                @else
                    <div class="space-y-6" data-reveal-stagger>
                        @foreach($posts as $post)
                            @php
                                $wordCount = str_word_count(strip_tags($post->content));
                                $readTime = max(1, (int) ceil($wordCount / 200));
                            @endphp
                            <article data-reveal-item class="p-6 sm:p-7 rounded-3xl bg-paper-2/70 border border-line hover:border-navy hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row gap-6 group">
                                {{-- Thumbnail if available --}}
                                @if($post->thumbnail)
                                    <div class="sm:w-56 aspect-video sm:aspect-4/3 rounded-2xl bg-navy overflow-hidden shrink-0 border border-line">
                                        <img
                                            src="{{ $post->thumbnail }}"
                                            alt="{{ $post->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            loading="lazy"
                                        >
                                    </div>
                                @endif

                                <div class="flex-1 flex flex-col justify-between">
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2 mb-3">
                                            <span class="px-2.5 py-1 rounded-md text-[11px] font-mono font-extrabold uppercase {{ $post->category === 'pengumuman' ? 'bg-amber-400 text-amber-950' : 'bg-navy text-white' }}">
                                                {{ $post->category }}
                                            </span>
                                            <span class="text-xs font-mono text-ink-muted">
                                                {{ optional($post->published_at)->format('d F Y') }}
                                            </span>
                                            <span class="text-xs font-mono text-ink-muted">
                                                • {{ $readTime }} menit baca
                                            </span>
                                        </div>

                                        <h2 class="font-display font-extrabold text-xl sm:text-2xl text-ink group-hover:text-navy transition-colors leading-snug">
                                            <a href="{{ route('publications.show', $post->slug) }}">
                                                {{ $post->title }}
                                            </a>
                                        </h2>

                                        <p class="text-xs sm:text-sm text-ink-muted mt-2.5 leading-relaxed line-clamp-3">
                                            {{ $post->excerpt }}
                                        </p>
                                    </div>

                                    <div class="mt-5 pt-4 border-t border-line/70 flex items-center justify-between text-xs">
                                        <span class="font-mono text-ink-muted">
                                            Redaksi Humas SKENSA
                                        </span>
                                        <a
                                            href="{{ route('publications.show', $post->slug) }}"
                                            class="inline-flex items-center gap-1 font-mono font-bold uppercase tracking-wider text-navy group-hover:underline"
                                        >
                                            <span>Baca Selengkapnya</span>
                                            <span>&rarr;</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Right Column: Agenda & Layanan Sekolah (Col 4) --}}
            <aside class="lg:col-span-4 space-y-8" data-reveal>

                {{-- Agenda Akademik Card --}}
                <div class="p-6 sm:p-7 rounded-3xl bg-navy text-white border-2 border-line shadow-sm space-y-6">
                    <div class="flex items-center justify-between pb-4 border-b border-white/15">
                        <div>
                            <span class="text-[11px] font-mono font-bold uppercase tracking-widest text-cyan-300 block mb-1">
                                Kalender Pendidikan
                            </span>
                            <h3 class="font-display font-extrabold text-xl text-white">
                                Agenda Terdekat
                            </h3>
                        </div>
                        <span class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-cyan-300">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </span>
                    </div>

                    @if($events->isEmpty())
                        <p class="text-xs text-slate-300">Belum ada agenda kegiatan yang dijadwalkan dalam waktu dekat.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($events as $event)
                                <div class="p-4 rounded-2xl bg-white/[0.06] border border-white/10 hover:border-white/20 transition-colors">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-0.5 rounded bg-white/15 text-cyan-300 text-[11px] font-mono font-bold">
                                            {{ optional($event->start_time)->format('d M Y') }}
                                        </span>
                                        <span class="text-[11px] font-mono text-slate-300">
                                            {{ optional($event->start_time)->format('H:i') }} WITA
                                        </span>
                                    </div>
                                    <h4 class="font-display font-bold text-sm text-white leading-snug">
                                        {{ $event->title }}
                                    </h4>
                                    <div class="flex items-start gap-1.5 mt-2 text-[11px] font-mono text-slate-300">
                                        <svg class="w-3.5 h-3.5 shrink-0 text-cyan-300 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <span>{{ $event->location }}</span>
                                    </div>
                                    <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                                        {{ $event->description }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Quick Link Box: Pusat Layanan Terpadu --}}
                <div class="p-6 rounded-3xl bg-paper-2 border border-line space-y-4">
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-navy block">
                        Layanan Resmi Terkait
                    </span>
                    <ul class="space-y-2.5 text-xs font-mono">
                        <li>
                            <a href="https://lulus.smkn1denpasar.sch.id" target="_blank" rel="noopener noreferrer" class="p-3 rounded-xl bg-paper border border-line hover:border-navy flex items-center justify-between group transition-colors">
                                <span class="font-bold text-ink group-hover:text-navy">Portal Kelulusan Siswa</span>
                                <span class="text-ink-muted group-hover:text-navy">&rarr;</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('facilities.index') }}" class="p-3 rounded-xl bg-paper border border-line hover:border-navy flex items-center justify-between group transition-colors">
                                <span class="font-bold text-ink group-hover:text-navy">Fasilitas Bengkel &amp; Lab</span>
                                <span class="text-ink-muted group-hover:text-navy">&rarr;</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('achievements.index') }}" class="p-3 rounded-xl bg-paper border border-line hover:border-navy flex items-center justify-between group transition-colors">
                                <span class="font-bold text-ink group-hover:text-navy">Hall of Fame Prestasi</span>
                                <span class="text-ink-muted group-hover:text-navy">&rarr;</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact.index') }}" class="p-3 rounded-xl bg-paper border border-line hover:border-navy flex items-center justify-between group transition-colors">
                                <span class="font-bold text-ink group-hover:text-navy">Layanan Hubungan Masyarakat</span>
                                <span class="text-ink-muted group-hover:text-navy">&rarr;</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </aside>

        </div>
    </section>

@endsection
