@extends('layouts.public')

@section('title', 'Galeri Dokumentasi Kegiatan & Event - SMK Negeri 1 Denpasar')

@section('content')

    {{-- ===================================================================== --}}
    {{-- 1. HERO HEADER: ARSIP DOKUMENTASI VISUAL                              --}}
    {{-- ===================================================================== --}}
    <section class="relative bg-[#071C3F] text-white border-b-2 border-line py-16 sm:py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.07] pointer-events-none" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-reveal>
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="inline-block px-3 py-1 rounded-md bg-white text-[#071C3F] text-xs font-mono font-extrabold uppercase tracking-widest">
                    Arsip Visual SKENSA
                </span>
                <span class="inline-block px-3 py-1 rounded-md bg-white/10 border border-white/15 text-slate-200 text-xs font-mono uppercase tracking-wider">
                    Dokumentasi Resmi &amp; Kesiswaan
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end">
                <div class="lg:col-span-8">
                    <h1 class="font-display font-extrabold text-3xl sm:text-5xl lg:text-6xl text-white tracking-tight leading-[1.1]">
                        Galeri Dokumentasi Kegiatan &amp; Event
                    </h1>
                    <p class="text-slate-300 text-base sm:text-lg max-w-3xl mt-4 leading-relaxed">
                        Arsip foto dan rekaman visual kegiatan resmi, peringatan HUT sekolah, upacara adat subakti, perlombaan LKS, pameran inovasi karya siswa, dan dinamika pembelajaran di SMK Negeri 1 Denpasar.
                    </p>
                </div>

                {{-- Banner Quick Link ke Fasilitas --}}
                <div class="lg:col-span-4 p-5 rounded-2xl bg-white/[0.08] border border-white/15 backdrop-blur-xs">
                    <span class="text-[11px] font-mono font-bold uppercase text-cyan-300 tracking-wider block mb-1">
                        Mencari Laboratorium &amp; Bengkel?
                    </span>
                    <p class="text-xs text-slate-300 leading-relaxed mb-3">
                        Lihat katalog sarana prasarana, bengkel rekayasa, dan CoE Daikin pada halaman fasilitas khusus.
                    </p>
                    <a
                        href="{{ route('facilities.index') }}"
                        class="inline-flex items-center gap-2 text-xs font-bold text-white hover:text-cyan-300 underline underline-offset-4"
                    >
                        <span>Jelajahi Fasilitas &amp; Lab Praktik</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- 2. ALBUM DOKUMENTASI RESMI                                            --}}
    {{-- ===================================================================== --}}
    <section class="py-14 sm:py-20 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            @if($albums->isEmpty())
                <div data-reveal class="p-16 rounded-3xl bg-paper-2 border border-line text-center max-w-xl mx-auto">
                    <div class="w-16 h-16 rounded-2xl bg-navy/10 text-navy flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h2 class="font-display font-extrabold text-2xl text-ink">Belum Ada Album Dokumentasi</h2>
                    <p class="text-ink-muted text-sm mt-2">Album foto kegiatan sekolah saat ini sedang dipersiapkan dan akan segera diperbarui oleh tim humas.</p>
                </div>
            @else
                @foreach($albums as $album)
                    <div data-reveal class="p-6 sm:p-8 rounded-3xl bg-paper-2/70 border border-line shadow-xs">
                        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-6 mb-8 border-b border-line">
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-2.5 py-1 rounded bg-navy text-white text-[11px] font-mono font-bold uppercase tracking-wider">
                                        {{ $album->category }}
                                    </span>
                                    <span class="text-xs font-mono text-ink-muted">
                                        {{ optional($album->event_date)->format('d F Y') }}
                                    </span>
                                </div>
                                <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-ink mt-1">
                                    {{ $album->title }}
                                </h2>
                                <p class="text-sm text-ink-muted mt-2 max-w-2xl leading-relaxed">
                                    {{ $album->description }}
                                </p>
                            </div>
                            <span class="px-3.5 py-1.5 rounded-xl bg-ink text-white text-xs font-mono font-bold uppercase tracking-wider shrink-0 self-start sm:self-auto">
                                {{ $album->photos->count() }} Dokumentasi Foto
                            </span>
                        </div>

                        <div data-reveal-stagger class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($album->photos as $photo)
                                <button
                                    type="button"
                                    data-gallery-lightbox="{{ $photo->image_path }}"
                                    data-gallery-title="{{ $album->title }}"
                                    data-gallery-desc="{{ $photo->caption }}"
                                    class="group text-left rounded-2xl overflow-hidden bg-paper border border-line hover:border-navy transition-all duration-300 cursor-pointer shadow-2xs hover:shadow-md"
                                >
                                    <div class="relative aspect-video bg-navy overflow-hidden border-b border-line">
                                        <img
                                            src="{{ $photo->image_path }}"
                                            alt="{{ $photo->caption }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                            loading="lazy"
                                        >
                                        <div class="absolute inset-0 bg-navy/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <span class="px-3 py-1.5 rounded-lg bg-navy/85 backdrop-blur-xs text-white text-xs font-mono font-bold">
                                                Lihat Ukuran Penuh &rarr;
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <p class="text-xs font-semibold text-ink line-clamp-2 leading-snug">
                                            {{ $photo->caption }}
                                        </p>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- MODAL LIGHTBOX IMAGE VIEWER                                           --}}
    {{-- ===================================================================== --}}
    <div id="gallery-lightbox-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-navy/90 backdrop-blur-sm" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="relative max-w-4xl w-full bg-paper rounded-2xl overflow-hidden shadow-2xl border border-line">
            <button type="button" id="gallery-lightbox-close" class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-navy/80 text-white flex items-center justify-center hover:bg-navy transition-colors cursor-pointer" aria-label="Tutup foto">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <div class="aspect-video bg-navy overflow-hidden">
                <img id="gallery-lightbox-img" src="" alt="" class="w-full h-full object-contain">
            </div>
            <div class="p-5 sm:p-6 bg-paper-2">
                <h3 id="gallery-lightbox-title" class="font-display font-extrabold text-xl text-ink"></h3>
                <p id="gallery-lightbox-desc" class="text-xs sm:text-sm text-ink-muted mt-1 leading-relaxed"></p>
            </div>
        </div>
    </div>

    {{-- Gallery Lightbox Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('gallery-lightbox-modal');
            const closeBtn = document.getElementById('gallery-lightbox-close');
            const modalImg = document.getElementById('gallery-lightbox-img');
            const modalTitle = document.getElementById('gallery-lightbox-title');
            const modalDesc = document.getElementById('gallery-lightbox-desc');

            document.querySelectorAll('[data-gallery-lightbox]').forEach(function (trigger) {
                trigger.addEventListener('click', function () {
                    const src = trigger.getAttribute('data-gallery-lightbox');
                    const title = trigger.getAttribute('data-gallery-title') || '';
                    const desc = trigger.getAttribute('data-gallery-desc') || '';

                    modalImg.src = src;
                    modalImg.alt = title;
                    modalTitle.textContent = title;
                    modalDesc.textContent = desc;

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    modal.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                });
            });

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modal.setAttribute('aria-hidden', 'true');
                modalImg.src = '';
                document.body.style.overflow = '';
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', closeModal);
            }

            if (modal) {
                modal.addEventListener('click', function (e) {
                    if (e.target === modal) {
                        closeModal();
                    }
                });
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        });
    </script>

@endsection
