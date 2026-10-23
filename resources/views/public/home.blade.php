@extends('layouts.app', ['title' => 'Beranda'])

@section('content')
<div class="min-h-screen bg-paper flex flex-col">
    {{-- Navbar Publik --}}
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex justify-between items-center">
            <div class="flex items-center space-x-3.5">
                <div class="w-11 h-11 rounded-2xl bg-navy text-white font-display font-extrabold flex items-center justify-center text-lg shadow-sm border border-navy-700">
                    S1D
                </div>
                <div>
                    <span class="font-display font-bold text-lg text-navy tracking-tight block leading-tight">
                        SMK Negeri 1 Denpasar
                    </span>
                    <span class="text-xs text-ink-muted italic font-serif">
                        Abhyāsad Dhäryate Vidyä
                    </span>
                </div>
            </div>

            <nav class="hidden md:flex items-center space-x-7 text-xs font-semibold text-ink">
                <a href="#jurusan" class="hover:text-navy transition-colors">13 Jurusan</a>
                <a href="#karakter" class="hover:text-navy transition-colors">4 Nilai Karakter</a>
                <a href="#ekosistem" class="hover:text-navy transition-colors">Ekosistem Digital</a>
            </nav>

            <div class="flex items-center space-x-3">
                @auth
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('lms.dashboard') }}"
                       class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold bg-navy text-white hover:bg-navy-700 transition-all shadow-sm">
                        Buka Dashboard ({{ auth()->user()->role->label() }}) &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold bg-navy text-white hover:bg-navy-700 transition-all shadow-sm">
                        Masuk Portal &rarr;
                    </a>
                @endauth
            </div>
        </div>
    </header>

    {{-- Hero Section Preview --}}
    <section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
        <div class="text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-semibold bg-paper-2 text-navy border border-line mb-6">
                Website Portofolio Resmi Sekolah
            </div>
            <h1 class="text-4xl sm:text-6xl font-display font-extrabold text-navy tracking-tight leading-tight">
                Peliharalah Ilmu Sampai Menjadi Tradisi
            </h1>
            <p class="mt-4 text-sm sm:text-base text-ink-muted leading-relaxed">
                Mencetak generasi vokasi unggul, siap kerja, dan berkarakter luhur melalui penguasaan 13 konsentrasi keahlian berstandar industri modern di Bali.
            </p>

            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="#jurusan" class="px-6 py-3 rounded-full bg-navy text-white text-xs font-semibold hover:bg-navy-700 transition-all shadow-sm">
                    Eksplorasi 13 Jurusan
                </a>
                <a href="{{ route('login') }}" class="px-6 py-3 rounded-full bg-white text-navy border border-line text-xs font-semibold hover:bg-paper-2 transition-all">
                    Masuk ke LMS Skensa
                </a>
            </div>
        </div>
    </section>

    {{-- 4 Nilai Karakter --}}
    <section id="karakter" class="py-16 bg-white border-y border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold text-yellow-skensa uppercase tracking-wider">Nilai Karakter Utama</span>
                <h2 class="text-2xl sm:text-3xl font-display font-bold text-navy mt-1">4 Pilar Karakter SKENSA</h2>
                <p class="text-xs text-ink-muted mt-1.5">Fondasi pembiasaan sikap bagi seluruh warga SMK Negeri 1 Denpasar</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($characterValues as $val)
                    <div class="p-6 rounded-2xl bg-paper border border-line hover:border-navy transition-all">
                        <div class="w-10 h-10 rounded-xl bg-navy text-yellow-skensa font-display font-bold flex items-center justify-center text-sm mb-4">
                            {{ substr($val['title'] ?? 'S', 0, 1) }}
                        </div>
                        <h3 class="font-display font-bold text-navy text-base">{{ $val['title'] ?? '' }}</h3>
                        <p class="mt-2 text-xs text-ink-muted leading-relaxed">{{ $val['desc'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 13 Jurusan (Data Master DB) --}}
    <section id="jurusan" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs font-bold text-yellow-skensa uppercase tracking-wider">Kompetensi Keahlian</span>
                <h2 class="text-2xl sm:text-3xl font-display font-bold text-navy mt-1">13 Konsentrasi Keahlian Unggulan</h2>
                <p class="text-xs text-ink-muted mt-1.5">Terbagi ke dalam 9 bidang keahlian strategis siap kerja</p>
            </div>
            <div class="mt-4 md:mt-0 text-xs text-ink-muted">
                Total: <span class="font-bold text-navy">{{ $majors->count() }} Jurusan</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($majors as $m)
                <div class="p-6 rounded-2xl bg-white border border-line shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-2.5 py-1 rounded-md bg-paper-2 font-display font-extrabold text-xs text-navy border border-line">
                                {{ $m->code }}
                            </span>
                            <span class="text-[11px] text-ink-muted">{{ $m->field->name }}</span>
                        </div>
                        <h3 class="font-display font-bold text-navy text-base leading-snug">
                            {{ $m->name }}
                        </h3>
                        <p class="mt-2 text-xs text-ink-muted leading-relaxed line-clamp-3">
                            {{ $m->description }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-line/60 flex items-center justify-between">
                        <span class="text-[11px] text-ink-muted">Kaprodi: {{ $m->head_of_major ?? '-' }}</span>
                        <span class="text-xs font-semibold text-navy">&rarr;</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Footer --}}
    <footer class="mt-auto bg-navy text-white py-12 border-t border-navy-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs">
            <div>
                <span class="font-display font-bold text-sm block">SMK Negeri 1 Denpasar</span>
                <span class="text-white/60">Jalan HOS. Cokroaminoto No. 84 Denpasar, Bali 80118</span>
            </div>
            <div class="text-white/60 text-center sm:text-right">
                &copy; {{ date('Y') }} Skensa Jaya. Project Portofolio Sekolah.
            </div>
        </div>
    </footer>
</div>
@endsection
