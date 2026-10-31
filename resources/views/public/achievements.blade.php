@extends('layouts.public')

@section('title', 'Direktori Prestasi & Kejuaraan - SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block px-3 py-1 rounded bg-ink text-white text-xs font-extrabold uppercase tracking-widest">
                Hall of Fame SKENSA
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3">Prestasi Siswa & Institusi</h1>
            <p class="text-paper/80 text-base max-w-3xl mt-2">
                Rekam jejak capaian medali Lomba Kompetensi Siswa (LKS), olimpiade vokasi, kejuaraan olahraga, dan penghargaan inovasi tingkat Kota, Provinsi, Nasional, hingga Internasional.
            </p>
        </div>
    </section>

    <section class="py-12 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Filter Tingkat --}}
            <div class="p-5 rounded-2xl bg-paper-2 border border-line mb-10 flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-2">
                    @php
                        $levels = [
                            '' => 'Semua Tingkat',
                            'internasional' => 'Internasional',
                            'nasional' => 'Nasional',
                            'provinsi' => 'Provinsi Bali',
                            'kota' => 'Kota Denpasar',
                        ];
                    @endphp
                    @foreach($levels as $k => $lbl)
                        <a
                            href="{{ route('achievements.index', array_filter(['tingkat' => $k ?: null, 'jurusan' => $majorCode])) }}"
                            class="px-3.5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ ($level ?? '') === $k ? 'bg-navy text-paper' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                        >
                            {{ $lbl }}
                        </a>
                    @endforeach
                </div>
            </div>

            @if($achievements->isEmpty())
                <div class="p-12 rounded-2xl bg-paper-2 border border-line text-center">
                    <h2 class="font-display font-bold text-xl text-ink">Data Prestasi Tidak Ditemukan</h2>
                    <a href="{{ route('achievements.index') }}" class="inline-block mt-4 px-4 py-2 rounded-lg bg-navy text-paper text-xs font-bold uppercase">
                        Reset Filter
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($achievements as $achievement)
                        <article class="p-6 rounded-2xl bg-paper-2/70 border border-line flex flex-col justify-between">
                            <div>
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <span class="px-3 py-1 rounded bg-ink text-white text-xs font-extrabold uppercase">
                                        {{ $achievement->medal }}
                                    </span>
                                    <span class="px-3 py-1 rounded bg-navy text-paper text-xs font-bold uppercase">
                                        Tingkat {{ ucfirst($achievement->level) }}
                                    </span>
                                    <span class="text-xs font-bold text-ink-muted">{{ $achievement->year }}</span>
                                </div>
                                <h2 class="font-display font-bold text-xl text-ink">{{ $achievement->title }}</h2>
                                <p class="text-sm text-ink-muted mt-1">{{ $achievement->competition_name }}</p>
                            </div>

                            <div class="mt-5 pt-4 border-t border-line flex items-center justify-between text-xs font-bold">
                                <span class="text-navy">Peraih: {{ $achievement->winner_name }}</span>
                                <span class="px-2.5 py-0.5 rounded bg-paper border border-line text-ink">
                                    {{ $achievement->major?->code ?? 'SKENSA' }}
                                </span>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

@endsection
