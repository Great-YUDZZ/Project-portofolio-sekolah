@extends('layouts.public')

@section('title', 'Visi, Misi & 4 Nilai Karakter - SMK Negeri 1 Denpasar')

@section('content')

    {{-- ===================================================================== --}}
    {{-- 1. HERO HEADER: MANIFESTO & IDENTITAS INSTITUSIONAL                   --}}
    {{-- ===================================================================== --}}
    <section class="relative bg-[#071C3F] text-paper border-b-2 border-ink py-16 sm:py-20 overflow-hidden">
        {{-- Subtle Grid & Ambient Glow (Anti-Slop: clean geometric mesh without heavy blurs) --}}
        <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image: radial-gradient(#FFFFFF 1px, transparent 1px); background-size: 28px 28px;"></div>
        <div class="absolute -top-36 -right-36 w-96 h-96 rounded-full bg-[#67E8F9]/10 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumb Navigasi --}}
            <nav aria-label="Breadcrumb" class="mb-6">
                <ol class="flex flex-wrap items-center gap-2 text-xs font-mono uppercase tracking-wider text-slate-300">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-[#67E8F9] transition-colors">Beranda</a>
                    </li>
                    <li class="text-slate-500">/</li>
                    <li>
                        <a href="{{ route('profile.index') }}" class="hover:text-[#67E8F9] transition-colors">Profil</a>
                    </li>
                    <li class="text-slate-500">/</li>
                    <li class="text-[#67E8F9] font-bold" aria-current="page">Visi &amp; Misi</li>
                </ol>
            </nav>

            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-white/10 border border-white/15 text-[#67E8F9] text-xs font-mono font-bold uppercase tracking-widest">
                    SMK Pusat Keunggulan • Rujukan Nasional
                </span>
                <span class="inline-block px-3 py-1 rounded-md bg-white/5 border border-white/10 text-slate-300 text-xs font-mono uppercase tracking-wider">
                    {{ $vision['decree_reference'] }}
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end">
                <div class="lg:col-span-8">
                    <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-white tracking-tight leading-tight">
                        Kompas Nilai, Cita-Cita Luhur, &amp; Sinergi Vokasi Berkelanjutan
                    </h1>
                    <p class="text-slate-300 text-base sm:text-lg mt-4 max-w-2xl leading-relaxed">
                        Menyelaraskan tradisi keilmuan <em>"Abhyāsad Dhäryate Vidyä"</em> dengan keunggulan teknologi rekayasa, menuntun 12 konsentrasi keahlian dan 9 unit produksi komersial menuju standar industri global.
                    </p>
                </div>

                {{-- Quick Metric Pills --}}
                <div class="lg:col-span-4 grid grid-cols-2 gap-3 shrink-0">
                    @foreach($qualityMetrics as $metric)
                        <div class="p-3.5 rounded-xl bg-white/[0.06] border border-white/10 backdrop-blur-xs">
                            <div class="font-display font-extrabold text-2xl text-[#67E8F9] leading-none">
                                {{ $metric['value'] }}
                            </div>
                            <div class="text-xs font-bold text-white mt-1.5 leading-snug">
                                {{ $metric['label'] }}
                            </div>
                            <div class="text-[11px] text-slate-400 mt-0.5 font-mono">
                                {{ $metric['sub'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- 2. SECTION: VISI UTAMA & 3 PILAR MANIFESTASI                          --}}
    {{-- ===================================================================== --}}
    <section class="py-16 sm:py-20 bg-paper border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mb-10">
                <span class="font-mono text-xs font-bold uppercase tracking-widest text-[#D97706]">
                    Landasan Visi Institusional
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-2 tracking-tight">
                    Pernyataan Visi SMK Negeri 1 Denpasar
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-2.5 leading-relaxed">
                    Arah masa depan yang memandu seluruh pendidik, tenaga kependidikan, peserta didik, dan jejaring industri dalam membangun peradaban vokasi unggul.
                </p>
            </div>

            {{-- Editorial Quotation Box --}}
            <div class="relative p-8 sm:p-12 rounded-3xl bg-[#071C3F] text-white border-2 border-ink shadow-lg overflow-hidden mb-12">
                <div class="absolute -right-12 -bottom-12 text-white/[0.04] font-display font-extrabold text-[180px] select-none pointer-events-none leading-none">
                    VISI
                </div>

                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-10 h-1 bg-[#67E8F9] rounded-full"></span>
                        <span class="text-xs font-mono font-bold tracking-widest uppercase text-[#67E8F9]">
                            Pernyataan Resmi Masa Depan
                        </span>
                    </div>

                    <blockquote class="font-display font-bold text-2xl sm:text-3xl lg:text-4xl text-white leading-snug max-w-5xl tracking-tight">
                        &ldquo;{{ $vision['statement'] }}&rdquo;
                    </blockquote>

                    <div class="mt-8 pt-8 border-t border-white/15 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <span class="text-xs font-mono uppercase tracking-wider text-slate-400">Semboyan Sanskrit Tradisi Keilmuan:</span>
                            <div class="font-display font-bold text-lg text-[#67E8F9] mt-0.5">
                                {{ $vision['slogan'] }}
                            </div>
                            <div class="text-xs text-slate-300 italic mt-0.5">
                                {{ $vision['slogan_meaning'] }}
                            </div>
                        </div>

                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/10 border border-white/15 text-xs text-slate-200 font-mono">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Pedoman Rencana Induk Pengembangan (RIP)</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3 Pilar Nilai Visi --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($vision['pillars'] as $pillar)
                    <div class="p-6 sm:p-8 rounded-2xl bg-white border border-line shadow-xs hover:border-navy hover:shadow-md transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span class="font-mono text-2xl font-black text-navy/30">
                                    {{ $pillar['number'] }}
                                </span>
                                <span class="px-2.5 py-1 rounded bg-navy-50 text-navy text-[11px] font-mono font-bold uppercase tracking-wider">
                                    Pilar Visi
                                </span>
                            </div>
                            <h3 class="font-display font-extrabold text-xl text-ink">
                                {{ $pillar['title'] }}
                            </h3>
                            <p class="text-xs font-semibold text-navy mt-1">
                                {{ $pillar['tagline'] }}
                            </p>
                            <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                                {{ $pillar['desc'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- 3. SECTION: 6 MISI STRATEGIS INSTITUSI                                --}}
    {{-- ===================================================================== --}}
    <section class="py-16 sm:py-20 bg-white border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12">
                <div class="max-w-3xl">
                    <span class="font-mono text-xs font-bold uppercase tracking-widest text-[#D97706]">
                        Rencana Aksi Strategis
                    </span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-2 tracking-tight">
                        Enam Misi Strategis Pelaksanaan Pendidikan Vokasi
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base mt-2.5 leading-relaxed">
                        Langkah konkret yang diterjemahkan ke dalam kurikulum pembelajaran, fasilitas bengkel kerja industri, dan tata kelola institusi terstandar.
                    </p>
                </div>

                <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-paper border border-line text-xs font-mono text-ink-muted shrink-0">
                    <span>Terverifikasi RKT &amp; RKAS Skensa</span>
                </div>
            </div>

            {{-- Grid 6 Misi Strategis --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($missions as $mission)
                    <div class="p-6 sm:p-7 rounded-2xl bg-paper border border-line hover:border-navy hover:shadow-md transition-all flex flex-col justify-between group">
                        <div>
                            {{-- Header Kartu Misi --}}
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <span class="w-9 h-9 rounded-xl bg-navy text-white font-mono font-bold text-sm flex items-center justify-center shrink-0">
                                    {{ $mission['number'] }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded-full bg-white border border-line text-[11px] font-mono font-semibold text-slate-600 truncate">
                                    {{ $mission['category'] }}
                                </span>
                            </div>

                            <h3 class="font-display font-bold text-lg text-ink group-hover:text-navy transition-colors">
                                {{ $mission['title'] }}
                            </h3>

                            {{-- Pernyataan Resmi Misi --}}
                            <p class="text-sm font-semibold text-slate-800 mt-2.5 leading-relaxed">
                                &ldquo;{{ $mission['statement'] }}&rdquo;
                            </p>

                            {{-- Detail Operasional --}}
                            <p class="text-xs text-slate-600 mt-3 leading-relaxed">
                                {{ $mission['detail'] }}
                            </p>
                        </div>

                        {{-- Footer Kartu Misi: Program Badge & Target --}}
                        <div class="mt-6 pt-4 border-t border-line/75">
                            <span class="inline-block px-2.5 py-1 rounded bg-white text-navy font-mono text-[11px] font-bold border border-line mb-2">
                                {{ $mission['action_badge'] }}
                            </span>
                            <div class="text-[11px] text-slate-500 font-mono flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>{{ $mission['metric'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- 4. SECTION: SHOWCASE 4 NILAI KARAKTER KERJA (INTERACTIVE TABS)        --}}
    {{-- ===================================================================== --}}
    <section id="nilai-karakter" class="py-16 sm:py-20 bg-paper border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mb-12">
                <span class="font-mono text-xs font-bold uppercase tracking-widest text-[#D97706]">
                    Karakter Kerja Vokasi Skensa
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-2 tracking-tight">
                    Empat Pilar Nilai Karakter: Siap, Kompeten, Disiplin, &amp; Beretika
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-2.5 leading-relaxed">
                    Prinsip kerja yang tertanam kuat pada setiap peserta didik, menjadi pembeda utama lulusan SMK Negeri 1 Denpasar saat bersaing di lingkungan industri modern.
                </p>
            </div>

            {{-- Interactive Character Value Component --}}
            <div class="rounded-3xl bg-white border-2 border-ink shadow-md overflow-hidden" data-char-component>
                {{-- Tab Buttons Navigation --}}
                <div class="p-2 sm:p-3 bg-paper border-b border-line grid grid-cols-2 lg:grid-cols-4 gap-2" role="tablist" aria-label="Navigasi 4 Nilai Karakter">
                    @foreach($characterValues as $index => $char)
                        <button
                            type="button"
                            role="tab"
                            id="char-tab-{{ $char['code'] }}"
                            aria-controls="char-panel-{{ $char['code'] }}"
                            aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                            data-char-tab="{{ $char['code'] }}"
                            class="px-4 py-3 rounded-2xl text-left transition-all cursor-pointer flex items-center gap-3 border {{ $index === 0 ? 'bg-[#071C3F] text-white border-[#071C3F] shadow-sm font-bold' : 'bg-white text-ink border-transparent hover:border-line font-medium text-slate-700' }}"
                        >
                            <span class="w-8 h-8 rounded-xl font-mono text-xs font-extrabold flex items-center justify-center shrink-0 {{ $index === 0 ? 'bg-cyan-400 text-ink' : 'bg-paper-2 text-slate-600' }}">
                                {{ $char['code'] }}
                            </span>
                            <div class="truncate">
                                <div class="text-xs font-mono uppercase tracking-wider {{ $index === 0 ? 'text-cyan-300' : 'text-slate-500' }}">
                                    Karakter {{ $char['code'] }}
                                </div>
                                <div class="text-sm font-display font-bold truncate">
                                    {{ $char['title'] }}
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>

                {{-- Tab Panels Content --}}
                <div class="p-6 sm:p-10 lg:p-12">
                    @foreach($characterValues as $index => $char)
                        <div
                            role="tabpanel"
                            id="char-panel-{{ $char['code'] }}"
                            aria-labelledby="char-tab-{{ $char['code'] }}"
                            data-char-panel="{{ $char['code'] }}"
                            class="{{ $index === 0 ? 'block' : 'hidden' }} transition-opacity duration-200"
                        >
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                                {{-- Kolom Kiri: Deskripsi & Filosofi Kerja --}}
                                <div class="lg:col-span-7">
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="px-2.5 py-0.5 rounded-full {{ $char['badge_color'] }} text-white text-[11px] font-mono font-bold uppercase tracking-wider">
                                            Nilai Inti {{ $char['code'] }}
                                        </span>
                                        <span class="text-xs font-mono text-slate-500">
                                            Standar Budaya Industri Skensa
                                        </span>
                                    </div>

                                    <h3 class="font-display font-extrabold text-2xl sm:text-3xl text-ink">
                                        {{ $char['title'] }}: {{ $char['tagline'] }}
                                    </h3>

                                    <p class="text-slate-700 text-sm sm:text-base mt-4 leading-relaxed">
                                        {{ $char['description'] }}
                                    </p>

                                    {{-- Konteks Industri Nyata --}}
                                    <div class="mt-6 p-4 rounded-xl bg-amber-50/70 border border-amber-200 text-xs text-slate-800 leading-relaxed">
                                        <strong class="font-mono uppercase tracking-wide block mb-1 text-[#D97706]">
                                            Penerapan di Dunia Industri &amp; Bengkel:
                                        </strong>
                                        {{ $char['workplace_context'] }}
                                    </div>
                                </div>

                                {{-- Kolom Kanan: 4 Indikator Perilaku Nyata --}}
                                <div class="lg:col-span-5 bg-paper p-6 sm:p-7 rounded-2xl border border-line">
                                    <h4 class="font-display font-bold text-sm uppercase tracking-wider text-ink mb-4 flex items-center justify-between">
                                        <span>Indikator Pembiasaan Siswa</span>
                                        <span class="text-xs font-mono text-slate-500">4 Poin Kunci</span>
                                    </h4>

                                    <ul class="space-y-3">
                                        @foreach($char['behaviors'] as $bIdx => $behavior)
                                            <li class="flex items-start gap-3 p-3 rounded-xl bg-white border border-line text-xs sm:text-sm text-slate-800 leading-normal">
                                                <span class="w-5 h-5 rounded-full bg-navy text-white text-[10px] font-mono font-bold flex items-center justify-center shrink-0 mt-0.5">
                                                    {{ $bIdx + 1 }}
                                                </span>
                                                <span>{{ $behavior }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- 5. SECTION: TARGET CAPAIAN LULUSAN (SKEMA BMW)                        --}}
    {{-- ===================================================================== --}}
    <section class="py-16 sm:py-20 bg-white border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mb-12">
                <span class="font-mono text-xs font-bold uppercase tracking-widest text-[#D97706]">
                    Output &amp; Dampak Pembelajaran
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-ink mt-2 tracking-tight">
                    Trisula Capaian Lulusan: Skema BMW Vokasi
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-2.5 leading-relaxed">
                    Setiap lulusan SMK Negeri 1 Denpasar disiapkan untuk memiliki tiga jalur masa depan yang setara, bermartabat, dan terfasilitasi secara optimal.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($bmwOutcomes as $outcome)
                    <div class="p-8 rounded-3xl bg-paper border-2 border-line hover:border-navy hover:shadow-lg transition-all flex flex-col justify-between">
                        <div>
                            {{-- Letter Icon Badge --}}
                            <div class="w-16 h-16 rounded-2xl border-2 {{ $outcome['icon_accent'] }} font-display font-extrabold text-3xl flex items-center justify-center mb-6 shadow-xs">
                                {{ $outcome['letter'] }}
                            </div>

                            <h3 class="font-display font-extrabold text-2xl text-ink">
                                {{ $outcome['label'] }}
                            </h3>
                            <p class="text-xs font-bold text-navy mt-1">
                                {{ $outcome['sub'] }}
                            </p>
                            <p class="text-sm text-slate-600 mt-4 leading-relaxed">
                                {{ $outcome['desc'] }}
                            </p>
                        </div>

                        <div class="mt-8 pt-4 border-t border-line">
                            <span class="text-xs font-mono text-slate-700 font-semibold block">
                                Fasilitas Pendukung:
                            </span>
                            <span class="text-xs font-mono text-navy block mt-0.5">
                                {{ $outcome['metrics'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================================================================== --}}
    {{-- 6. DUAL GATEWAY: EKSPLORASI SEJARAH & PROFIL LENGKAP                   --}}
    {{-- ===================================================================== --}}
    <section class="py-16 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Gateway Sejarah --}}
                <div class="p-8 rounded-3xl bg-[#071C3F] text-white border-2 border-ink flex flex-col justify-between">
                    <div>
                        <span class="px-2.5 py-1 rounded bg-[#67E8F9]/15 border border-[#67E8F9]/30 text-[#67E8F9] text-[11px] font-mono font-bold uppercase tracking-widest">
                            Arsip Sejarah 1962 - Sekarang
                        </span>
                        <h3 class="font-display font-extrabold text-2xl text-white mt-4">
                            Kronik Sejarah &amp; Enam Lompatan Besar SKENSA
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-300 mt-2.5 leading-relaxed">
                            Telusuri silsilah kejuruan dari STM Negeri Denpasar 1962, era Proyek PELITA 1977 di Ubung, hingga suksesi 5 kepala sekolah.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-white/10">
                        <a
                            href="{{ route('history.index') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#67E8F9] hover:bg-cyan-300 text-[#071C3F] font-bold text-xs uppercase tracking-wider transition-colors"
                        >
                            <span>Buka Kronik Sejarah</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

                {{-- Gateway Profil & Struktur Organisasi --}}
                <div class="p-8 rounded-3xl bg-white border-2 border-line hover:border-navy flex flex-col justify-between transition-colors">
                    <div>
                        <span class="px-2.5 py-1 rounded bg-navy-50 text-navy text-[11px] font-mono font-bold uppercase tracking-widest">
                            Tata Kelola Organisasi
                        </span>
                        <h3 class="font-display font-extrabold text-2xl text-ink mt-4">
                            Profil Pimpinan, Fasilitas &amp; Direktori SDM
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed">
                            Kenali jajaran manajemen sekolah, 4 Wakil Kepala Sekolah, fasilitas laboratorium bengkel kerja, serta data kelembagaan resmi.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-line">
                        <a
                            href="{{ route('profile.index') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-navy hover:bg-ink text-paper font-bold text-xs uppercase tracking-wider transition-colors"
                        >
                            <span>Kembali ke Halaman Profil</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
