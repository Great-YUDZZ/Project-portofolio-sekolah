@extends('layouts.public')

@section('title', 'Profil Institusi & Sejarah - SMK Negeri 1 Denpasar')

@section('content')

    {{-- Header Banner --}}
    <section class="bg-navy text-paper border-b-2 border-ink py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-block px-3 py-1 rounded bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-widest">
                    Profil Institusi Resmi • NPSN {{ $settings['school_npsn'] ?? '50103118' }}
                </span>
                <span class="inline-block px-3 py-1 rounded bg-navy-800 border border-navy-600 text-paper text-xs font-bold uppercase tracking-wider">
                    SK Pendirian: No. 17/D.J.P.T/B1/1962 (24 September 1962)
                </span>
            </div>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl text-paper mt-3">
                Tentang SMK Negeri 1 Denpasar
            </h1>
            <p class="text-paper/80 text-base sm:text-lg max-w-3xl mt-3 leading-relaxed">
                Dari STM Negeri Denpasar (1962) hingga menjadi SMK Pusat Keunggulan berbasis Teaching Factory dan sertifikasi LSP-P1 BNSP di Provinsi Bali.
            </p>
        </div>
    </section>

    {{-- Sejarah, Visi-Misi, Filosofi --}}
    <section class="py-16 bg-paper border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            @foreach($pages as $page)
                <article data-reveal class="p-8 sm:p-10 rounded-2xl bg-paper-2/70 border border-line">
                    <span class="text-xs font-bold uppercase tracking-widest text-navy">{{ $page->subtitle }}</span>
                    <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-ink mt-1">{{ $page->title }}</h2>
                    <div class="prose max-w-none text-ink-muted mt-4 space-y-3 leading-relaxed">
                        {!! $page->body !!}
                    </div>

                    @if(!empty($page->meta['items']) && is_array($page->meta['items']))
                        <div class="mt-6 pt-6 border-t border-line">
                            <h3 class="font-display font-bold text-base uppercase tracking-wider text-navy mb-3">Butir Utama</h3>
                            <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($page->meta['items'] as $item)
                                    <li class="p-4 rounded-xl bg-paper border border-line text-sm text-ink font-medium flex items-start gap-2.5">
                                        <span class="px-2 py-0.5 rounded bg-yellow-skensa text-ink text-xs font-extrabold">{{ $loop->iteration }}</span>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </article>
            @endforeach
        </div>
    </section>

    {{-- Jajaran Pimpinan --}}
    <section class="py-16 bg-paper-2 border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-navy">Tata Kelola Organisasi</span>
                    <h2 class="font-display font-extrabold text-3xl text-ink mt-1">Pimpinan & Wakil Kepala Sekolah</h2>
                </div>
                <a href="{{ route('staff.index') }}" class="text-xs font-bold uppercase tracking-wider text-navy hover:underline">
                    Lihat Direktori SDM Lengkap &rarr;
                </a>
            </div>

            {{-- Visual Pimpinan & 4 Wakil Kepala Sekolah --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
                <div class="lg:col-span-5 rounded-2xl bg-navy text-paper border-2 border-ink overflow-hidden flex flex-col sm:flex-row items-center">
                    <div class="w-full sm:w-48 h-64 sm:h-full bg-navy-800 shrink-0 overflow-hidden">
                        <img src="/images/kepala-sekolah-i-wayan-mustika.jpg" alt="I Wayan Mustika, S.Pd., M.Pd. - Kepala SMK Negeri 1 Denpasar" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-6">
                        <span class="px-2.5 py-0.5 rounded bg-yellow-skensa text-ink text-xs font-extrabold uppercase">Kepala Sekolah</span>
                        <h3 class="font-display font-bold text-xl mt-3">{{ $principal->name ?? 'I Wayan Mustika, S.Pd., M.Pd.' }}</h3>
                        <p class="text-xs text-paper/80 mt-1">{{ $principal->position ?? 'Kepala SMK Negeri 1 Denpasar' }}</p>
                        @if(!empty($principal->nip))
                            <p class="text-xs text-yellow-skensa font-mono mt-2">NIP: {{ $principal->nip }}</p>
                        @endif
                        <p class="text-xs text-paper/85 mt-3 leading-relaxed">
                            {{ $principal->bio ?? 'Memimpin transformasi SMK Pusat Keunggulan berbasis Teaching Factory, sertifikasi profesi LSP-P1 BNSP, dan sinergi industri nasional maupun global.' }}
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-7 rounded-2xl bg-paper border-2 border-ink overflow-hidden grid grid-cols-1 sm:grid-cols-12">
                    <div class="sm:col-span-6 bg-paper-2 flex items-center justify-center p-3">
                        <img src="/images/hero_waka.jpg" alt="Jajaran Wakil Kepala SMK Negeri 1 Denpasar" class="w-full h-56 object-contain rounded-xl">
                    </div>
                    <div class="sm:col-span-6 p-6 flex flex-col justify-center">
                        <span class="text-[11px] font-extrabold uppercase tracking-widest text-navy">Sinergi Manajemen</span>
                        <h3 class="font-display font-bold text-xl text-ink mt-1">4 Wakil Kepala Sekolah</h3>
                        <p class="text-xs text-ink-muted mt-2 leading-relaxed">
                            Mengawal empat bidang strategis kampus: Bidang Kurikulum & Pembelajaran, Bidang Kesiswaan & Karakter, Bidang Sarana Prasarana, serta Bidang Humas & Hubungan Industri (DUDIKA).
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($vicePrincipals as $vp)
                    <div class="p-6 rounded-2xl bg-paper border border-line">
                        <span class="px-2.5 py-0.5 rounded bg-paper-2 border border-line text-navy text-xs font-bold uppercase">Wakil Kepala Sekolah</span>
                        <h3 class="font-display font-bold text-lg text-ink mt-3">{{ $vp->name }}</h3>
                        <p class="text-xs font-semibold text-navy mt-1">{{ $vp->position }}</p>
                        @if($vp->nip)
                            <p class="text-xs text-ink-muted font-mono mt-2">NIP: {{ $vp->nip }}</p>
                        @endif
                        <p class="text-xs text-ink-muted mt-3 leading-relaxed">{{ $vp->bio }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Sarana & Prasarana --}}
    <section class="py-16 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-bold uppercase tracking-widest text-navy">Infrastruktur Kampus</span>
            <h2 class="font-display font-extrabold text-3xl text-ink mt-1 mb-8">Sarana, Bengkel & Laboratorium</h2>

            @php
                $fallbackFacilityImages = [
                    '/images/showcase/lab_fiber.jpg',
                    '/images/showcase/ukk_2026.jpg',
                    '/images/showcase/daikin_coe.jpg',
                    '/images/showcase/lapangan_upacara.jpg',
                    '/images/showcase/drone_kampus.jpg',
                    '/images/showcase/pengalaman_belajar.jpg',
                ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($facilities as $facility)
                    <div class="rounded-2xl bg-paper-2/70 border border-line overflow-hidden flex flex-col justify-between">
                        <div class="aspect-video bg-navy overflow-hidden border-b border-line">
                            <img src="{{ $facility->photo ?: $fallbackFacilityImages[$loop->index % count($fallbackFacilityImages)] }}" alt="{{ $facility->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-widest text-navy">{{ $facility->category }}</span>
                                <h3 class="font-display font-bold text-lg text-ink mt-1">{{ $facility->name }}</h3>
                                <p class="text-sm text-ink-muted mt-2 leading-relaxed">{{ $facility->description }}</p>
                            </div>
                            @if($facility->capacity)
                                <div class="mt-4 pt-3 border-t border-line text-xs font-bold text-ink">
                                    Kapasitas Operasional: {{ $facility->capacity }} Peserta Didik
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
