@extends('layouts.public')

@section('title', 'Ekosistem Layanan Digital SKENSA - SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block px-3 py-1 rounded bg-ink text-white text-xs font-extrabold uppercase tracking-widest">
                Infrastruktur Digital Terintegrasi
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3">Ekosistem Layanan Digital SKENSA</h1>
            <p class="text-paper/80 text-base max-w-3xl mt-2">
                Satu pintu akses menuju Learning Management System (LMS) SKENSA, Bursa Kerja Khusus (BKK), LSP-P1, Perpustakaan Digital, e-Rapor, dan Dapodik.
            </p>
        </div>
    </section>

    <section class="py-14 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($links as $link)
                    <article class="p-6 rounded-2xl bg-paper-2/70 border border-line flex flex-col justify-between hover:border-ink transition-colors">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-3">
                                <span class="px-2.5 py-0.5 rounded bg-ink text-white text-xs font-extrabold uppercase">
                                    {{ $link->category }}
                                </span>
                                <span class="text-xs font-bold text-ink-muted">Aktif</span>
                            </div>

                            <h2 class="font-display font-extrabold text-2xl text-ink">{{ $link->name }}</h2>
                            <p class="text-sm text-ink-muted mt-3 leading-relaxed">{{ $link->description }}</p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-line">
                            <a href="{{ $link->url }}" class="flex items-center justify-between w-full px-4 py-2.5 rounded-xl bg-navy text-paper hover:bg-navy-700 text-xs font-bold uppercase tracking-wider">
                                <span>Buka Layanan {{ $link->name }}</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

@endsection
