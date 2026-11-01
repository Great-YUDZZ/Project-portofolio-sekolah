@extends('layouts.public')

@section('title', 'Fasilitas & Laboratorium Praktik Vokasi - SMK Negeri 1 Denpasar')

@section('content')

    {{-- ===================================================================== --}}
    {{-- 1. HERO HEADER: IDENTITAS SARANA PRASARANA VOKASI                     --}}
    {{-- ===================================================================== --}}
    <section class="relative bg-[#071C3F] text-white border-b-2 border-line py-16 sm:py-20 overflow-hidden">
        {{-- Subtle Grid Background --}}
        <div class="absolute inset-0 opacity-[0.07] pointer-events-none" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-reveal>
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="inline-block px-3 py-1 rounded-md bg-white text-[#071C3F] text-xs font-mono font-extrabold uppercase tracking-widest">
                    Infrastruktur SMK Pusat Keunggulan
                </span>
                <span class="inline-block px-3 py-1 rounded-md bg-white/10 border border-white/15 text-slate-200 text-xs font-mono uppercase tracking-wider">
                    Kampus Ubung • 3 Hektar Terpadu
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end">
                <div class="lg:col-span-8">
                    <h1 class="font-display font-extrabold text-3xl sm:text-5xl lg:text-6xl text-white tracking-tight leading-[1.1]">
                        Fasilitas &amp; Laboratorium Praktik Industri
                    </h1>
                    <p class="text-slate-300 text-base sm:text-lg max-w-3xl mt-4 leading-relaxed">
                        Sarana pembelajaran teaching factory, bengkel kerja presisi mekanik, laboratorium serat optik, studio kreatif, dan Center of Excellence berstandar industri internasional untuk mencetak lulusan siap kerja.
                    </p>
                </div>

                {{-- Metric Pills Strip --}}
                <div class="lg:col-span-4 grid grid-cols-2 gap-3" data-reveal-stagger>
                    <div class="p-3.5 rounded-xl bg-white/[0.06] border border-white/10 backdrop-blur-xs">
                        <div class="font-display font-extrabold text-2xl text-cyan-300 leading-none">13+</div>
                        <div class="text-xs font-bold text-white mt-1.5 leading-snug">Lab Komputer &amp; TIK</div>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/[0.06] border border-white/10 backdrop-blur-xs">
                        <div class="font-display font-extrabold text-2xl text-cyan-300 leading-none">9 Unit</div>
                        <div class="text-xs font-bold text-white mt-1.5 leading-snug">Bengkel Rekayasa Industri</div>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/[0.06] border border-white/10 backdrop-blur-xs">
                        <div class="font-display font-extrabold text-2xl text-cyan-300 leading-none">CoE</div>
                        <div class="text-xs font-bold text-white mt-1.5 leading-snug">Daikin International Hub</div>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/[0.06] border border-white/10 backdrop-blur-xs">
                        <div class="font-display font-extrabold text-2xl text-cyan-300 leading-none">ISO</div>
                        <div class="text-xs font-bold text-white mt-1.5 leading-snug">9001:2000 Certified</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- 2. FILTER & SHOWCASE FASILITAS                                        --}}
    {{-- ===================================================================== --}}
    <section class="py-14 sm:py-20 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Filter Kategori --}}
            <div data-reveal class="p-4 sm:p-5 rounded-2xl bg-paper-2 border border-line mb-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <span class="text-[11px] font-mono font-bold uppercase tracking-widest text-navy block mb-2">
                        Filter Kategori Sarana &amp; Fasilitas:
                    </span>
                    <div class="flex flex-wrap items-center gap-2">
                        @foreach($categories as $slug => $label)
                            <a
                                href="{{ route('facilities.index', ['kategori' => $slug]) }}"
                                class="px-3.5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all {{ $selectedCategory === $slug ? 'bg-navy text-paper shadow-xs' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                            >
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="text-xs font-mono text-ink-muted shrink-0 self-end md:self-center">
                    Menampilkan <span class="font-bold text-ink">{{ count($facilities) }}</span> dari {{ $totalCount }} Fasilitas
                </div>
            </div>

            {{-- Empty State --}}
            @if(empty($facilities))
                <div data-reveal class="p-16 rounded-3xl bg-paper-2 border border-line text-center max-w-xl mx-auto">
                    <div class="w-16 h-16 rounded-2xl bg-navy/10 text-navy flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h2 class="font-display font-extrabold text-2xl text-ink">Fasilitas Tidak Ditemukan</h2>
                    <p class="text-ink-muted text-sm mt-2">Tidak ada sarana prasarana yang sesuai dengan filter kategori yang dipilih.</p>
                    <a href="{{ route('facilities.index') }}" class="inline-block mt-6 px-5 py-2.5 rounded-xl bg-navy text-paper text-xs font-bold uppercase tracking-wider hover:bg-slate-800 transition-colors">
                        Tampilkan Semua Fasilitas
                    </a>
                </div>
            @else
                {{-- Facility Cards Grid --}}
                <div data-reveal-stagger class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($facilities as $facility)
                        <article class="group rounded-3xl bg-paper-2/70 border border-line hover:border-navy/50 transition-all duration-300 overflow-hidden flex flex-col justify-between shadow-xs hover:shadow-md">
                            <div>
                                {{-- Card Media Header --}}
                                <div class="relative aspect-video bg-navy overflow-hidden border-b border-line cursor-pointer" data-facility-lightbox="{{ $facility['image'] }}" data-facility-title="{{ $facility['name'] }}" data-facility-desc="{{ $facility['summary'] }}">
                                    <img
                                        src="{{ $facility['image'] }}"
                                        alt="{{ $facility['name'] }} SMK Negeri 1 Denpasar"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        loading="lazy"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-navy/60 via-transparent to-transparent opacity-60"></div>

                                    {{-- Badges on Media --}}
                                    <div class="absolute top-4 left-4 right-4 flex items-center justify-between gap-2">
                                        @if($facility['major_code'])
                                            <span class="px-3 py-1 rounded-lg bg-navy/90 backdrop-blur-xs text-white text-xs font-mono font-extrabold uppercase tracking-wider border border-white/20">
                                                Lab {{ $facility['major_code'] }}
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-lg bg-navy/90 backdrop-blur-xs text-white text-xs font-mono font-bold uppercase tracking-wider border border-white/20">
                                                Fasilitas Kampus
                                            </span>
                                        @endif

                                        <span class="px-3 py-1 rounded-lg bg-white/90 backdrop-blur-xs text-navy text-xs font-mono font-bold uppercase tracking-wider border border-white/50">
                                            Kapasitas: {{ $facility['capacity'] }}
                                        </span>
                                    </div>

                                    <div class="absolute bottom-3 right-3 px-2.5 py-1 rounded-md bg-navy/80 backdrop-blur-xs text-white text-[11px] font-mono opacity-0 group-hover:opacity-100 transition-opacity">
                                        Perbesar Foto &rarr;
                                    </div>
                                </div>

                                {{-- Card Body --}}
                                <div class="p-6 sm:p-8">
                                    <h2 class="font-display font-extrabold text-2xl text-ink group-hover:text-navy transition-colors leading-snug">
                                        {{ $facility['name'] }}
                                    </h2>
                                    <p class="text-sm text-ink-muted mt-3 leading-relaxed">
                                        {{ $facility['summary'] }}
                                    </p>

                                    {{-- Equipment Tags --}}
                                    <div class="mt-6 pt-5 border-t border-line">
                                        <span class="block text-[11px] font-mono font-bold uppercase tracking-widest text-navy mb-3">
                                            Spesifikasi Peralatan Utama:
                                        </span>
                                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            @foreach($facility['equipment'] as $item)
                                                <li class="flex items-start gap-2 text-xs text-ink font-medium">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-navy mt-1.5 shrink-0"></span>
                                                    <span>{{ $item }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            {{-- Card Footer Highlight --}}
                            <div class="px-6 py-4 sm:px-8 sm:py-4 bg-paper border-t border-line flex items-center justify-between gap-4">
                                <div class="flex items-center gap-2 text-xs text-slate-600">
                                    <svg class="w-4 h-4 text-navy shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    <span class="font-semibold">{{ $facility['highlight'] }}</span>
                                </div>

                                @if($facility['major_code'])
                                    @php
                                        $targetCode = strtoupper(trim($facility['major_code']));
                                        if ($targetCode === 'TP') $targetCode = 'TPM';
                                        $majorSlug = strtolower($targetCode);
                                    @endphp
                                    <a
                                        href="{{ route('majors.show', $majorSlug) }}"
                                        class="text-xs font-mono font-bold uppercase text-navy hover:underline shrink-0"
                                    >
                                        Jurusan {{ $facility['major_code'] }} &rarr;
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

            {{-- Gateway Banner ke Galeri Dokumentasi --}}
            <div data-reveal class="mt-16 p-8 sm:p-10 rounded-3xl bg-navy text-white border-2 border-line flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="max-w-2xl">
                    <span class="px-2.5 py-1 rounded bg-white/10 text-cyan-300 text-xs font-mono font-bold uppercase tracking-widest">
                        Dokumentasi Visual Sekolah
                    </span>
                    <h3 class="font-display font-extrabold text-2xl sm:text-3xl text-white mt-2">
                        Ingin Melihat Dokumentasi Kegiatan &amp; Event SKENSA?
                    </h3>
                    <p class="text-slate-300 text-sm mt-2 leading-relaxed">
                        Kunjungi galeri foto resmi untuk melihat rekam jejak peringatan HUT SKENSA, pelantikan kepemimpinan, apel kesiswaan, kejuaraan LKS, dan aktivitas pembelajaran praktik.
                    </p>
                </div>
                <div class="shrink-0">
                    <a
                        href="{{ route('gallery.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white hover:bg-slate-100 text-[#071C3F] font-bold text-xs uppercase tracking-wider transition-colors shadow-sm"
                    >
                        <span>Buka Galeri Kegiatan</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- MODAL LIGHTBOX IMAGE VIEWER                                           --}}
    {{-- ===================================================================== --}}
    <div id="facility-lightbox-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-navy/90 backdrop-blur-sm" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="relative max-w-4xl w-full bg-paper rounded-2xl overflow-hidden shadow-2xl border border-line">
            <button type="button" id="facility-lightbox-close" class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-navy/80 text-white flex items-center justify-center hover:bg-navy transition-colors cursor-pointer" aria-label="Tutup foto">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <div class="aspect-video bg-navy overflow-hidden">
                <img id="facility-lightbox-img" src="" alt="" class="w-full h-full object-contain">
            </div>
            <div class="p-5 sm:p-6 bg-paper-2">
                <h3 id="facility-lightbox-title" class="font-display font-extrabold text-xl text-ink"></h3>
                <p id="facility-lightbox-desc" class="text-xs sm:text-sm text-ink-muted mt-1 leading-relaxed"></p>
            </div>
        </div>
    </div>

    {{-- Lightbox Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('facility-lightbox-modal');
            const closeBtn = document.getElementById('facility-lightbox-close');
            const modalImg = document.getElementById('facility-lightbox-img');
            const modalTitle = document.getElementById('facility-lightbox-title');
            const modalDesc = document.getElementById('facility-lightbox-desc');

            document.querySelectorAll('[data-facility-lightbox]').forEach(function (trigger) {
                trigger.addEventListener('click', function () {
                    const src = trigger.getAttribute('data-facility-lightbox');
                    const title = trigger.getAttribute('data-facility-title') || '';
                    const desc = trigger.getAttribute('data-facility-desc') || '';

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
