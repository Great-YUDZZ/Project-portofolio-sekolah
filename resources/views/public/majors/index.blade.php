@extends('layouts.public')

@section('title', '9 Program & 12 Konsentrasi Keahlian - SMK Negeri 1 Denpasar')

@section('content')

    {{-- ===================================================================== --}}
    {{-- 1. HERO HEADER: STRUKTUR AKADEMIK & KURIKULUM VOKASI                  --}}
    {{-- ===================================================================== --}}
    <section class="relative bg-[#071C3F] text-white border-b-2 border-line py-16 sm:py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.07] pointer-events-none" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-reveal>
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="inline-block px-3 py-1 rounded-md bg-white text-[#071C3F] text-xs font-mono font-extrabold uppercase tracking-widest">
                    Struktur Akademik Resmi
                </span>
                <span class="inline-block px-3 py-1 rounded-md bg-white/10 border border-white/15 text-slate-200 text-xs font-mono uppercase tracking-wider">
                    Kurikulum Merdeka Vokasi • Akreditasi A
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end">
                <div class="lg:col-span-8">
                    <h1 class="font-display font-extrabold text-3xl sm:text-5xl lg:text-6xl text-white tracking-tight leading-[1.1]">
                        9 Program &amp; 12 Konsentrasi Keahlian
                    </h1>
                    <p class="text-slate-300 text-base sm:text-lg max-w-3xl mt-4 leading-relaxed">
                        Katalog kejuruan unggulan berbasis Teaching Factory (TeFa), pembelajaran praktik industri riil, dan uji sertifikasi kompetensi berlisensi BNSP melalui LSP-P1 SMK Negeri 1 Denpasar.
                    </p>
                </div>

                {{-- Metric Pills Strip --}}
                <div class="lg:col-span-4 grid grid-cols-2 gap-3" data-reveal-stagger>
                    <div class="p-3.5 rounded-xl bg-white/[0.06] border border-white/10 backdrop-blur-xs">
                        <div class="font-display font-extrabold text-2xl text-cyan-300 leading-none">9</div>
                        <div class="text-xs font-bold text-white mt-1.5 leading-snug">Program Keahlian</div>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/[0.06] border border-white/10 backdrop-blur-xs">
                        <div class="font-display font-extrabold text-2xl text-cyan-300 leading-none">12</div>
                        <div class="text-xs font-bold text-white mt-1.5 leading-snug">Konsentrasi Keahlian</div>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/[0.06] border border-white/10 backdrop-blur-xs">
                        <div class="font-display font-extrabold text-2xl text-cyan-300 leading-none">100%</div>
                        <div class="text-xs font-bold text-white mt-1.5 leading-snug">Terakreditasi A BAN-SM</div>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/[0.06] border border-white/10 backdrop-blur-xs">
                        <div class="font-display font-extrabold text-2xl text-cyan-300 leading-none">70+</div>
                        <div class="text-xs font-bold text-white mt-1.5 leading-snug">Mitra DUDIKA Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- 2. KATALOG JURUSAN & FILTER BIDANG KEAHLIAN                           --}}
    {{-- ===================================================================== --}}
    <section class="py-14 sm:py-20 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Filter Bidang Keahlian --}}
            <div data-reveal class="p-5 sm:p-6 rounded-2xl bg-paper-2 border border-line mb-10">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4">
                    <span class="text-xs font-mono font-bold uppercase tracking-widest text-navy">
                        Filter Berdasarkan Program Keahlian:
                    </span>
                    <span class="text-xs font-mono text-ink-muted">
                        Menampilkan <span class="font-bold text-ink">{{ $majors->count() }}</span> Konsentrasi Keahlian
                    </span>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a
                        href="{{ route('majors.index') }}"
                        class="px-3.5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all {{ !$fieldSlug ? 'bg-navy text-paper shadow-xs' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                    >
                        Semua Jurusan (12)
                    </a>
                    @foreach($fields as $field)
                        <a
                            href="{{ route('majors.index', ['bidang' => $field->slug]) }}"
                            class="px-3.5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all {{ $fieldSlug === $field->slug ? 'bg-navy text-paper shadow-xs' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                        >
                            {{ $field->name }} ({{ $field->majors_count }})
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Empty State --}}
            @if($majors->isEmpty())
                <div data-reveal class="p-16 rounded-3xl bg-paper-2 border border-line text-center max-w-xl mx-auto">
                    <div class="w-16 h-16 rounded-2xl bg-navy/10 text-navy flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h2 class="font-display font-extrabold text-2xl text-ink">Konsentrasi Keahlian Tidak Ditemukan</h2>
                    <p class="text-ink-muted text-sm mt-2">Tidak ada jurusan yang cocok dengan filter bidang keahlian yang dipilih.</p>
                    <a href="{{ route('majors.index') }}" class="inline-block mt-6 px-5 py-2.5 rounded-xl bg-navy text-paper text-xs font-bold uppercase tracking-wider hover:bg-slate-800 transition-colors">
                        Tampilkan Semua 12 Jurusan
                    </a>
                </div>
            @else
                {{-- Majors Cards Grid --}}
                <div data-reveal-stagger class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                        $majorShowcasePhotos = [
                            'TKJ'   => '/images/showcase/lab_fiber.jpg',
                            'TKP'   => '/images/showcase/ukk_2026.jpg',
                            'DPIB'  => '/images/showcase/ukk_2026.jpg',
                            'TPTUP' => '/images/showcase/daikin_coe.jpg',
                            'RPL'   => '/images/showcase/lks_2026.jpg',
                            'DKV'   => '/images/showcase/pengalaman_belajar.jpg',
                            'PRF'   => '/images/showcase/pengalaman_belajar.jpg',
                            'TP'    => '/images/showcase/ukk_2026.jpg',
                            'TKR'   => '/images/showcase/ukk_2026.jpg',
                            'TITL'  => '/images/showcase/daikin_coe.jpg',
                            'TEDK'  => '/images/showcase/lab_fiber.jpg',
                            'TKRO'  => '/images/showcase/ukk_2026.jpg',
                        ];
                    @endphp

                    @foreach($majors as $index => $major)
                        @php
                            $photo = $major->hero_image ?: ($majorShowcasePhotos[strtoupper($major->code)] ?? '/images/showcase/drone_kampus.jpg');
                        @endphp
                        <article class="group rounded-3xl bg-paper-2/70 border border-line hover:border-navy transition-all duration-300 overflow-hidden flex flex-col justify-between shadow-xs hover:shadow-lg">
                            <div>
                                {{-- Card Media Image --}}
                                <div class="relative aspect-video bg-navy overflow-hidden border-b border-line">
                                    <img
                                        src="{{ $photo }}"
                                        alt="Praktik {{ $major->name }} ({{ $major->code }}) SMK Negeri 1 Denpasar"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        loading="lazy"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-navy/70 via-transparent to-transparent opacity-80"></div>

                                    {{-- Badges --}}
                                    <div class="absolute top-4 left-4 right-4 flex items-center justify-between gap-2">
                                        <div class="flex items-center gap-2">
                                            <span class="px-2.5 py-1 rounded-md bg-white text-[#071C3F] text-xs font-mono font-extrabold uppercase tracking-wider shadow-xs">
                                                {{ $major->code }}
                                            </span>
                                            <span class="text-xs font-mono font-bold text-white/90 drop-shadow-xs">
                                                #{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                                            </span>
                                        </div>

                                        <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-white bg-navy/85 backdrop-blur-xs px-2.5 py-1 rounded-md border border-white/20 truncate max-w-[180px]">
                                            {{ $major->field?->name }}
                                        </span>
                                    </div>

                                    {{-- Major Code Subtitle on Image Bottom --}}
                                    <div class="absolute bottom-3 left-4 right-4">
                                        <span class="text-xs font-mono text-cyan-300 font-bold uppercase tracking-wider">
                                            Konsentrasi Keahlian
                                        </span>
                                    </div>
                                </div>

                                {{-- Card Content --}}
                                <div class="p-6">
                                    <h2 class="font-display font-extrabold text-xl sm:text-2xl text-ink group-hover:text-navy transition-colors leading-snug">
                                        <a href="{{ route('majors.show', $major->slug) }}" class="focus:outline-none focus:underline">
                                            {{ $major->name }}
                                        </a>
                                    </h2>

                                    <p class="text-sm text-ink-muted mt-3 leading-relaxed line-clamp-3">
                                        {{ $major->summary }}
                                    </p>

                                    {{-- Career Prospects Tags --}}
                                    @if(!empty($major->career_prospects))
                                        <div class="mt-5 pt-4 border-t border-line">
                                            <span class="block text-[10px] font-mono font-bold uppercase tracking-widest text-navy mb-2">
                                                Prospek Karir Utama:
                                            </span>
                                            <div class="flex flex-wrap gap-1.5">
                                                @foreach(array_slice((array) $major->career_prospects, 0, 3) as $career)
                                                    <span class="text-xs px-2.5 py-1 rounded-md bg-paper border border-line text-ink font-medium">
                                                        {{ $career }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Card Action Footer --}}
                            <div class="px-6 py-4 bg-paper border-t border-line flex items-center justify-between gap-3">
                                <span class="text-xs font-mono font-bold text-ink-muted">
                                    {{ $major->classrooms_count ?? $major->classrooms->count() }} Rombel Aktif
                                </span>

                                <a
                                    href="{{ route('majors.show', $major->slug) }}"
                                    class="inline-flex items-center gap-1.5 text-xs font-mono font-bold uppercase text-navy group-hover:text-blue-600 transition-colors"
                                >
                                    <span>Detail Kurikulum</span>
                                    <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

@endsection
