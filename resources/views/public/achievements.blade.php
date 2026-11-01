@extends('layouts.public')

@section('title', 'Hall of Fame & Direktori Prestasi Siswa - SMK Negeri 1 Denpasar')

@section('content')

    {{-- ============================================================= --}}
    {{-- HERO HEADER SECTION                                           --}}
    {{-- ============================================================= --}}
    <section class="bg-navy text-white border-b-2 border-line py-16 sm:py-20 relative overflow-hidden" data-reveal>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-white/[0.08] via-transparent to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-xs mb-4">
                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                <span class="text-xs font-mono font-bold uppercase tracking-widest text-cyan-300">
                    Hall of Fame Vokasi SKENSA
                </span>
            </div>

            <h1 class="font-display font-extrabold text-3xl sm:text-5xl lg:text-6xl text-white tracking-tight leading-tight">
                Rekam Jejak Prestasi &amp; Kejuaraan
            </h1>

            <p class="text-slate-300 text-sm sm:text-base max-w-3xl mt-4 leading-relaxed font-sans">
                Etalase dedikasi, kedisiplinan, dan penguasaan kompetensi presisi para talenta muda SMK Negeri 1 Denpasar pada panggung kompetisi bergengsi Lomba Kompetensi Siswa (LKS), festival seni kreasi, dan kejuaraan inovasi teknologi tingkat Kota, Provinsi Bali, hingga Nasional.
            </p>

            {{-- Metric Stat Counters --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-10 pt-8 border-t border-white/15">
                <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10">
                    <span class="block text-2xl sm:text-3xl font-display font-extrabold text-amber-400">
                        {{ $stats['gold'] }}
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-300 mt-1 block">
                        Medali Emas &amp; Juara 1
                    </span>
                </div>
                <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10">
                    <span class="block text-2xl sm:text-3xl font-display font-extrabold text-cyan-300">
                        {{ $stats['national'] }}
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-300 mt-1 block">
                        Tingkat Nasional
                    </span>
                </div>
                <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10">
                    <span class="block text-2xl sm:text-3xl font-display font-extrabold text-white">
                        {{ $stats['provincial'] }}
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-300 mt-1 block">
                        Tingkat Provinsi Bali
                    </span>
                </div>
                <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10">
                    <span class="block text-2xl sm:text-3xl font-display font-extrabold text-white">
                        {{ $stats['total'] }}
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-300 mt-1 block">
                        Total Prestasi Terverifikasi
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================= --}}
    {{-- HALL OF FAME TOP TIER PODIUM (NASIONAL)                       --}}
    {{-- ============================================================= --}}
    @if(!$level && !$majorCode && $hallOfFame->isNotEmpty())
        <section class="py-12 bg-paper-2 border-b border-line" data-reveal>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="text-xs font-mono font-bold uppercase tracking-widest text-navy block mb-1">
                            Sorotan Juara Utama
                        </span>
                        <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-ink">
                            Podium Kejuaraan Nasional Terkini
                        </h2>
                    </div>
                    <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-900 text-xs font-mono font-bold">
                        Peringkat Tertinggi LKS RI
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($hallOfFame as $index => $hof)
                        <div class="p-6 sm:p-7 rounded-3xl bg-paper border-2 border-line hover:border-navy hover:shadow-md transition-all duration-300 flex flex-col justify-between relative overflow-hidden group">
                            {{-- Top Accent Bar --}}
                            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600"></div>

                            <div>
                                <div class="flex items-center justify-between gap-3 mb-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-amber-400 text-amber-950 text-xs font-mono font-extrabold uppercase shadow-2xs">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        {{ $hof->medal }}
                                    </span>
                                    <span class="text-xs font-mono font-bold text-ink-muted">
                                        {{ $hof->year }}
                                    </span>
                                </div>

                                <h3 class="font-display font-extrabold text-lg sm:text-xl text-ink group-hover:text-navy transition-colors leading-snug mb-2">
                                    {{ $hof->title }}
                                </h3>

                                <p class="text-xs text-ink-muted leading-relaxed mb-4">
                                    {{ $hof->description }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-line flex items-center justify-between text-xs">
                                <div>
                                    <span class="text-[10px] font-mono uppercase text-ink-muted block">Peraih Juara:</span>
                                    <span class="font-bold text-ink text-sm">{{ $hof->winner_name }}</span>
                                </div>
                                @if($hof->major)
                                    <a href="{{ route('majors.show', strtolower($hof->major->code)) }}" class="px-2.5 py-1 rounded-md bg-navy text-white text-[11px] font-mono font-bold uppercase tracking-wider hover:bg-navy-light transition-colors">
                                        {{ $hof->major->code }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============================================================= --}}
    {{-- MAIN DIRECTORY & FILTER SECTION                               --}}
    {{-- ============================================================= --}}
    <section class="py-12 sm:py-16 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Filter Panel --}}
            <div data-reveal class="p-5 sm:p-6 rounded-3xl bg-paper-2 border border-line mb-10 space-y-4">
                {{-- Filter Tingkat --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-ink-muted shrink-0">
                        Tingkat Kompetisi:
                    </span>
                    <div class="flex flex-wrap items-center gap-2">
                        @php
                            $levels = [
                                '' => 'Semua Tingkat',
                                'nasional' => 'Nasional',
                                'provinsi' => 'Provinsi Bali',
                                'kota' => 'Kota Denpasar',
                            ];
                        @endphp
                        @foreach($levels as $k => $lbl)
                            <a
                                href="{{ route('achievements.index', array_filter(['tingkat' => $k ?: null, 'jurusan' => $majorCode])) }}"
                                class="px-3.5 py-2 rounded-xl text-xs font-mono font-bold uppercase tracking-wider transition-all duration-200 {{ ($level ?? '') === $k ? 'bg-navy text-white shadow-xs' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                            >
                                {{ $lbl }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Filter Jurusan --}}
                <div class="pt-4 border-t border-line/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-ink-muted shrink-0">
                        Program Keahlian:
                    </span>
                    <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                        <a
                            href="{{ route('achievements.index', array_filter(['tingkat' => $level])) }}"
                            class="px-3 py-1.5 rounded-lg text-xs font-mono font-bold uppercase {{ !$majorCode ? 'bg-navy text-white' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                        >
                            Semua Jurusan
                        </a>
                        @foreach($majors as $m)
                            <a
                                href="{{ route('achievements.index', array_filter(['tingkat' => $level, 'jurusan' => $m->code])) }}"
                                class="px-2.5 py-1.5 rounded-lg text-xs font-mono font-bold uppercase {{ $majorCode === $m->code ? 'bg-navy text-white' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                            >
                                {{ $m->code }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Empty State --}}
            @if($achievements->isEmpty())
                <div class="p-12 sm:p-16 rounded-3xl bg-paper-2 border border-line text-center max-w-lg mx-auto" data-reveal>
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-navy/10 text-navy flex items-center justify-center mb-4">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                    <h2 class="font-display font-extrabold text-xl text-ink">Data Prestasi Belum Ditemukan</h2>
                    <p class="text-xs sm:text-sm text-ink-muted mt-2 leading-relaxed">
                        Tidak ada catatan prestasi yang sesuai dengan kriteria filter yang Anda pilih saat ini.
                    </p>
                    <a
                        href="{{ route('achievements.index') }}"
                        class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl bg-navy text-white text-xs font-mono font-bold uppercase tracking-wider hover:bg-navy-light transition-colors"
                    >
                        <span>Reset Semua Filter</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            @else
                {{-- Achievement Cards Grid --}}
                <div data-reveal-stagger class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($achievements as $achievement)
                        @php
                            $isGold = str_contains($achievement->medal, 'Emas') || str_contains($achievement->medal, 'Juara 1');
                            $isSilver = str_contains($achievement->medal, 'Perak') || str_contains($achievement->medal, 'Juara 2');
                        @endphp
                        <article data-reveal-item class="p-6 sm:p-7 rounded-3xl bg-paper-2/70 border border-line hover:border-navy hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                            <div>
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <span class="px-3 py-1 rounded-lg text-xs font-mono font-extrabold uppercase {{ $isGold ? 'bg-amber-400 text-amber-950' : ($isSilver ? 'bg-slate-300 text-slate-900' : 'bg-orange-800 text-white') }}">
                                        {{ $achievement->medal }}
                                    </span>
                                    <span class="px-2.5 py-1 rounded-md bg-paper border border-line text-ink font-mono text-xs font-bold uppercase">
                                        Tingkat {{ ucfirst($achievement->level) }}
                                    </span>
                                    <span class="text-xs font-mono font-bold text-ink-muted ml-auto">
                                        Tahun {{ $achievement->year }}
                                    </span>
                                </div>

                                <h2 class="font-display font-extrabold text-lg sm:text-xl text-ink group-hover:text-navy transition-colors leading-snug">
                                    {{ $achievement->title }}
                                </h2>

                                <p class="text-xs sm:text-sm text-ink-muted mt-2 leading-relaxed">
                                    {{ $achievement->description }}
                                </p>
                            </div>

                            <div class="mt-6 pt-4 border-t border-line flex items-center justify-between text-xs">
                                <div>
                                    <span class="text-[10px] font-mono uppercase text-ink-muted block">Nama Peraih:</span>
                                    <span class="font-bold text-ink text-sm">{{ $achievement->winner_name }}</span>
                                </div>

                                @if($achievement->major)
                                    <a
                                        href="{{ route('majors.show', strtolower($achievement->major->code)) }}"
                                        class="px-2.5 py-1 rounded-lg bg-navy text-white text-xs font-mono font-bold uppercase tracking-wider hover:bg-navy-light transition-colors"
                                        title="Buka Jurusan {{ $achievement->major->name }}"
                                    >
                                        {{ $achievement->major->code }}
                                    </a>
                                @else
                                    <span class="px-2.5 py-1 rounded-lg bg-paper border border-line text-ink-muted text-xs font-mono font-bold uppercase">
                                        SKENSA
                                    </span>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

@endsection
