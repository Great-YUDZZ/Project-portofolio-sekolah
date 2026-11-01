@extends('layouts.public')

@section('title', 'Showcase Karya & Produk Inovasi Siswa - SMK Negeri 1 Denpasar')

@section('content')

    {{-- ============================================================= --}}
    {{-- HERO HEADER SECTION                                           --}}
    {{-- ============================================================= --}}
    <section class="bg-navy text-white border-b-2 border-line py-16 sm:py-20 relative overflow-hidden" data-reveal>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-white/[0.08] via-transparent to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-xs mb-4">
                <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                <span class="text-xs font-mono font-bold uppercase tracking-widest text-cyan-300">
                    Teaching Factory &amp; Project-Based Learning
                </span>
            </div>

            <h1 class="font-display font-extrabold text-3xl sm:text-5xl lg:text-6xl text-white tracking-tight leading-tight">
                Showcase Karya &amp; Produk Siswa
            </h1>

            <p class="text-slate-300 text-sm sm:text-base max-w-3xl mt-4 leading-relaxed font-sans">
                Etalase inovasi nyata karya siswa-siswi SMK Negeri 1 Denpasar hasil pembelajaran berbasis proyek dan unit produksi Teaching Factory (TeFa), mulai dari aplikasi perangkat lunak enterprise, solusi IoT cerdas, prototipe rekayasa mesin, hingga karya seni visual dan multimedia.
            </p>

            {{-- Stat Counters --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-10 pt-8 border-t border-white/15 max-w-2xl">
                <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10">
                    <span class="block text-2xl sm:text-3xl font-display font-extrabold text-cyan-300">
                        {{ $stats['total'] }}
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-300 mt-1 block">
                        Karya &amp; Produk Terdaftar
                    </span>
                </div>
                <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10">
                    <span class="block text-2xl sm:text-3xl font-display font-extrabold text-amber-400">
                        {{ $stats['majors'] }}
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-300 mt-1 block">
                        Jurusan Berkontribusi
                    </span>
                </div>
                <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10">
                    <span class="block text-2xl sm:text-3xl font-display font-extrabold text-white">
                        {{ $stats['years'] }}
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-300 mt-1 block">
                        Tahun Angkatan Proyek
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================= --}}
    {{-- FILTER & CATALOG SECTION                                      --}}
    {{-- ============================================================= --}}
    <section class="py-12 sm:py-16 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Filter Panel --}}
            <div data-reveal class="p-5 sm:p-6 rounded-3xl bg-paper-2 border border-line mb-10 space-y-4">
                {{-- Filter Jurusan --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-ink-muted shrink-0">
                        Konsentrasi Keahlian:
                    </span>
                    <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                        <a
                            href="{{ route('works.index', array_filter(['tahun' => $year])) }}"
                            class="px-3.5 py-2 rounded-xl text-xs font-mono font-bold uppercase transition-all duration-200 {{ !$majorCode ? 'bg-navy text-white shadow-xs' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                        >
                            Semua Jurusan
                        </a>
                        @foreach($majors as $m)
                            <a
                                href="{{ route('works.index', array_filter(['jurusan' => $m->code, 'tahun' => $year])) }}"
                                class="px-2.5 py-2 rounded-xl text-xs font-mono font-bold uppercase transition-all duration-200 {{ $majorCode === $m->code ? 'bg-navy text-white shadow-xs' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                            >
                                {{ $m->code }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Filter Tahun --}}
                @if($years->isNotEmpty())
                    <div class="pt-4 border-t border-line/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <span class="text-xs font-mono font-bold uppercase tracking-wider text-ink-muted shrink-0">
                            Tahun Rilis Proyek:
                        </span>
                        <div class="flex flex-wrap items-center gap-2">
                            <a
                                href="{{ route('works.index', array_filter(['jurusan' => $majorCode])) }}"
                                class="px-3 py-1.5 rounded-lg text-xs font-mono font-bold uppercase {{ !$year ? 'bg-navy text-white' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                            >
                                Semua Tahun
                            </a>
                            @foreach($years as $y)
                                <a
                                    href="{{ route('works.index', array_filter(['jurusan' => $majorCode, 'tahun' => $y])) }}"
                                    class="px-3 py-1.5 rounded-lg text-xs font-mono font-bold uppercase {{ (int) $year === (int) $y ? 'bg-navy text-white' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                                >
                                    {{ $y }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Empty State --}}
            @if($works->isEmpty())
                <div class="p-12 sm:p-16 rounded-3xl bg-paper-2 border border-line text-center max-w-lg mx-auto" data-reveal>
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-navy/10 text-navy flex items-center justify-center mb-4">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                    </div>
                    <h2 class="font-display font-extrabold text-xl text-ink">Karya Siswa Belum Ditemukan</h2>
                    <p class="text-xs sm:text-sm text-ink-muted mt-2 leading-relaxed">
                        Belum ada karya atau produk inovasi yang terdaftar untuk kombinasi jurusan dan tahun rilis yang Anda pilih.
                    </p>
                    <a
                        href="{{ route('works.index') }}"
                        class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl bg-navy text-white text-xs font-mono font-bold uppercase tracking-wider hover:bg-navy-light transition-colors"
                    >
                        <span>Tampilkan Semua Karya</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            @else
                {{-- Works Cards Grid --}}
                <div data-reveal-stagger class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($works as $work)
                        <article data-reveal-item class="rounded-3xl bg-paper-2/70 border border-line hover:border-navy hover:shadow-md transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                            <div>
                                {{-- Thumbnail & Badge --}}
                                <div class="aspect-video bg-navy relative overflow-hidden border-b border-line">
                                    <img
                                        src="{{ $work->thumbnail ?: '/images/hero_siswa.jpg' }}"
                                        alt="{{ $work->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-navy/60 via-transparent to-transparent pointer-events-none"></div>

                                    <div class="absolute top-3 left-3 flex items-center gap-1.5">
                                        <span class="px-2.5 py-1 rounded-lg bg-navy/90 text-white text-[11px] font-mono font-bold uppercase tracking-wider backdrop-blur-xs border border-white/20">
                                            {{ $work->major?->code ?? 'SKENSA' }}
                                        </span>
                                        <span class="px-2 py-1 rounded-lg bg-white/90 text-ink text-[11px] font-mono font-bold uppercase backdrop-blur-xs">
                                            {{ $work->year }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="p-6">
                                    <h2 class="font-display font-extrabold text-lg sm:text-xl text-ink group-hover:text-navy transition-colors leading-snug">
                                        {{ $work->title }}
                                    </h2>

                                    <div class="flex items-center gap-2 mt-2 text-xs font-mono text-ink-muted">
                                        <svg class="w-3.5 h-3.5 shrink-0 text-navy" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="truncate">{{ $work->student_name }}</span>
                                    </div>

                                    <p class="text-xs sm:text-sm text-ink-muted mt-3 leading-relaxed line-clamp-3">
                                        {{ $work->description }}
                                    </p>

                                    {{-- Tech Stack Tags --}}
                                    @if(!empty($work->tech_stack) && is_array($work->tech_stack))
                                        <div class="flex flex-wrap gap-1.5 mt-4 pt-4 border-t border-line/60">
                                            @foreach($work->tech_stack as $tech)
                                                <span class="px-2 py-0.5 rounded-md bg-paper border border-line text-[11px] font-mono text-ink-muted">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Card Footer Actions --}}
                            <div class="px-6 py-4 bg-paper border-t border-line flex items-center justify-between text-xs">
                                <button
                                    type="button"
                                    data-work-lightbox="{{ $work->thumbnail ?: '/images/hero_siswa.jpg' }}"
                                    data-work-title="{{ $work->title }}"
                                    data-work-maker="{{ $work->student_name }} ({{ $work->major?->code ?? 'SKENSA' }} {{ $work->year }})"
                                    data-work-desc="{{ $work->description }}"
                                    data-work-demo="{{ $work->demo_url }}"
                                    class="inline-flex items-center gap-1.5 font-mono font-bold uppercase tracking-wider text-navy hover:underline cursor-pointer"
                                >
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <span>Pratinjau</span>
                                </button>

                                @if($work->demo_url)
                                    <a
                                        href="{{ $work->demo_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-navy text-white text-[11px] font-mono font-bold uppercase tracking-wider hover:bg-navy-light transition-colors"
                                    >
                                        <span>Live Demo</span>
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="7" y1="17" x2="17" y2="7"></line>
                                            <polyline points="7 7 17 7 17 17"></polyline>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    {{-- ============================================================= --}}
    {{-- MODAL LIGHTBOX DETAIL PRATINJAU KARYA                         --}}
    {{-- ============================================================= --}}
    <div
        id="work-lightbox-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-xs p-4"
        aria-hidden="true"
        role="dialog"
    >
        <div class="relative w-full max-w-3xl rounded-3xl bg-paper border border-line shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
            <button
                type="button"
                id="work-lightbox-close"
                class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-navy text-white flex items-center justify-center hover:bg-navy-light cursor-pointer transition-colors shadow-sm"
                aria-label="Tutup Pratinjau"
            >
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <div class="aspect-video bg-navy overflow-hidden shrink-0">
                <img id="work-lightbox-img" src="" alt="" class="w-full h-full object-contain">
            </div>

            <div class="p-6 sm:p-7 bg-paper-2 overflow-y-auto space-y-3">
                <span id="work-lightbox-maker" class="text-xs font-mono font-bold uppercase tracking-widest text-navy block"></span>
                <h3 id="work-lightbox-title" class="font-display font-extrabold text-xl sm:text-2xl text-ink leading-snug"></h3>
                <p id="work-lightbox-desc" class="text-xs sm:text-sm text-ink-muted leading-relaxed"></p>

                <div id="work-lightbox-demo-wrapper" class="pt-3 hidden">
                    <a
                        id="work-lightbox-demo-link"
                        href="#"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-navy text-white font-mono font-bold text-xs uppercase tracking-wider hover:bg-navy-light transition-colors"
                    >
                        <span>Buka Tautan Demo / Hasil Proyek</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Lightbox Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('work-lightbox-modal');
            const closeBtn = document.getElementById('work-lightbox-close');
            const modalImg = document.getElementById('work-lightbox-img');
            const modalTitle = document.getElementById('work-lightbox-title');
            const modalMaker = document.getElementById('work-lightbox-maker');
            const modalDesc = document.getElementById('work-lightbox-desc');
            const demoWrapper = document.getElementById('work-lightbox-demo-wrapper');
            const demoLink = document.getElementById('work-lightbox-demo-link');

            document.querySelectorAll('[data-work-lightbox]').forEach(function (trigger) {
                trigger.addEventListener('click', function () {
                    const src = trigger.getAttribute('data-work-lightbox');
                    const title = trigger.getAttribute('data-work-title') || '';
                    const maker = trigger.getAttribute('data-work-maker') || '';
                    const desc = trigger.getAttribute('data-work-desc') || '';
                    const demo = trigger.getAttribute('data-work-demo') || '';

                    modalImg.src = src;
                    modalImg.alt = title;
                    modalTitle.textContent = title;
                    modalMaker.textContent = maker;
                    modalDesc.textContent = desc;

                    if (demo && demo.trim() !== '') {
                        demoLink.href = demo;
                        demoWrapper.classList.remove('hidden');
                    } else {
                        demoWrapper.classList.add('hidden');
                    }

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
