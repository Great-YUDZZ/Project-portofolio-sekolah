@extends('layouts.public')

@section('title', $major->name . ' (' . $major->code . ') - SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center gap-2 text-xs font-bold uppercase tracking-widest">
                <a href="{{ route('majors.index') }}" class="text-yellow-skensa hover:underline">13 Jurusan</a>
                <span>/</span>
                <span class="text-paper/80">{{ $major->field?->name }}</span>
            </div>

            <div class="mt-4 flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                <div>
                    <span class="inline-block px-3 py-1 rounded bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-wider">
                        Kode Jurusan: {{ $major->code }}
                    </span>
                    <h1 class="font-display font-extrabold text-3xl sm:text-5xl mt-3">{{ $major->name }}</h1>
                    <p class="text-paper/85 text-base sm:text-lg max-w-3xl mt-3 leading-relaxed">
                        {{ $major->summary }}
                    </p>
                </div>

                @if($major->head_of_major)
                    <div class="p-5 rounded-2xl bg-navy-700 border border-paper/20 shrink-0">
                        <span class="text-[11px] font-bold uppercase tracking-widest text-yellow-skensa">Ketua Program Keahlian</span>
                        <div class="font-display font-bold text-base text-paper mt-1">{{ $major->head_of_major }}</div>
                        <div class="text-xs text-paper/75 mt-1">{{ $major->classrooms->count() }} Rombongan Belajar Aktif</div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="py-14 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10">
            {{-- Main Content --}}
            <div class="lg:col-span-8 space-y-10">
                @php
                    $majorShowcasePhotos = [
                        'TKJ'   => '/images/showcase/lab_fiber.jpg',
                        'TKP'   => '/images/showcase/ukk_2026.jpg',
                        'DPIB'  => '/images/showcase/ukk_2026.jpg',
                        'TPTUP' => '/images/showcase/daikin_coe.jpg',
                        'RPL'   => '/images/showcase/lks_2026.jpg',
                        'DKV'   => '/images/showcase/pengalaman_belajar.jpg',
                        'PRF'   => '/images/showcase/pengalaman_belajar.jpg',
                    ];
                    $majorPhoto = $major->hero_image ?: ($majorShowcasePhotos[strtoupper($major->code)] ?? '/images/showcase/drone_kampus.jpg');
                @endphp

                <div class="rounded-2xl bg-paper-2/70 border-2 border-ink overflow-hidden">
                    <div class="relative aspect-video bg-navy border-b-2 border-ink overflow-hidden">
                        <img src="{{ $majorPhoto }}" alt="Dokumentasi Praktik {{ $major->name }} ({{ $major->code }}) SMK Negeri 1 Denpasar" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-md bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-wider">
                            Dokumentasi {{ $major->code }}
                        </span>
                    </div>
                    <div class="p-8">
                        <h2 class="font-display font-extrabold text-2xl text-ink mb-4">Deskripsi &amp; Kompetensi Inti {{ $major->name }}</h2>
                        <p class="text-ink-muted leading-relaxed">
                            {{ $major->description ?: $major->summary }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 rounded-2xl bg-paper-2/70 border border-line">
                        <h3 class="font-display font-bold text-lg text-navy mb-3">Prospek Karir Lulusan</h3>
                        <ul class="space-y-2 text-sm text-ink">
                            @forelse((array) $major->career_prospects as $career)
                                <li class="p-3 rounded-lg bg-paper border border-line font-semibold">{{ $career }}</li>
                            @empty
                                <li class="text-ink-muted">Teknisi Profesional, Wirausaha Mandiri, dan Studi Lanjut</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="p-6 rounded-2xl bg-paper-2/70 border border-line">
                        <h3 class="font-display font-bold text-lg text-navy mb-3">Fasilitas Bengkel & Mitra Industri</h3>
                        <ul class="space-y-2 text-sm text-ink">
                            @forelse((array) $major->facilities_list as $fac)
                                <li class="p-3 rounded-lg bg-paper border border-line font-semibold">{{ $fac }}</li>
                            @empty
                                <li class="p-3 rounded-lg bg-paper border border-line font-semibold">Laboratorium Praktik Standar Industri {{ $major->code }}</li>
                            @endforelse
                        </ul>

                        @if(!empty($major->industry_partners))
                            <h4 class="font-display font-bold text-xs uppercase tracking-wider text-ink-muted mt-5 mb-2">Mitra DUDI:</h4>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach((array) $major->industry_partners as $partner)
                                    <span class="px-2.5 py-1 rounded bg-navy text-yellow-skensa text-xs font-bold">{{ $partner }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Rombongan Belajar --}}
                <div class="p-6 rounded-2xl bg-paper-2/70 border border-line">
                    <h3 class="font-display font-bold text-lg text-ink mb-4">Struktur Kelas / Rombongan Belajar ({{ $major->code }})</h3>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach($major->classrooms as $room)
                            <span class="px-3.5 py-2 rounded-xl bg-paper border border-line text-xs font-bold text-navy">
                                {{ $room->name }} ({{ $room->academic_year }})
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Karya Siswa Jurusan Ini --}}
                @if($major->studentWorks->isNotEmpty())
                    <div>
                        <h3 class="font-display font-extrabold text-2xl text-ink mb-4">Karya Inovasi Siswa {{ $major->code }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @foreach($major->studentWorks as $work)
                                <div class="p-5 rounded-2xl bg-paper-2 border border-line">
                                    <span class="text-xs font-bold text-navy">{{ $work->year }} • {{ $work->student_name }}</span>
                                    <h4 class="font-display font-bold text-base text-ink mt-1">{{ $work->title }}</h4>
                                    <p class="text-xs text-ink-muted mt-2">{{ $work->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar: Jurusan Lainnya --}}
            <aside class="lg:col-span-4 space-y-6">
                <div class="p-6 rounded-2xl bg-paper-2 border border-line">
                    <h3 class="font-display font-bold text-base uppercase tracking-wider text-navy mb-4">Konsentrasi Keahlian Lainnya</h3>
                    <ul class="space-y-2">
                        @foreach($otherMajors as $other)
                            <li>
                                <a href="{{ route('majors.show', $other->slug) }}" class="flex items-center justify-between p-2.5 rounded-lg bg-paper hover:bg-navy hover:text-paper text-sm font-semibold transition-colors">
                                    <span class="truncate pr-2">{{ $other->name }}</span>
                                    <span class="text-xs font-bold px-2 py-0.5 rounded bg-yellow-skensa text-ink shrink-0">{{ $other->code }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </section>

@endsection
