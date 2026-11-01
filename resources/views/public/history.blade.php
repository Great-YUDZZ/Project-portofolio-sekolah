@extends('layouts.public')

@section('title', 'Kronik Sejarah Institusional & Transformasi Vokasi (1962 - 2026) - SMK Negeri 1 Denpasar')
@section('meta_description', 'Telusuri 64 tahun sejarah SMK Negeri 1 Denpasar (Skensa) sejak berdiri sebagai STM Negeri Denpasar pada 24 September 1962 di kelas sore Tulangampiang hingga menjadi SMK Pusat Keunggulan di Ubung.')

@section('content')
<div id="skensa-history-scrollcraft" class="bg-[#F8F9FA] text-[#0E1133] pb-24 selection:bg-[#2563EB] selection:text-white">

    {{-- =====================================================================
    {{-- =====================================================================
         ACT 1: EDITORIAL HERO (Clean, White, Focused)
         ===================================================================== --}}
    <section id="act-recognition" data-sc-act="flow" class="bg-white border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-14 sm:pt-28 sm:pb-18 lg:pt-32 lg:pb-20">
            <p class="text-xs sm:text-sm font-semibold tracking-wider uppercase text-[#2563EB]">
                Sejarah SMK Negeri 1 Denpasar
            </p>

            <h1 class="font-display font-extrabold text-5xl sm:text-7xl lg:text-8xl text-[#0E1133] tracking-tight mt-3 sm:mt-4 leading-none">
                Sejak 1962.
            </h1>

            <p class="mt-5 sm:mt-6 max-w-2xl text-base sm:text-lg text-slate-600 leading-relaxed">
                Dari kelas sore yang menumpang di Tulangampiang, STM Negeri Denpasar tumbuh menjadi SMK Pusat Keunggulan di Ubung. Ini perjalanannya, ditulis dari arsip resmi.
            </p>

            <div class="mt-8">
                <a
                    href="#act-origin"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-[#0E1133] border-b-2 border-[#0E1133] pb-1 hover:text-[#2563EB] hover:border-[#2563EB] transition-colors"
                >
                    <span>Mulai membaca kronik</span>
                    <span aria-hidden="true">&darr;</span>
                </a>
            </div>

            {{-- 3 Real Historical Metric Stats (Clean divider lines, no slop boxes) --}}
            <dl class="mt-16 sm:mt-20 grid grid-cols-1 sm:grid-cols-3 border-t border-slate-200" data-sc-in>
                @foreach($heroStats as $stat)
                    <div class="py-6 sm:pr-8 sm:border-r last:border-r-0 border-slate-200 sm:pl-8 first:sm:pl-0">
                        <dt class="text-xs font-mono uppercase tracking-wider text-slate-500">{{ $stat['label'] }}</dt>
                        <dd class="font-display font-extrabold text-3xl sm:text-4xl text-[#0E1133] tabular-nums mt-1.5">
                            <span data-sc-count="0 {{ $stat['target'] }}">{{ $stat['target'] }}</span>{{ $stat['suffix'] }}
                        </dd>
                        <dd class="text-xs text-slate-500 mt-1">{{ $stat['sub'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    {{-- =====================================================================
         ACT 2: ERA PERINTISAN 1962 (Sticky-Aside Scrollytelling)
         Teks mengalir santai di kanan, kolom kiri sticky mengikuti posisi baca
         ===================================================================== --}}
    <section id="act-origin" data-sc-act="flow" class="py-16 sm:py-24 lg:py-28 bg-[#F8F9FA] border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16">

                {{-- Left Sticky Aside Column (lg:col-span-4) --}}
                <div class="lg:col-span-4">
                    <div class="lg:sticky lg:top-28 space-y-4">
                        <span class="inline-block text-xs font-mono font-bold uppercase tracking-widest text-[#2563EB]">
                            Babak I • Era Perintisan (1962 - 1976)
                        </span>

                        <div id="origin-sticky-year" class="font-display font-extrabold text-6xl sm:text-7xl lg:text-8xl text-[#0E1133] tracking-tighter leading-none select-none">
                            1962
                        </div>

                        <div id="origin-sticky-step" class="text-xs sm:text-sm font-semibold text-slate-600">
                            01 / 03 • Menumpang Kelas Sore
                        </div>

                        {{-- Progress indicators --}}
                        <div class="flex items-center gap-2 pt-2" aria-hidden="true">
                            <div data-origin-progress-dot="0" class="h-1 rounded-full bg-[#2563EB] w-8 transition-all duration-300"></div>
                            <div data-origin-progress-dot="1" class="h-1 rounded-full bg-slate-300 w-3 transition-all duration-300"></div>
                            <div data-origin-progress-dot="2" class="h-1 rounded-full bg-slate-300 w-3 transition-all duration-300"></div>
                        </div>

                        <p class="hidden lg:block text-xs text-slate-500 leading-relaxed pt-4 border-t border-slate-200">
                            Gulir untuk membaca sejarah pendirian, dua jurusan perintis, dan bengkel praktik lapangan pertama.
                        </p>
                    </div>
                </div>

                {{-- Right Flowing Editorial Column (lg:col-span-8) --}}
                <div class="lg:col-span-8 space-y-20 sm:space-y-28 max-w-[68ch]">

                    {{-- Step 1 --}}
                    <article data-origin-step="0" class="scroll-mt-28 space-y-4" data-sc-in>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-mono font-bold text-[#2563EB]">Tahap 01</span>
                            <span class="text-slate-300">•</span>
                            <span class="text-xs font-mono text-slate-500">24 September 1962</span>
                        </div>

                        <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-[#0E1133] leading-tight">
                            Menumpang di SD Percobaan Tulangampiang pada Sore Hari.
                        </h2>

                        <div class="text-base text-slate-600 leading-relaxed space-y-4">
                            <p>
                                Pada awal dekade 1960-an, Pemerintah Daerah Tingkat I Bali menghadapi defisit akut tenaga kerja teknik tingkat menengah untuk menopang pembangunan fisik daerah. Permohonan resmi pemerintah daerah disahkan pemerintah pusat melalui <strong>SK Nomor 17/Djapt/B1/62 (17/DJAPT/131/62)</strong> tertanggal 24 September 1962, yang penyelenggaraan awalnya dijalankan oleh Pemda Tk. II Badung bekerja sama dengan Departemen Pekerjaan Umum (PU).
                            </p>
                            <p>
                                Karena keterbatasan anggaran negara saat itu, sekolah belum memiliki tanah dan bangunan sendiri. Kegiatan belajar mengajar menumpang di <strong>SD Percobaan Tulangampiang (kompleks Gedung ST Negeri Tulangampiang)</strong> di Jalan Gunung Agung, Denpasar. Pembelajaran dilaksanakan pada <strong>sore hari</strong>, menyesuaikan waktu luang para insinyur proyek dan pegawai instansi teknis setelah dinas pagi mereka selesai.
                            </p>
                            <p>
                                Kepemimpinan pertama dipegang oleh <strong>Ida Bagus Suparsa</strong>, yang kala itu merangkap sebagai Pimpinan ST Negeri Denpasar di Tulangampiang, sehingga integrasi penggunaan ruang kelas dan meja belajar dapat berjalan tanpa gesekan birokrasi.
                            </p>
                        </div>
                    </article>

                    {{-- Step 2 --}}
                    <article data-origin-step="1" class="scroll-mt-28 space-y-4" data-sc-in>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-mono font-bold text-[#2563EB]">Tahap 02</span>
                            <span class="text-slate-300">•</span>
                            <span class="text-xs font-mono text-slate-500">1965 • Dua Jurusan Pertama</span>
                        </div>

                        <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-[#0E1133] leading-tight">
                            Jurusan Bangunan Gedung dan Jurusan Mesin di Bawah Asuhan Ir. Cokorda Raka Sukawati.
                        </h2>

                        <div class="text-base text-slate-600 leading-relaxed space-y-4">
                            <p>
                                Saat membuka pendaftaran angkatan pertama dengan 45 siswa, STM Negeri Denpasar memprioritaskan dua bidang kejuruan yang paling mendesak bagi Bali: <strong>Jurusan Bangunan Gedung</strong> dan <strong>Jurusan Mesin</strong>.
                            </p>
                            <p>
                                Koordinasi akademik Jurusan Mesin dipimpin langsung oleh <strong>Ir. Cokorda Raka Sukawati</strong>, insinyur muda asal Bali yang kelak dikenal luas di dunia konstruksi internasional sebagai penemu teknik landasan putar bebas hambatan <strong>Sosrobahu</strong>.
                            </p>
                            <p>
                                Pengajaran kejuruan teknik diampu oleh tenaga ahli Departemen PU seperti <strong>Rohim, BE.</strong>, <strong>Ir. Zainudin</strong>, <strong>I Ketut Arka</strong>, dan <strong>Ir. Adenan</strong>. Sementara itu, mata pelajaran dasar umum dibimbing oleh pendidik perbantuan dari SMA dan SGA, antara lain <strong>I Ketut Sujana, BA.</strong>, <strong>Drs. I Putu Sudana</strong>, dan <strong>I Ketut Karang, BA.</strong>
                            </p>
                        </div>
                    </article>

                    {{-- Step 3 --}}
                    <article data-origin-step="2" class="scroll-mt-28 space-y-4" data-sc-in>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-mono font-bold text-[#2563EB]">Tahap 03</span>
                            <span class="text-slate-300">•</span>
                            <span class="text-xs font-mono text-slate-500">1962 - 1976</span>
                        </div>

                        <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-[#0E1133] leading-tight">
                            Proyek Pembangunan Mercusuar Bali sebagai Bengkel Kerja Lapangan.
                        </h2>

                        <div class="text-base text-slate-600 leading-relaxed space-y-4">
                            <p>
                                Ketiadaan bengkel sekolah permanen di Tulangampiang diubah menjadi keunggulan strategis. Sekolah menerapkan model belajar berbasis kerja nyata jauh sebelum istilah <em>link and match</em> diperkenalkan. Para siswa diterjunkan langsung ke proyek konstruksi dan bengkel instalasi di lapangan:
                            </p>

                            <ol class="space-y-3 pl-1">
                                <li class="flex items-start gap-3 p-3.5 rounded-xl bg-white border border-slate-200">
                                    <span class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-slate-100 text-[#0E1133] shrink-0">01</span>
                                    <div>
                                        <strong class="text-[#0E1133]">Proyek Bandara Internasional Ngurah Rai di Tuban</strong>
                                        <p class="text-sm text-slate-500 mt-0.5">Praktik pengukuran, konstruksi landasan pacu, dan instalasi mekanikal.</p>
                                    </div>
                                </li>
                                <li class="flex items-start gap-3 p-3.5 rounded-xl bg-white border border-slate-200">
                                    <span class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-slate-100 text-[#0E1133] shrink-0">02</span>
                                    <div>
                                        <strong class="text-[#0E1133]">Proyek Hotel Grand Bali Beach di Sanur</strong>
                                        <p class="text-sm text-slate-500 mt-0.5">Pembangunan gedung bertingkat mercusuar pertama di Bali dengan standar teknik modern.</p>
                                    </div>
                                </li>
                                <li class="flex items-start gap-3 p-3.5 rounded-xl bg-white border border-slate-200">
                                    <span class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-slate-100 text-[#0E1133] shrink-0">03</span>
                                    <div>
                                        <strong class="text-[#0E1133]">Pabrik Pemintalan (Patal) Tohpati</strong>
                                        <p class="text-sm text-slate-500 mt-0.5">Pengalaman operasional mesin pemintalan dan perawatan sistem mekanik industri.</p>
                                    </div>
                                </li>
                                <li class="flex items-start gap-3 p-3.5 rounded-xl bg-white border border-slate-200">
                                    <span class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-slate-100 text-[#0E1133] shrink-0">04</span>
                                    <div>
                                        <strong class="text-[#0E1133]">Instalasi Peralatan Daerah Militer (PALDAM)</strong>
                                        <p class="text-sm text-slate-500 mt-0.5">Praktik perawatan kendaraan berat, persenjataan teknik, dan permesinan presisi.</p>
                                    </div>
                                </li>
                                <li class="flex items-start gap-3 p-3.5 rounded-xl bg-white border border-slate-200">
                                    <span class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-slate-100 text-[#0E1133] shrink-0">05</span>
                                    <div>
                                        <strong class="text-[#0E1133]">Bengkel Departemen Pekerjaan Umum (PU)</strong>
                                        <p class="text-sm text-slate-500 mt-0.5">Pengelasan, perkakas bubut, dan fabrikasi logam bersama mekanik senior.</p>
                                    </div>
                                </li>
                            </ol>

                            <p>
                                Hubungan timbal balik ini memungkinkan sekolah mendidik teknisi tangguh tanpa beban pembelian mesin mahal di awal, sementara berbagai proyek strategis di Bali memperoleh dukungan tenaga terampil yang siap kerja di lapangan.
                            </p>
                        </div>
                    </article>

                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         ACT 3: THE TURN & PEAK - 6 TONGGAK SEJARAH (Linimasa Vertikal Editorial)
         ===================================================================== --}}
    <section id="act-milestones" data-sc-act="flow" class="py-20 lg:py-28 bg-white text-[#0E1133] border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center mb-16 lg:mb-24" data-sc-in>
                <span class="font-mono text-xs font-bold uppercase tracking-widest text-[#2563EB]">
                    Babak II • Lintasan Tonggak Sejarah (1962 - 2026)
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-[#0E1133] mt-2 tracking-tight">
                    Enam Lompatan Besar Menuju SMK Pusat Keunggulan
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-3 leading-relaxed">
                    Perjalanan institusional 64 tahun ditata dalam enam fase transformasi bersejarah, dari kelas sore perintisan hingga kepemimpinan vokasi modern.
                </p>
            </div>

            {{-- Alternating Vertical Timeline Container --}}
            <div class="relative max-w-5xl mx-auto">
                {{-- Continuous Vertical Spine --}}
                <div class="absolute left-6 lg:left-1/2 top-4 bottom-4 w-0.5 -translate-x-1/2 bg-gradient-to-b from-[#2563EB] via-blue-300 to-slate-200" aria-hidden="true"></div>

                <div class="space-y-12 sm:space-y-16 lg:space-y-20">
                    @foreach($milestones as $idx => $ms)
                        @php
                            $isEven = ($idx % 2 === 0);
                        @endphp
                        <div
                            id="milestone-{{ $idx }}"
                            data-pan-card-index="{{ $idx }}"
                            data-sc-in
                            class="relative flex flex-col lg:flex-row items-start lg:items-center {{ $isEven ? 'lg:flex-row' : 'lg:flex-row-reverse' }} justify-between group"
                        >
                            {{-- Card Column (takes ~45% width on desktop) --}}
                            <div class="w-full pl-14 lg:pl-0 lg:w-[calc(50%-2.5rem)] {{ $isEven ? 'lg:pr-4' : 'lg:pl-4' }}">
                                <article class="p-6 sm:p-7 rounded-2xl bg-[#F8F9FA] border border-slate-200 shadow-2xs hover:border-blue-400 hover:shadow-md transition-all">
                                    {{-- Card Top Meta --}}
                                    <div class="flex flex-wrap items-center justify-between gap-2 pb-3 border-b border-slate-200">
                                        <div class="flex items-center gap-2">
                                            <span class="w-7 h-7 rounded-lg bg-[#0E1133] text-white font-mono text-xs font-extrabold flex items-center justify-center">
                                                {{ $ms['number'] }}
                                            </span>
                                            <span class="px-2.5 py-0.5 rounded-md bg-blue-50 border border-blue-200 text-[#2563EB] font-mono text-xs font-bold">
                                                {{ $ms['date_badge'] }}
                                            </span>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-500">
                                            {{ $ms['phase'] }}
                                        </span>
                                    </div>

                                    {{-- Decree Badge --}}
                                    <div class="mt-3 inline-block px-2.5 py-1 rounded bg-white border border-slate-200 font-mono text-[11px] text-[#0E1133] font-semibold">
                                        {{ $ms['decree'] }}
                                    </div>

                                    <h3 class="font-display font-extrabold text-xl sm:text-2xl text-[#0E1133] mt-2.5 leading-snug">
                                        {{ $ms['title'] }}
                                    </h3>

                                    <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                                        {{ $ms['summary'] }}
                                    </p>

                                    {{-- Optional Photo --}}
                                    @if(!empty($ms['photo']))
                                        <div class="mt-4 relative h-36 rounded-xl overflow-hidden border border-slate-200">
                                            <img src="{{ $ms['photo'] }}" alt="{{ $ms['title'] }}" class="w-full h-full object-cover">
                                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-[#0E1133]/90 via-[#0E1133]/50 to-transparent px-3 py-1.5">
                                                <span class="text-[11px] font-medium text-white">{{ $ms['photo_caption'] ?? '' }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Highlights --}}
                                    <div class="mt-4 pt-3 border-t border-slate-200 space-y-2">
                                        @foreach($ms['highlights'] as $hl)
                                            <div class="p-2.5 rounded-xl bg-white border border-slate-200/80 text-xs">
                                                <span class="font-bold text-[#0E1133]">{{ $hl['label'] }}:</span>
                                                <span class="text-slate-600 ml-1 leading-relaxed">{{ $hl['value'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </article>
                            </div>

                            {{-- Center Timeline Node --}}
                            <div class="absolute left-6 lg:left-1/2 top-7 lg:top-1/2 -translate-x-1/2 lg:-translate-y-1/2 z-10 flex items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-white border-4 border-[#2563EB] shadow-md flex items-center justify-center font-mono font-extrabold text-[11px] text-[#0E1133] group-hover:scale-110 transition-transform">
                                    {{ $ms['year'] }}
                                </div>
                            </div>

                            {{-- Spacer Column for Desktop alternating balance --}}
                            <div class="hidden lg:block lg:w-[calc(50%-2.5rem)]"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         ACT 3B: TABEL KOMPARASI 3 ERA INSTITUSIONAL (Interactive Matrix)
         ===================================================================== --}}
    <section class="py-16 lg:py-20 bg-[#0E1133] text-white border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-sc-in>
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-8">
                <div>
                    <span class="font-mono text-xs font-bold uppercase tracking-widest text-cyan-300">
                        Matriks Perbandingan Institusional • 1962 - 2026
                    </span>
                    <h2 class="font-display font-extrabold text-3xl text-white mt-1">
                        Evolusi Parameter Kelembagaan dalam Tiga Era Utama
                    </h2>
                </div>

                {{-- Interactive Era Column Highlighter --}}
                <div class="flex flex-wrap items-center gap-2" role="group" aria-label="Sorot Era Institusional">
                    <button type="button" data-era-highlight="all" class="px-3.5 py-2 rounded-lg border text-xs font-mono font-bold bg-[#2563EB] text-white border-[#2563EB] cursor-pointer transition-colors">
                        Tampilkan Semua Era
                    </button>
                    <button type="button" data-era-highlight="era_1" class="px-3.5 py-2 rounded-lg border text-xs font-mono font-bold bg-white/10 text-slate-200 border-white/15 cursor-pointer transition-colors">
                        1962 - 1976 (Perintisan)
                    </button>
                    <button type="button" data-era-highlight="era_2" class="px-3.5 py-2 rounded-lg border text-xs font-mono font-bold bg-white/10 text-slate-200 border-white/15 cursor-pointer transition-colors">
                        1977 - 2010 (Standarisasi &amp; ISO)
                    </button>
                    <button type="button" data-era-highlight="era_3" class="px-3.5 py-2 rounded-lg border text-xs font-mono font-bold bg-white/10 text-slate-200 border-white/15 cursor-pointer transition-colors">
                        2011 - 2026 (Modern &amp; Merdeka)
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-white/15 bg-[#07132C]">
                <table class="w-full text-left border-collapse min-w-[780px]">
                    <thead>
                        <tr class="border-b border-white/15 bg-white/[0.04] font-mono text-xs uppercase tracking-wider text-cyan-300">
                            <th class="p-4 sm:p-5 w-1/5">Parameter Institusional</th>
                            <th class="p-4 sm:p-5 w-1/4" data-era-col="era_1">Era Perintisan (1962 - 1976)</th>
                            <th class="p-4 sm:p-5 w-1/4" data-era-col="era_2">Era Standarisasi &amp; ISO (1977 - 2010)</th>
                            <th class="p-4 sm:p-5 w-1/4" data-era-col="era_3">Era Modern &amp; Kurikulum Merdeka (2011 - 2026)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10 text-xs sm:text-sm">
                        @foreach($eraMatrix as $row)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="p-4 sm:p-5 font-display font-bold text-white align-top">
                                    {{ $row['parameter'] }}
                                </td>
                                <td class="p-4 sm:p-5 text-slate-300 align-top transition-opacity duration-200" data-era-col="era_1">
                                    {{ $row['era_1'] }}
                                </td>
                                <td class="p-4 sm:p-5 text-slate-200 align-top transition-opacity duration-200" data-era-col="era_2">
                                    {{ $row['era_2'] }}
                                </td>
                                <td class="p-4 sm:p-5 text-cyan-100 font-medium align-top transition-opacity duration-200" data-era-col="era_3">
                                    {{ $row['era_3'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         ACT 4: SUBSTANCE & RANGE - GENEALOGI KURIKULUM, 9 CORE BUSINESS & LKS
         (Signature Move 2: Self-Drawing SVG Blueprint driven by --sc-p)
         ===================================================================== --}}
    <section id="act-genealogy" data-sc-act="flow" class="py-20 bg-[#F8F9FA] border-b border-slate-200 sc-blueprint-grid">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header & Interactive Pioneer Filter --}}
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12" data-sc-in>
                <div>
                    <span class="font-mono text-xs font-bold uppercase tracking-widest text-[#2563EB]">
                        Babak III • Genealogi Struktur Kurikulum &amp; Ekosistem Kompetensi (1962 - 2026)
                    </span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-[#0E1133] mt-1">
                        Ekspansi Spektrum Keahlian, 9 Core Business &amp; Dominasi Prestasi LKS
                    </h2>
                    <p class="text-sm sm:text-base text-slate-600 max-w-3xl mt-2">
                        Dari dua disiplin ilmu dasar pada tahun 1962 (Bangunan Gedung dan Mesin), diperluas dengan Jurusan Listrik pada 1977 (80% praktik lapangan : 20% teori), hingga bertransformasi menjadi 5 Bidang Keahlian dan 12 Kompetensi Keahlian berakreditasi A.
                    </p>
                </div>

                {{-- Filter by 1962 Pioneer Root --}}
                <div class="flex flex-wrap items-center gap-2" role="group" aria-label="Filter Silsilah Jurusan Perintis 1962">
                    <button type="button" data-genealogy-filter="all" class="px-3.5 py-2 rounded-xl border text-xs font-mono font-bold bg-[#0E1133] text-white border-[#0E1133] cursor-pointer transition-colors">
                        Semua Silsilah (1962 - 2026)
                    </button>
                    <button type="button" data-genealogy-filter="bangunan" class="px-3.5 py-2 rounded-xl border text-xs font-mono font-bold bg-white text-[#0E1133] border-slate-300 cursor-pointer transition-colors">
                        Akar Bangunan Gedung (1962)
                    </button>
                    <button type="button" data-genealogy-filter="mesin" class="px-3.5 py-2 rounded-xl border text-xs font-mono font-bold bg-white text-[#0E1133] border-slate-300 cursor-pointer transition-colors">
                        Akar Mesin &amp; Elektrifikasi (1962 / 1977)
                    </button>
                </div>
            </div>

            {{-- Self-Drawing SVG Blueprint Diagram + Genealogy Grid --}}
            <div class="rounded-3xl bg-white border border-slate-200 p-6 sm:p-10 shadow-sm">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    {{-- Left: Fase Pendirian 1962 (2 Jurusan Pionir) --}}
                    <div class="lg:col-span-4 space-y-4">
                        <div class="p-5 rounded-2xl bg-[#0E1133] text-white border border-slate-800">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-[11px] uppercase tracking-widest text-cyan-300 font-bold">Fase Pendirian (1962)</span>
                                <span class="px-2.5 py-0.5 rounded bg-blue-500/20 text-blue-200 font-mono text-xs font-bold">2 Jurusan Pionir</span>
                            </div>
                            <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                                Diinisiasi atas kebutuhan teknisi infrastruktur Bali. Pembelajaran sore di ST Negeri Tulangampiang bersama Departemen PU &amp; Ir. Cokorda Raka Sukawati.
                            </p>

                            <div class="mt-4 space-y-3">
                                <div class="p-3.5 rounded-xl bg-white/10 border border-blue-400/30">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-blue-400"></span>
                                        <span class="font-display font-bold text-sm text-white">Jurusan Bangunan Gedung (1962)</span>
                                    </div>
                                    <p class="text-xs text-slate-300 mt-1">Fondasi teknik sipil, gambar bangunan, konstruksi batu beton, dan perkayuan.</p>
                                </div>

                                <div class="p-3.5 rounded-xl bg-white/10 border border-orange-400/30">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-orange-400"></span>
                                        <span class="font-display font-bold text-sm text-white">Jurusan Mesin (1962) &amp; Listrik (1977)</span>
                                    </div>
                                    <p class="text-xs text-slate-300 mt-1">Fondasi mekanik, otomotif, elektrifikasi 1977 (80% praktik), elektronika, hingga revolusi TIK 1999/2004.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Center: Self-Drawing SVG Technical Connection Tree --}}
                    <div class="hidden lg:flex lg:col-span-1 justify-center items-center">
                        <svg class="w-20 h-96 overflow-visible" viewBox="0 0 80 380" fill="none" aria-hidden="true">
                            <path
                                data-sc-genealogy-path="bangunan"
                                d="M 4 120 C 40 120, 40 45, 76 45"
                                stroke="#2563EB"
                                stroke-width="2.5"
                                stroke-linecap="round"
                            />
                            <path
                                data-sc-genealogy-path="mesin"
                                d="M 4 250 C 40 250, 40 125, 76 125"
                                stroke="#0891B2"
                                stroke-width="2.5"
                                stroke-linecap="round"
                            />
                            <path
                                data-sc-genealogy-path="mesin"
                                d="M 4 250 C 40 250, 40 205, 76 205"
                                stroke="#0D9488"
                                stroke-width="2.5"
                                stroke-linecap="round"
                            />
                            <path
                                data-sc-genealogy-path="mesin"
                                d="M 4 250 C 40 250, 40 285, 76 285"
                                stroke="#EA580C"
                                stroke-width="2.5"
                                stroke-linecap="round"
                            />
                            <path
                                data-sc-genealogy-path="mesin"
                                d="M 4 250 C 40 250, 40 350, 76 350"
                                stroke="#2563EB"
                                stroke-width="2.5"
                                stroke-linecap="round"
                            />
                            <circle cx="4" cy="120" r="4.5" fill="#2563EB" />
                            <circle cx="4" cy="250" r="4.5" fill="#EA580C" />
                        </svg>
                    </div>

                    {{-- Right: 5 Bidang Keahlian Induk & 12 Kompetensi Keahlian Modern --}}
                    <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($curriculumGenealogy['modern_clusters'] as $cluster)
                            @php
                                $originKey = $cluster['id'] === 'cluster-bangunan' ? 'bangunan' : 'mesin';
                            @endphp
                            <div
                                data-genealogy-cluster="{{ $cluster['id'] }}"
                                data-pioneer-origin="{{ $originKey }}"
                                class="p-5 rounded-2xl bg-[#F8F9FA] border border-slate-200 transition-all duration-300 {{ $loop->last ? 'sm:col-span-2' : '' }}"
                            >
                                <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                    <h3 class="font-display font-extrabold text-base text-[#0E1133]">
                                        {{ $cluster['field'] }}
                                    </h3>
                                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-mono text-[11px] font-bold">
                                        {{ $cluster['accreditation'] }}
                                    </span>
                                </div>
                                <div class="text-[11px] font-mono text-slate-500 mb-2.5">
                                    <strong>Era BBC/CBT 1999-2004:</strong> {{ $cluster['era_1999'] }}
                                </div>
                                <ul class="flex flex-wrap gap-1.5 mb-3">
                                    @foreach($cluster['era_modern'] as $modMajor)
                                        <li class="px-2.5 py-1 rounded-md bg-white border border-slate-200 text-xs font-bold text-[#0E1133]">
                                            {{ $modMajor }}
                                        </li>
                                    @endforeach
                                </ul>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    {{ $cluster['focus'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- 9 Unit Bisnis Komersial & Produksi Terintegrasi (Core Business) --}}
                <div class="mt-10 pt-8 border-t border-slate-200" data-sc-in>
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-5">
                        <div>
                            <span class="font-mono text-xs font-bold uppercase tracking-widest text-[#2563EB]">
                                Hilirisasi Keterampilan Vokasi &amp; Teknopreneur (Era Kurikulum Berbasis Kompetensi)
                            </span>
                            <h3 class="font-display font-extrabold text-xl sm:text-2xl text-[#0E1133] mt-0.5">
                                9 Unit Usaha Komersial &amp; Produksi Terintegrasi (Core Business)
                            </h3>
                        </div>
                        <span class="text-xs font-mono text-slate-500">
                            Bengkel Sekolah sebagai Pusat Produksi Bernilai Ekonomi
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3.5">
                        @foreach($coreBusinesses as $cb)
                            <div class="p-4 rounded-xl bg-[#F8F9FA] border border-slate-200 hover:border-blue-500 transition-colors flex items-start gap-3">
                                <span class="px-2.5 py-1 rounded-lg bg-[#0E1133] text-white font-mono text-xs font-extrabold shrink-0">
                                    {{ $cb['code'] }}
                                </span>
                                <div>
                                    <div class="font-display font-bold text-sm text-[#0E1133]">{{ $cb['name'] }}</div>
                                    <div class="text-[11px] font-mono text-[#2563EB] font-semibold">{{ $cb['category'] }}</div>
                                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $cb['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Interactive Chart: 21 Gelar Juara LKS Provinsi & 3 Medali Nasional 2025 --}}
                <div class="mt-10 pt-8 border-t border-slate-200" data-sc-in>
                    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4 mb-6">
                        <div>
                            <span class="font-mono text-xs font-bold uppercase tracking-widest text-[#2563EB]">
                                Rekam Jejak Kompetisi Vokasi
                            </span>
                            <h3 class="font-display font-extrabold text-xl sm:text-2xl text-[#0E1133] mt-0.5">
                                Dominasi 21 Gelar Juara LKS Provinsi per Klaster Disiplin &amp; 3 Medali Nasional 2025
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1">
                                Klik salah satu klaster di bawah untuk menyorot rincian bidang lomba yang dimenangkan kontingen SMK Negeri 1 Denpasar.
                            </p>
                        </div>

                        <div class="flex flex-wrap items-center gap-1.5" role="group" aria-label="Filter Klaster Prestasi LKS">
                            <button type="button" data-lks-filter="all" class="px-3 py-1.5 rounded-lg text-xs font-mono font-bold bg-[#0E1133] text-white cursor-pointer transition-colors">
                                Semua (21 Gelar)
                            </button>
                            @foreach($lksClusters as $cluster)
                                <button type="button" data-lks-filter="{{ $cluster['id'] }}" class="px-3 py-1.5 rounded-lg text-xs font-mono font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 cursor-pointer transition-colors">
                                    {{ $cluster['name'] }} ({{ $cluster['count'] }})
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        @foreach($lksClusters as $cluster)
                            @php
                                $pct = round(($cluster['count'] / $cluster['max']) * 100);
                            @endphp
                            <div
                                data-lks-row="{{ $cluster['id'] }}"
                                class="p-5 rounded-2xl bg-[#F8F9FA] border border-slate-200 transition-all duration-300"
                            >
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-display font-extrabold text-base text-[#0E1133]">{{ $cluster['name'] }}</span>
                                    <span class="font-mono font-extrabold text-sm text-[#2563EB]">{{ $cluster['count'] }} Gelar Podium</span>
                                </div>
                                <div class="h-3 w-full bg-slate-200 rounded-full overflow-hidden mb-3">
                                    <div class="h-full rounded-full" style="width: {{ $pct }}%; background-color: {{ $cluster['color'] }};"></div>
                                </div>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($cluster['fields'] as $fieldItem)
                                        <span class="px-2.5 py-1 rounded-md bg-white border border-slate-200 text-xs font-medium text-slate-700">
                                            {{ $fieldItem }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 p-4 rounded-2xl bg-[#0E1133] text-white flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="text-xs sm:text-sm">
                            <strong class="text-cyan-300 font-mono uppercase tracking-wider">Capaian Terkini (Agustus 2025):</strong>
                            Kontingen SMK Negeri 1 Denpasar menyumbangkan <strong>3 dari 5 medali Provinsi Bali</strong> (4 Perak &amp; 1 Perunggu tingkat nasional) pada ajang Lomba Kompetensi Siswa (LKS) Nasional 2025.
                        </div>
                        <a href="{{ route('achievements.index') }}" class="shrink-0 px-4 py-2 rounded-xl bg-[#2563EB] hover:bg-blue-500 text-white text-xs font-bold transition-colors">
                            Lihat Galeri Prestasi &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         ACT 5: CONTINUITY - DINAMIKA KEPEMIMPINAN 5 KEPALA SEKOLAH (reveal + tilt)
         (Tanpa foto placeholder untuk 4 Kepala Sekolah terdahulu;
          foto asli untuk Kepala Sekolah I Wayan Mustika)
         ===================================================================== --}}
    <section id="act-leadership" data-sc-act="flow" class="py-20 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mb-12" data-sc-in>
                <span class="font-mono text-xs font-bold uppercase tracking-widest text-[#2563EB]">
                    Babak IV • Suksesi Kepemimpinan &amp; Penjaga Visi (1962 - 2026)
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-[#0E1133] mt-1">
                    Daftar Kepala Sekolah dari Masa ke Masa
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-2 leading-relaxed">
                    Keberlanjutan transformasi SMK Negeri 1 Denpasar selama 64 tahun ditopang oleh suksesi kepemimpinan kepala sekolah yang masing-masing membawa fokus strategis sesuai tantangan zamannya.
                </p>
            </div>

            {{-- 4 Kepala Sekolah Terdahulu: Kartu Tipografi Arsip Resmi (Tanpa Foto Placeholder Palsu) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10" data-sc-in data-sc-stagger="80">
                @foreach($principals as $leader)
                    @if(!$leader['has_photo'])
                        <article
                            data-sc-tilt="4"
                            class="rounded-2xl bg-[#F8F9FA] border border-slate-200 p-6 sm:p-7 flex flex-col justify-between shadow-2xs hover:border-blue-500 transition-colors"
                        >
                            <div>
                                <div class="flex flex-wrap items-center justify-between gap-2 pb-4 border-b border-slate-200">
                                    <div class="flex items-center gap-2.5">
                                        <span class="px-2.5 py-1 rounded-md bg-[#0E1133] text-white font-mono text-xs font-extrabold">
                                            KEPSEK {{ $leader['order'] }}
                                        </span>
                                        <span class="font-mono text-xs font-bold text-[#2563EB]">
                                            {{ $leader['period'] }}
                                        </span>
                                    </div>
                                    @if(!empty($leader['nip']))
                                        <span class="font-mono text-[11px] text-slate-500">
                                            NIP: {{ $leader['nip'] }}
                                        </span>
                                    @endif
                                </div>

                                <span class="inline-block mt-4 px-2.5 py-0.5 rounded bg-blue-50 border border-blue-200 text-[#2563EB] text-[11px] font-bold uppercase tracking-wider">
                                    {{ $leader['role_badge'] }}
                                </span>

                                <h3 class="font-display font-extrabold text-2xl text-[#0E1133] mt-2">
                                    {{ $leader['name'] }}
                                </h3>

                                <div class="text-xs font-bold text-slate-700 mt-1">
                                    Fokus Strategis: {{ $leader['focus'] }}
                                </div>

                                <p class="text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed">
                                    {{ $leader['description'] }}
                                </p>
                            </div>

                            <div class="mt-5 pt-4 border-t border-slate-200">
                                <div class="font-mono text-[11px] uppercase tracking-wider text-slate-500 font-bold mb-2">
                                    Tonggak Capaian Masa Jabatan:
                                </div>
                                <ul class="space-y-1.5 text-xs text-slate-700">
                                    @foreach($leader['achievements'] as $ach)
                                        <li class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#2563EB] mt-1.5 shrink-0"></span>
                                            <span>{{ $ach }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </article>
                    @endif
                @endforeach
            </div>

            {{-- Kepala Sekolah ke-5 (2023 - 2026): I Wayan Mustika dengan Foto Dokumentasi Asli --}}
            @php
                $currentLeader = collect($principals)->firstWhere('has_photo', true);
            @endphp
            @if($currentLeader)
                <div data-sc-reveal="up" data-sc-reveal-at="0.05 0.45" class="rounded-3xl bg-[#07132C] text-white border border-blue-400/30 overflow-hidden shadow-xl">
                    <div class="grid grid-cols-1 lg:grid-cols-12">
                        {{-- Left Photo Column: Foto Asli Kepala Sekolah I Wayan Mustika --}}
                        <div class="lg:col-span-5 bg-[#0D1F44] relative flex flex-col justify-between p-6 sm:p-8 border-b lg:border-b-0 lg:border-r border-white/10">
                            <div>
                                <span class="inline-block px-3 py-1 rounded-full bg-cyan-400/15 border border-cyan-400/30 font-mono text-xs text-cyan-300 font-bold">
                                    {{ $currentLeader['period'] }}
                                </span>
                                <h3 class="font-display font-extrabold text-2xl sm:text-3xl text-white mt-3">
                                    {{ $currentLeader['name'] }}
                                </h3>
                                <p class="text-xs font-mono text-blue-200 mt-1">
                                    {{ $currentLeader['nip'] }}
                                </p>
                            </div>

                            <div class="my-6 grid grid-cols-2 gap-3 items-end">
                                <div class="rounded-2xl overflow-hidden border border-white/15 bg-[#07132C] aspect-[3/4]">
                                    <img
                                        src="{{ $currentLeader['photo'] }}"
                                        alt="{{ $currentLeader['name'] }} - Kepala SMK Negeri 1 Denpasar"
                                        class="w-full h-full object-cover object-top"
                                    >
                                </div>
                                <div class="rounded-2xl overflow-hidden border border-cyan-400/30 bg-[#07132C]/80 p-2 flex flex-col items-center justify-end">
                                    <img
                                        src="{{ $currentLeader['cutout_photo'] }}"
                                        alt="Potret Meja Kerja Kepala Sekolah {{ $currentLeader['name'] }}"
                                        class="w-full h-44 object-contain object-bottom"
                                    >
                                    <span class="text-[10px] font-mono text-cyan-300 mt-1">Meja Kerja Kepala Sekolah</span>
                                </div>
                            </div>

                            <div class="p-3.5 rounded-xl bg-white/[0.06] border border-white/10 text-xs text-slate-200">
                                <strong class="text-cyan-300 font-mono uppercase">Purnabakti Resmi:</strong>
                                Pelepasan purna tugas digelar pada <strong>Jumat, 30 Oktober 2026</strong> di Aula SMKN 1 Denpasar (efektif pensiun <strong>1 November 2026</strong>), menandai genap 36 tahun pengabdian beliau sejak menjadi guru STM Negeri Ubung tahun 1990.
                            </div>
                        </div>

                        {{-- Right Narrative Column --}}
                        <div class="lg:col-span-7 p-6 sm:p-10 flex flex-col justify-between">
                            <div>
                                <div class="inline-block px-3 py-1 rounded bg-blue-500/20 border border-blue-400/30 text-blue-300 text-xs font-mono font-bold uppercase tracking-wider">
                                    {{ $currentLeader['role_badge'] }}
                                </div>

                                <h4 class="font-display font-bold text-xl sm:text-2xl text-white mt-4">
                                    {{ $currentLeader['focus'] }}
                                </h4>

                                <p class="text-sm sm:text-base text-slate-300 mt-3 leading-relaxed">
                                    {{ $currentLeader['description'] }}
                                </p>

                                <div class="mt-6 space-y-2.5">
                                    @foreach($currentLeader['achievements'] as $ach)
                                        <div class="p-3.5 rounded-xl bg-white/[0.05] border border-white/10 text-xs sm:text-sm text-slate-200 flex items-start gap-2.5">
                                            <span class="w-2 h-2 rounded-full bg-cyan-400 mt-1.5 shrink-0"></span>
                                            <span>{{ $ach }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-white/15 grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
                                <div class="sm:col-span-5 rounded-xl overflow-hidden border border-white/15 h-28">
                                    <img
                                        src="{{ $currentLeader['event_photo'] }}"
                                        alt="Perayaan HUT ke-63 SMK Negeri 1 Denpasar"
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                                <div class="sm:col-span-7 text-xs text-slate-300 leading-relaxed">
                                    <div class="font-bold text-white">Dokumentasi HUT ke-63 SMK Negeri 1 Denpasar</div>
                                    <p class="mt-1">
                                        Filosofi kerja <em>"bergerak seirama dan sefrekuensi"</em> menjaga kesinambungan visi Skensa bersama jajaran Wakil Kepala Sekolah, Komite Sekolah, dan Pengawas Disdikpora Provinsi Bali.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- =====================================================================
         ACT 6: COMMITMENT & ARCHIVE - SINTESIS HISTORIS & LACI 29 KUTIPAN
         ===================================================================== --}}
    <section id="act-archive" data-sc-act="flow" class="py-20 bg-[#F0F2F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Historical Synthesis Colophon Card --}}
            <div class="rounded-3xl bg-[#0E1133] text-white p-8 sm:p-12 shadow-lg mb-10" data-sc-in>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8">
                        <span class="font-mono text-xs font-bold uppercase tracking-widest text-cyan-300">
                            Sintesis &amp; Kesimpulan Historis (1962 - 2026)
                        </span>
                        <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-white mt-2 leading-tight">
                            64 Tahun Menjadi Barometer Pendidikan Vokasi Teknologi &amp; Rekayasa di Bali.
                        </h2>
                        <p class="text-sm sm:text-base text-slate-300 mt-4 leading-relaxed">
                            Dari instrumen teknokratis Pemerintah Daerah Tingkat I Bali pada 24 September 1962 yang menumpang di kelas sore Tulangampiang, relokasi bersejarah ke gedung Jalan HOS Cokroaminoto Nomor 84 Ubung pada 15 April 1977 lewat dukungan Proyek PELITA dan kerja sama Indonesia-Belanda (Proyek N.95), hingga pencapaian ISO 9001:2000 dan Kurikulum Merdeka, SMK Negeri 1 Denpasar membuktikan kemampuan adaptasi institusional yang tak terputus lintas generasi.
                        </p>
                    </div>
                    <div class="lg:col-span-4 flex flex-col gap-3">
                        <a
                            href="{{ route('majors.index') }}"
                            class="w-full py-3.5 px-5 rounded-xl bg-[#2563EB] hover:bg-blue-500 text-white font-bold text-sm text-center transition-colors"
                        >
                            Jelajahi 13 Konsentrasi Keahlian Saat Ini &rarr;
                        </a>
                        <a
                            href="{{ route('profile.index') }}"
                            class="w-full py-3.5 px-5 rounded-xl bg-white/10 hover:bg-white/15 border border-white/15 text-white font-semibold text-sm text-center transition-colors"
                        >
                            Kembali ke Halaman Profil &amp; Visi-Misi
                        </a>
                        <a
                            href="{{ route('staff.index') }}"
                            class="w-full py-3.5 px-5 rounded-xl bg-white/10 hover:bg-white/15 border border-white/15 text-slate-200 font-semibold text-sm text-center transition-colors"
                        >
                            Lihat Direktori SDM &amp; Pengajar
                        </a>
                    </div>
                </div>
            </div>

            {{-- Collapsible & Searchable Drawer: 29 Karya yang Dikutip (Arsip Referensi Resmi) --}}
            <div class="rounded-2xl bg-white border border-slate-200 p-6 sm:p-8 shadow-2xs" data-sc-in>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <span class="font-mono text-xs font-bold uppercase tracking-widest text-[#2563EB]">
                            Verifikasi Akademik &amp; Sumber Data Primer
                        </span>
                        <h3 class="font-display font-extrabold text-xl sm:text-2xl text-[#0E1133] mt-0.5">
                            Daftar Pustaka &amp; 29 Sumber Kutipan Arsip Resmi
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1">
                            Seluruh narasi, nomor SK, luas aset, dan rekam jejak di halaman ini bersumber dari dokumen resmi Kemendikdasmen, Disdikpora, Perpustakaan Digital SMKN 1 Denpasar, dan arsip media.
                        </p>
                    </div>

                    <button
                        type="button"
                        id="sc-citations-toggle"
                        aria-expanded="false"
                        aria-controls="sc-citations-panel"
                        class="shrink-0 inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#0E1133] hover:bg-blue-700 text-white text-xs font-mono font-bold transition-colors cursor-pointer"
                    >
                        <span id="sc-citations-toggle-label">Buka Laci 29 Sumber Kutipan Arsip Resmi</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </div>

                <div id="sc-citations-panel" class="hidden mt-6 pt-6 border-t border-slate-200">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                        <input
                            type="search"
                            id="sc-citations-search"
                            placeholder="Cari sumber kutipan (misal: Daikin, Mustika, LKS, STEKOM, Kemendikdasmen)..."
                            class="w-full sm:max-w-md px-4 py-2 rounded-xl border border-slate-300 text-xs sm:text-sm focus:outline-none focus:border-[#2563EB]"
                        >
                        <span id="sc-citations-count" class="font-mono text-xs text-slate-500">
                            29 dari 29 sumber ditampilkan
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($citations as $cite)
                            <a
                                href="{{ $cite['url'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                data-citation-item
                                data-citation-text="{{ $cite['no'] }} {{ $cite['title'] }} {{ $cite['source'] }}"
                                class="p-3.5 rounded-xl bg-[#F8F9FA] hover:bg-blue-50/60 border border-slate-200 hover:border-blue-400 transition-colors flex items-start gap-3 group"
                            >
                                <span class="px-2 py-0.5 rounded bg-[#0E1133] group-hover:bg-[#2563EB] text-white font-mono text-[11px] font-bold shrink-0">
                                    [{{ $cite['no'] }}]
                                </span>
                                <div class="min-w-0">
                                    <div class="text-xs font-bold text-[#0E1133] group-hover:text-[#2563EB] leading-snug">
                                        {{ $cite['title'] }}
                                    </div>
                                    <div class="text-[11px] font-mono text-slate-500 mt-1 truncate">
                                        {{ $cite['source'] }} • {{ $cite['url'] }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SIGNATURE MOVE 1: PERSISTENT CHRONOLOGY TRACE RAIL (1962 - 2026)
         Fixed slim bottom rail with interactive era popover
         ===================================================================== --}}
    <aside
        id="sc-chronology-trace"
        aria-label="Linimasa Interaktif Sejarah 1962 - 2026"
        class="fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200 shadow-md text-[#0E1133]"
    >
        {{-- Continuous Scroll Trace Bar --}}
        <div class="h-0.5 w-full bg-slate-100 overflow-hidden">
            <div id="sc-trace-fill" class="h-full bg-[#2563EB] origin-left scale-x-0"></div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-11 flex items-center justify-between gap-4">
            {{-- Left: Active Year Playhead & Phase Name --}}
            <div class="flex items-center gap-2.5 min-w-0">
                <span id="sc-trace-active-year" class="font-display font-extrabold text-sm sm:text-base tabular-nums text-[#0E1133]">
                    1962
                </span>
                <span class="text-slate-300 text-xs">•</span>
                <span id="sc-trace-active-phase" class="text-xs sm:text-sm font-medium text-slate-600 truncate">
                    Era Perintisan STM Negeri Denpasar
                </span>
            </div>

            {{-- Right: Era Popover Trigger Button --}}
            <div class="relative shrink-0">
                <button
                    type="button"
                    id="sc-trace-menu-btn"
                    aria-expanded="false"
                    aria-controls="sc-trace-menu"
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg border border-slate-200 hover:border-slate-300 bg-white hover:bg-slate-50 text-xs font-semibold text-[#0E1133] transition-colors cursor-pointer"
                >
                    <span>Lompat ke era</span>
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
                    </svg>
                </button>

                {{-- Upward Popover Menu --}}
                <div
                    id="sc-trace-menu"
                    class="hidden absolute right-0 bottom-12 w-64 bg-white border border-slate-200 rounded-xl shadow-xl p-1.5 text-xs space-y-0.5 z-50"
                    role="menu"
                >
                    <button
                        type="button"
                        data-sc-trace-node="0"
                        data-sc-trace-target="#act-origin"
                        class="w-full text-left px-3 py-2 rounded-lg font-medium text-[#0E1133] hover:bg-blue-50 hover:text-[#2563EB] transition-colors cursor-pointer"
                    >
                        1962 • Tulangampiang
                    </button>
                    <button
                        type="button"
                        data-sc-trace-node="1"
                        data-sc-trace-target="#milestone-1"
                        class="w-full text-left px-3 py-2 rounded-lg font-medium text-[#0E1133] hover:bg-blue-50 hover:text-[#2563EB] transition-colors cursor-pointer"
                    >
                        1970-an • PELITA / N.95
                    </button>
                    <button
                        type="button"
                        data-sc-trace-node="2"
                        data-sc-trace-target="#milestone-2"
                        class="w-full text-left px-3 py-2 rounded-lg font-medium text-[#0E1133] hover:bg-blue-50 hover:text-[#2563EB] transition-colors cursor-pointer"
                    >
                        1977 • Gedung Ubung
                    </button>
                    <button
                        type="button"
                        data-sc-trace-node="3"
                        data-sc-trace-target="#milestone-3"
                        class="w-full text-left px-3 py-2 rounded-lg font-medium text-[#0E1133] hover:bg-blue-50 hover:text-[#2563EB] transition-colors cursor-pointer"
                    >
                        1997 • SMKN 1 Denpasar
                    </button>
                    <button
                        type="button"
                        data-sc-trace-node="4"
                        data-sc-trace-target="#act-genealogy"
                        class="w-full text-left px-3 py-2 rounded-lg font-medium text-[#0E1133] hover:bg-blue-50 hover:text-[#2563EB] transition-colors cursor-pointer"
                    >
                        2006 • ISO &amp; Kurikulum
                    </button>
                    <button
                        type="button"
                        data-sc-trace-node="5"
                        data-sc-trace-target="#act-leadership"
                        class="w-full text-left px-3 py-2 rounded-lg font-medium text-[#0E1133] hover:bg-blue-50 hover:text-[#2563EB] transition-colors cursor-pointer"
                    >
                        2026 • Kepemimpinan
                    </button>
                </div>
            </div>
        </div>
    </aside>

</div>
@endsection
