@extends('layouts.public')

@section('title', 'Galeri Dokumentasi Kegiatan & Praktik - SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block px-3 py-1 rounded bg-[#EAEDFF] text-[#2B4EFF] text-xs font-extrabold uppercase tracking-widest">
                Arsip Visual SKENSA
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3">Galeri Dokumentasi Sekolah</h1>
            <p class="text-paper/80 text-base max-w-3xl mt-2">
                Dokumentasi kegiatan praktik bengkel 13 konsentrasi keahlian, kejuaraan vokasi, gelar karya projek penguatan profil pelajar Pancasila, dan aktivitas sekolah.
            </p>
        </div>
    </section>

    <section class="py-14 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            @if($albums->isEmpty())
                <div class="p-12 rounded-2xl bg-paper-2 border border-line text-center">
                    <h2 class="font-display font-bold text-xl text-ink">Belum Ada Album Dokumentasi</h2>
                    <p class="text-sm text-ink-muted mt-1">Album foto dan video dokumentasi sekolah akan segera diunggah.</p>
                </div>
            @else
                @foreach($albums as $album)
                    <div class="p-8 rounded-2xl bg-paper-2/70 border border-line">
                        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2 pb-5 mb-6 border-b border-line">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-widest text-navy">
                                    {{ $album->category }} • {{ optional($album->event_date)->format('d M Y') }}
                                </span>
                                <h2 class="font-display font-extrabold text-2xl text-ink mt-1">{{ $album->title }}</h2>
                                <p class="text-sm text-ink-muted mt-1">{{ $album->description }}</p>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded bg-[#EAEDFF] text-[#2B4EFF] shrink-0">
                                {{ $album->photos->count() }} Foto Dokumentasi
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                            @foreach($album->photos as $photo)
                                <button
                                    type="button"
                                    data-lightbox-src="{{ $photo->image_path }}"
                                    data-lightbox-title="{{ $album->title }}"
                                    data-lightbox-desc="{{ $photo->caption }}"
                                    class="group text-left rounded-xl overflow-hidden bg-paper border border-line hover:border-navy transition-colors cursor-pointer"
                                >
                                    <div class="aspect-video bg-navy overflow-hidden border-b border-line">
                                        <img
                                            src="{{ $photo->image_path }}"
                                            alt="{{ $photo->caption }}"
                                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                        >
                                    </div>
                                    <div class="p-4">
                                        <p class="text-xs font-semibold text-ink line-clamp-2">{{ $photo->caption }}</p>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

@endsection
