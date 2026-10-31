@extends('layouts.public')

@section('title', 'Pencarian Global - SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-bold uppercase tracking-widest text-ink">Mesin Pencari Terpadu SKENSA</span>
            <h1 class="font-display font-extrabold text-3xl sm:text-4xl mt-2">
                Hasil Pencarian: "{{ $q ?: 'Semua Entitas' }}"
            </h1>

            <form action="{{ route('search.index') }}" method="GET" class="mt-5 flex flex-col sm:flex-row gap-3 max-w-2xl">
                <input
                    type="search"
                    name="q"
                    value="{{ $q }}"
                    placeholder="Ketik nama jurusan, berita, karya siswa, prestasi, atau guru..."
                    class="flex-1 px-4 py-3 rounded-xl bg-paper text-ink text-sm font-medium focus:outline-none"
                >
                <button type="submit" class="px-6 py-3 rounded-xl bg-ink text-white hover:bg-slate-800 font-extrabold text-xs uppercase tracking-wider cursor-pointer transition-colors shadow-sm">
                    Cari Sekarang
                </button>
            </form>
        </div>
    </section>

    <section class="py-12 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            @if($q === '')
                {{-- Loading Skeleton / Initial Prompt State --}}
                <div class="p-10 rounded-2xl bg-paper-2 border border-line text-center">
                    <h2 class="font-display font-bold text-xl text-ink">Masukkan Kata Kunci Pencarian</h2>
                    <p class="text-sm text-ink-muted mt-1">Gunakan kolom di atas untuk mencari jurusan (misal: RPL, TKJ, DPIB), karya inovasi, prestasi, atau berita sekolah.</p>
                </div>
            @elseif($totalResults === 0)
                {{-- Empty State Boundary --}}
                <div class="p-12 rounded-2xl bg-paper-2 border border-line text-center">
                    <h2 class="font-display font-bold text-xl text-ink">Tidak Ditemukan Hasil untuk "{{ $q }}"</h2>
                    <p class="text-sm text-ink-muted mt-1">Coba gunakan kata kunci yang lebih umum atau periksa ejaan singkatan jurusan.</p>
                    <a href="{{ route('majors.index') }}" class="inline-block mt-4 px-4 py-2 rounded-lg bg-navy text-paper text-xs font-bold uppercase">
                        Jelajahi 12 Jurusan
                    </a>
                </div>
            @else
                <p class="text-xs font-bold uppercase tracking-widest text-navy">
                    Ditemukan {{ $totalResults }} entitas yang relevan dengan "{{ $q }}"
                </p>

                @if($majors->isNotEmpty())
                    <div>
                        <h2 class="font-display font-bold text-xl text-ink mb-4">Konsentrasi Keahlian ({{ $majors->count() }})</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($majors as $m)
                                <a href="{{ route('majors.show', $m->slug) }}" class="p-5 rounded-xl bg-paper-2 border border-line hover:border-ink block transition-colors">
                                    <span class="px-2 py-0.5 rounded bg-ink text-white text-xs font-bold">{{ $m->code }}</span>
                                    <h3 class="font-display font-bold text-base text-ink mt-2">{{ $m->name }}</h3>
                                    <p class="text-xs text-ink-muted mt-1 line-clamp-2">{{ $m->summary }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($works->isNotEmpty())
                    <div>
                        <h2 class="font-display font-bold text-xl text-ink mb-4">Karya Inovasi Siswa ({{ $works->count() }})</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($works as $w)
                                <div class="p-5 rounded-xl bg-paper-2 border border-line">
                                    <span class="text-xs font-bold text-navy">{{ $w->major?->code }} • {{ $w->student_name }}</span>
                                    <h3 class="font-display font-bold text-base text-ink mt-1">{{ $w->title }}</h3>
                                    <p class="text-xs text-ink-muted mt-1">{{ $w->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($posts->isNotEmpty())
                    <div>
                        <h2 class="font-display font-bold text-xl text-ink mb-4">Berita & Pengumuman ({{ $posts->count() }})</h2>
                        <div class="space-y-3">
                            @foreach($posts as $p)
                                <a href="{{ route('publications.show', $p->slug) }}" class="p-5 rounded-xl bg-paper-2 border border-line hover:border-navy block">
                                    <span class="text-xs font-bold uppercase text-navy">{{ $p->category }}</span>
                                    <h3 class="font-display font-bold text-lg text-ink">{{ $p->title }}</h3>
                                    <p class="text-xs text-ink-muted mt-1">{{ $p->excerpt }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($achievements->isNotEmpty())
                    <div>
                        <h2 class="font-display font-bold text-xl text-ink mb-4">Prestasi Siswa ({{ $achievements->count() }})</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($achievements as $a)
                                <div class="p-5 rounded-xl bg-paper-2 border border-line">
                                    <span class="text-xs font-bold text-navy">{{ $a->medal }} • {{ ucfirst($a->level) }}</span>
                                    <h3 class="font-display font-bold text-base text-ink mt-1">{{ $a->title }}</h3>
                                    <p class="text-xs text-ink-muted">{{ $a->winner_name }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($staff->isNotEmpty())
                    <div>
                        <h2 class="font-display font-bold text-xl text-ink mb-4">Direktori SDM ({{ $staff->count() }})</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($staff as $s)
                                <div class="p-4 rounded-xl bg-paper-2 border border-line">
                                    <h3 class="font-display font-bold text-base text-ink">{{ $s->name }}</h3>
                                    <p class="text-xs text-navy font-semibold">{{ $s->position }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </section>

@endsection
