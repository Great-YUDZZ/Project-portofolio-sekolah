@extends('layouts.public')

@section('title', 'Direktori Ekstrakurikuler Siswa (51 Bidang Bakat & Minat) - SMK Negeri 1 Denpasar')

@section('content')

    {{-- Hero Section --}}
    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-reveal>
            <span class="inline-block px-3 py-1 rounded bg-ink text-white text-xs font-extrabold uppercase tracking-widest">
                Pengembangan Karakter &amp; Minat Bakat Siswa
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3 tracking-tight">Direktori Ekstrakurikuler SKENSA</h1>
            <p class="text-paper/80 text-base max-w-3xl mt-2 leading-relaxed">
                Wadah aktualisasi potensi, kepemimpinan, olahraga prestasi, seni budaya tradisional Bali, serta klub inovasi sains dan teknologi SMK Negeri 1 Denpasar.
            </p>

            {{-- Metric Ribbon --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8 pt-8 border-t border-paper/10 text-xs uppercase tracking-wider">
                <div class="p-4 rounded-xl bg-paper/5 border border-paper/10">
                    <span class="block text-2xl font-extrabold font-mono text-white">{{ $stats['total'] }}</span>
                    <span class="text-paper/70 font-semibold mt-1 block">Total Ekstrakurikuler</span>
                </div>
                <div class="p-4 rounded-xl bg-paper/5 border border-paper/10">
                    <span class="block text-2xl font-extrabold font-mono text-white">{{ $stats['non_akademik'] }}</span>
                    <span class="text-paper/70 font-semibold mt-1 block">Non-Akademik / Olahraga &amp; Seni</span>
                </div>
                <div class="p-4 rounded-xl bg-paper/5 border border-paper/10">
                    <span class="block text-2xl font-extrabold font-mono text-white">{{ $stats['akademik'] }}</span>
                    <span class="text-paper/70 font-semibold mt-1 block">Akademik &amp; Sains Teknologi</span>
                </div>
                <div class="p-4 rounded-xl bg-paper/5 border border-paper/10">
                    <span class="block text-2xl font-extrabold font-mono text-white">50+</span>
                    <span class="text-paper/70 font-semibold mt-1 block">Guru Pembina Berlisensi</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content Section --}}
    <section class="py-12 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Filter & Search Form --}}
            <form method="GET" action="{{ route('extracurriculars.index') }}" class="p-5 rounded-2xl bg-paper-2 border border-line mb-10 flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4" data-reveal>
                {{-- Category Filter Pills --}}
                <div class="flex flex-wrap items-center gap-2">
                    @php
                        $filterTabs = [
                            '' => ['label' => 'Semua Ekstra', 'count' => $stats['total']],
                            'non-akademik' => ['label' => 'Non-Akademik (Olahraga & Seni)', 'count' => $stats['non_akademik']],
                            'akademik' => ['label' => 'Akademik & Sains Teknologi', 'count' => $stats['akademik']],
                        ];
                    @endphp
                    @foreach($filterTabs as $tabKey => $tab)
                        <a
                            href="{{ route('extracurriculars.index', array_filter(['kategori' => $tabKey ?: null, 'q' => $search ?: null])) }}"
                            class="px-3.5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors inline-flex items-center gap-1.5 {{ ($category ?? '') === $tabKey ? 'bg-navy text-paper shadow-sm' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                        >
                            <span>{{ $tab['label'] }}</span>
                            <span class="px-1.5 py-0.5 rounded text-[10px] {{ ($category ?? '') === $tabKey ? 'bg-white/20 text-white' : 'bg-paper-2 text-ink-muted' }}">
                                {{ $tab['count'] }}
                            </span>
                        </a>
                    @endforeach
                </div>

                {{-- Search Box --}}
                <div class="flex items-center gap-2">
                    <div class="relative w-full lg:w-72">
                        <input
                            type="search"
                            name="q"
                            value="{{ $search }}"
                            placeholder="Cari ekskul, pembina, klaster..."
                            class="w-full pl-9 pr-3.5 py-2 rounded-lg bg-paper border border-line text-sm text-ink focus:outline-none focus:border-navy"
                        >
                        <svg class="w-4 h-4 text-ink-muted absolute left-3 top-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    @if($category)
                        <input type="hidden" name="kategori" value="{{ $category }}">
                    @endif
                    <button type="submit" class="px-4 py-2 rounded-lg bg-ink text-white hover:bg-slate-800 text-xs font-extrabold uppercase tracking-wider cursor-pointer transition-colors shadow-sm shrink-0">
                        Filter
                    </button>
                    @if($category || $search)
                        <a href="{{ route('extracurriculars.index') }}" class="px-3 py-2 rounded-lg bg-paper border border-line text-xs font-bold text-ink-muted hover:text-ink shrink-0" title="Reset filter">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            {{-- Empty State --}}
            @if($extracurriculars->isEmpty())
                <div class="p-12 rounded-2xl bg-paper-2 border border-line text-center max-w-xl mx-auto my-8" data-reveal>
                    <div class="w-12 h-12 rounded-xl bg-navy/10 text-navy mx-auto flex items-center justify-center font-bold text-lg mb-3">
                        ?
                    </div>
                    <h2 class="font-display font-bold text-xl text-ink">Ekstrakurikuler Tidak Ditemukan</h2>
                    <p class="text-sm text-ink-muted mt-2 leading-relaxed">
                        Tidak ada kegiatan ekstrakurikuler atau pembina yang sesuai dengan kata kunci pencarian atau kategori yang Anda pilih.
                    </p>
                    <a href="{{ route('extracurriculars.index') }}" class="inline-block mt-5 px-5 py-2.5 rounded-lg bg-navy text-paper text-xs font-bold uppercase tracking-wider hover:bg-navy-700 transition-colors">
                        Reset Semua Filter
                    </a>
                </div>
            @else

                {{-- Header Result Count --}}
                <div class="flex items-center justify-between mb-6 pb-3 border-b border-line" data-reveal>
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-widest text-navy">
                            {{ $category === 'non-akademik' ? 'Kategori Non-Akademik' : ($category === 'akademik' ? 'Kategori Akademik' : 'Semua Kategori') }}
                        </span>
                        <h2 class="font-display font-extrabold text-2xl text-ink mt-0.5">Daftar Kegiatan Ekstrakurikuler</h2>
                    </div>
                    <span class="text-xs font-bold text-ink-muted uppercase tracking-wider">
                        Menampilkan {{ $extracurriculars->count() }} Kegiatan
                    </span>
                </div>

                {{-- Extracurriculars Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-reveal-stagger>
                    @foreach($extracurriculars as $ekskul)
                        <article class="p-6 rounded-2xl bg-white border border-line flex flex-col justify-between hover:border-navy hover:shadow-xs transition-all duration-200 group">
                            <div>
                                {{-- Badges Row --}}
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="px-2.5 py-0.5 rounded text-[10px] font-extrabold uppercase tracking-wider {{ $ekskul->category === 'non-akademik' ? 'bg-amber-600 text-white' : 'bg-navy text-paper' }}">
                                        {{ $ekskul->category_label }}
                                    </span>
                                    @if($ekskul->sub_cluster)
                                        <span class="text-[11px] font-semibold text-ink-muted truncate max-w-[170px]" title="{{ $ekskul->sub_cluster }}">
                                            {{ $ekskul->sub_cluster }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Title & Description --}}
                                <div class="flex items-start gap-3 mt-2">
                                    <div class="w-10 h-10 rounded-lg bg-paper-2 border border-line text-ink flex items-center justify-center font-display font-extrabold text-sm shrink-0 group-hover:bg-navy group-hover:text-paper transition-colors">
                                        {{ strtoupper(substr($ekskul->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-display font-extrabold text-lg text-ink leading-snug group-hover:text-navy transition-colors">
                                            {{ $ekskul->name }}
                                        </h3>
                                        <p class="text-xs text-ink-muted mt-1 leading-relaxed">
                                            {{ $ekskul->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer: Pembina & WhatsApp Contact Action --}}
                            <div class="mt-6 pt-4 border-t border-line space-y-2.5">
                                <div class="flex items-center justify-between text-xs">
                                    <div>
                                        <span class="text-[10px] uppercase font-bold text-ink-muted block">Guru Pembina:</span>
                                        <span class="font-bold text-ink">{{ $ekskul->mentor_name }}</span>
                                    </div>
                                    @if($ekskul->mentor_phone)
                                        <span class="text-[11px] font-mono text-ink-muted">{{ $ekskul->mentor_phone }}</span>
                                    @endif
                                </div>

                                @if($ekskul->formatted_whatsapp)
                                    <a
                                        href="https://wa.me/{{ $ekskul->formatted_whatsapp }}?text={{ urlencode('Halo Bapak/Ibu ' . $ekskul->mentor_name . ', saya siswa SKENSA ingin berkonsultasi seputar kegiatan ekstrakurikuler ' . $ekskul->name . '.') }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold uppercase tracking-wider transition-colors shadow-xs"
                                    >
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12 0 2.155.57 4.175 1.564 5.923l-1.564 5.905 6.077-1.594c1.701.928 3.652 1.466 5.923 1.466 6.627 0 12-5.373 12-12 0-6.627-5.373-12-12-12z"/>
                                        </svg>
                                        <span>Hubungi Pembina via WhatsApp</span>
                                    </a>
                                @else
                                    <div class="py-2 px-3 rounded-xl bg-paper-2 border border-line text-center text-xs text-ink-muted">
                                        Kontak langsung ke Ruang Pembina Kesiswaan
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>

            @endif

            {{-- Kesiswaan Registration Guide Card --}}
            <div class="mt-14 p-8 rounded-2xl bg-white border-2 border-line flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 shadow-xs" data-reveal>
                <div class="space-y-2 max-w-2xl">
                    <span class="px-2.5 py-0.5 rounded bg-ink text-white text-[10px] font-extrabold uppercase tracking-wider">
                        Pendaftaran Anggota Baru
                    </span>
                    <h3 class="font-display font-bold text-xl text-ink">Ingin Bergabung dengan Ekstrakurikuler Pilihanmu?</h3>
                    <p class="text-xs text-ink-muted leading-relaxed">
                        Pendaftaran anggota baru dibuka pada awal tahun ajaran baru serta awal semester genap melalui Pengurus OSIS/MPK atau menghubungi langsung guru pembina masing-masing ekstrakurikuler di atas. Setiap siswa wajib memilih minimal satu ekstrakurikuler wajib dan diperbolehkan mengambil ekstrakurikuler peminatan.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <a
                        href="{{ route('contact.index') }}"
                        class="px-5 py-2.5 rounded-xl bg-navy text-paper hover:bg-navy-700 text-xs font-bold uppercase tracking-wider transition-colors shadow-xs"
                    >
                        Konsultasi Kesiswaan &rarr;
                    </a>
                    <a
                        href="{{ route('home') }}#prestasi-kesiswaan"
                        class="px-4 py-2.5 rounded-xl bg-paper border border-line text-xs font-bold text-ink hover:border-navy uppercase tracking-wider transition-colors"
                    >
                        Agenda SUBAKTI
                    </a>
                </div>
            </div>

        </div>
    </section>

@endsection
