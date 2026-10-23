@extends('layouts.public')

@section('title', 'Showcase Karya & Inovasi Siswa - SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block px-3 py-1 rounded bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-widest">
                Teaching Factory & Produk Kreatif
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3">Showcase Karya & Inovasi Siswa</h1>
            <p class="text-paper/80 text-base max-w-3xl mt-2">
                Katalog proyek rekayasa perangkat lunak, desain arsitektur, prototipe IoT, kendaraan listrik, film pendek, hingga produk kreatif karya siswa SKENSA.
            </p>
        </div>
    </section>

    <section class="py-12 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Filter Jurusan & Tahun --}}
            <form method="GET" action="{{ route('works.index') }}" class="p-5 rounded-2xl bg-paper-2 border border-line mb-10 flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-2">
                    <a
                        href="{{ route('works.index') }}"
                        class="px-3.5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ !$majorCode ? 'bg-navy text-paper' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                    >
                        Semua Jurusan
                    </a>
                    @foreach($majors as $m)
                        <a
                            href="{{ route('works.index', array_filter(['jurusan' => $m->code, 'tahun' => $year])) }}"
                            class="px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ $majorCode === $m->code ? 'bg-navy text-paper' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                        >
                            {{ $m->code }}
                        </a>
                    @endforeach
                </div>

                @if($years->isNotEmpty())
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold uppercase text-ink-muted">Tahun:</span>
                        @foreach($years as $y)
                            <a
                                href="{{ route('works.index', array_filter(['jurusan' => $majorCode, 'tahun' => $y])) }}"
                                class="px-3 py-1.5 rounded-lg text-xs font-bold {{ (int) $year === (int) $y ? 'bg-yellow-skensa text-ink' : 'bg-paper border border-line text-ink' }}"
                            >
                                {{ $y }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </form>

            {{-- Empty State Boundary --}}
            @if($works->isEmpty())
                <div class="p-12 rounded-2xl bg-paper-2 border border-line text-center">
                    <h2 class="font-display font-bold text-xl text-ink">Karya Siswa Tidak Ditemukan</h2>
                    <p class="text-sm text-ink-muted mt-1">Belum ada karya siswa yang terdaftar pada filter jurusan atau tahun ini.</p>
                    <a href="{{ route('works.index') }}" class="inline-block mt-4 px-4 py-2 rounded-lg bg-navy text-paper text-xs font-bold uppercase">
                        Tampilkan Semua Karya
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($works as $work)
                        <article class="rounded-2xl bg-paper-2/70 border border-line overflow-hidden flex flex-col justify-between hover:border-navy transition-colors">
                            <div>
                                <div class="aspect-video bg-navy relative overflow-hidden border-b border-line">
                                    <img src="{{ $work->thumbnail ?: '/images/hero_siswa.jpg' }}" alt="{{ $work->title }}" class="w-full h-full object-cover">
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-navy text-yellow-skensa text-xs font-extrabold uppercase">
                                        {{ $work->major?->code ?? 'SKENSA' }} • {{ $work->year }}
                                    </span>
                                </div>
                                <div class="p-6">
                                    <h2 class="font-display font-bold text-xl text-ink">{{ $work->title }}</h2>
                                    <p class="text-xs font-bold text-navy mt-1">{{ $work->student_name }} ({{ $work->class_name }})</p>
                                    <p class="text-sm text-ink-muted mt-3 leading-relaxed">{{ $work->description }}</p>
                                </div>
                            </div>

                            <div class="px-6 py-4 border-t border-line flex items-center justify-between">
                                <button
                                    type="button"
                                    data-lightbox-src="{{ $work->thumbnail ?: '/images/hero_siswa.jpg' }}"
                                    data-lightbox-title="{{ $work->title }} - {{ $work->student_name }}"
                                    data-lightbox-desc="{{ $work->description }}"
                                    class="text-xs font-bold uppercase tracking-wider text-navy hover:underline cursor-pointer"
                                >
                                    Detail Pratinjau
                                </button>
                                @if($work->project_url)
                                    <a href="{{ $work->project_url }}" target="_blank" rel="noopener" class="text-xs font-bold uppercase text-ink hover:text-navy">
                                        Demo Proyek &nearr;
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

@endsection
