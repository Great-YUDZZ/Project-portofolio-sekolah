@extends('layouts.public')

@section('title', '9 Bidang & 13 Konsentrasi Keahlian - SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block px-3 py-1 rounded bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-widest">
                Kurikulum Nasional & Industri
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3">9 Bidang & 13 Konsentrasi Keahlian</h1>
            <p class="text-paper/80 text-base max-w-3xl mt-2">
                Seluruh konsentrasi keahlian di SMK Negeri 1 Denpasar dilengkapi bengkel standar industri, sertifikasi LSP-P1, dan kemitraan praktek kerja lapangan.
            </p>
        </div>
    </section>

    <section class="py-12 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Filter Bidang Keahlian --}}
            <div class="p-5 rounded-2xl bg-paper-2 border border-line mb-10">
                <div class="text-xs font-bold uppercase tracking-widest text-navy mb-3">Filter Berdasarkan Bidang Keahlian (9 Bidang):</div>
                <div class="flex flex-wrap gap-2">
                    <a
                        href="{{ route('majors.index') }}"
                        class="px-3.5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ !$fieldSlug ? 'bg-navy text-paper' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                    >
                        Semua Jurusan (13)
                    </a>
                    @foreach($fields as $field)
                        <a
                            href="{{ route('majors.index', ['bidang' => $field->slug]) }}"
                            class="px-3.5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ $fieldSlug === $field->slug ? 'bg-navy text-paper' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                        >
                            {{ $field->name }} ({{ $field->majors_count }})
                        </a>
                    @endforeach
                </div>
            </div>

            @if($majors->isEmpty())
                <div class="p-12 rounded-2xl bg-paper-2 border border-line text-center">
                    <h2 class="font-display font-bold text-xl text-ink">Konsentrasi Keahlian Tidak Ditemukan</h2>
                    <a href="{{ route('majors.index') }}" class="inline-block mt-4 px-4 py-2 rounded-lg bg-navy text-paper text-xs font-bold uppercase">Tampilkan Semua</a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($majors as $major)
                        <article class="rounded-2xl bg-paper-2/70 border-2 border-ink p-6 flex flex-col justify-between hover:border-navy transition-colors">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-4">
                                    <span class="px-3 py-1 rounded bg-navy text-yellow-skensa text-xs font-extrabold uppercase">
                                        {{ $major->code }}
                                    </span>
                                    <span class="text-xs font-semibold text-ink-muted text-right">
                                        {{ $major->field?->name }}
                                    </span>
                                </div>

                                <h2 class="font-display font-extrabold text-xl text-ink leading-snug">
                                    <a href="{{ route('majors.show', $major->slug) }}" class="hover:text-navy">{{ $major->name }}</a>
                                </h2>

                                <p class="text-sm text-ink-muted mt-3 leading-relaxed">
                                    {{ $major->summary }}
                                </p>

                                @if(!empty($major->career_prospects))
                                    <div class="mt-4 pt-4 border-t border-line">
                                        <span class="block text-[11px] font-bold uppercase tracking-wider text-navy mb-2">Prospek Karir Utama:</span>
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach(array_slice((array) $major->career_prospects, 0, 3) as $career)
                                                <span class="text-xs px-2.5 py-0.5 rounded bg-paper border border-line text-ink font-medium">{{ $career }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-6 pt-4 border-t border-line">
                                <a href="{{ route('majors.show', $major->slug) }}" class="flex items-center justify-between w-full px-4 py-2.5 rounded-xl bg-navy text-paper hover:bg-navy-700 text-xs font-bold uppercase tracking-wider">
                                    <span>Lihat Detail & Kurikulum</span>
                                    <span>&rarr;</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

@endsection
