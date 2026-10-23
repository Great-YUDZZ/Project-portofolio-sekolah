@extends('layouts.public')

@section('title', 'Berita, Pengumuman & Agenda Sekolah - SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block px-3 py-1 rounded bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-widest">
                Ruang Redaksi & Humas SKENSA
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3">Publikasi, Pengumuman & Agenda</h1>
            <p class="text-paper/80 text-base max-w-3xl mt-2">
                Informasi resmi kegiatan akademik, jadwal uji kompetensi LSP-P1, rekrutmen industri, dan liputan prestasi siswa SMK Negeri 1 Denpasar.
            </p>
        </div>
    </section>

    <section class="py-12 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-8">
                {{-- Filter Kategori --}}
                <div class="flex flex-wrap gap-2 mb-8">
                    @php
                        $cats = [
                            '' => 'Semua Publikasi',
                            'berita' => 'Berita Sekolah',
                            'pengumuman' => 'Pengumuman Resmi',
                            'prestasi' => 'Liputan Prestasi',
                            'agenda' => 'Agenda',
                        ];
                    @endphp
                    @foreach($cats as $key => $label)
                        <a
                            href="{{ route('publications.index', array_filter(['kategori' => $key ?: null])) }}"
                            class="px-3.5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ ($category ?? '') === $key ? 'bg-navy text-paper' : 'bg-paper-2 text-ink border border-line hover:border-navy' }}"
                        >
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                @if($posts->isEmpty())
                    <div class="p-10 rounded-2xl bg-paper-2 border border-line text-center">
                        <h2 class="font-display font-bold text-lg text-ink">Belum Ada Publikasi pada Kategori Ini</h2>
                        <a href="{{ route('publications.index') }}" class="inline-block mt-3 text-xs font-bold uppercase text-navy hover:underline">Tampilkan Semua</a>
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($posts as $post)
                            <article class="p-6 rounded-2xl bg-paper-2/70 border border-line hover:border-navy transition-colors">
                                <div class="flex items-center gap-3 text-xs font-bold uppercase tracking-wider mb-2">
                                    <span class="px-2.5 py-0.5 rounded bg-yellow-skensa text-ink">{{ $post->category }}</span>
                                    <span class="text-ink-muted">{{ optional($post->published_at)->format('d M Y') }}</span>
                                </div>
                                <h2 class="font-display font-extrabold text-2xl text-ink hover:text-navy">
                                    <a href="{{ route('publications.show', $post->slug) }}">{{ $post->title }}</a>
                                </h2>
                                <p class="text-sm text-ink-muted mt-2 leading-relaxed">{{ $post->excerpt }}</p>
                                <div class="mt-4">
                                    <a href="{{ route('publications.show', $post->slug) }}" class="text-xs font-bold uppercase tracking-wider text-navy hover:underline">
                                        Baca Artikel Lengkap &rarr;
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>

            <aside class="lg:col-span-4 space-y-6">
                <div class="p-6 rounded-2xl bg-navy text-paper border-2 border-ink">
                    <h2 class="font-display font-bold text-lg text-yellow-skensa uppercase tracking-wider mb-4">Agenda Akademik Terdekat</h2>
                    <div class="space-y-4">
                        @foreach($events as $event)
                            <div class="p-4 rounded-xl bg-navy-700 border border-paper/15">
                                <div class="text-xs font-bold text-yellow-skensa">
                                    {{ optional($event->start_date)->format('d M Y') }}
                                </div>
                                <h3 class="font-display font-bold text-base text-paper mt-1">{{ $event->title }}</h3>
                                <p class="text-xs text-paper/75 mt-1">Lokasi: {{ $event->location }}</p>
                                <p class="text-xs text-paper/85 mt-2 leading-relaxed">{{ $event->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </section>

@endsection
