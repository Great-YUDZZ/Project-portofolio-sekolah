@extends('layouts.public')

@section('title', '9 Program & 12 Konsentrasi Keahlian - SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block px-3 py-1 rounded-md bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-widest">
                Struktur Akademik Resmi SKENSA
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3">9 Program &amp; 12 Konsentrasi Keahlian</h1>
            <p class="text-paper/85 text-base max-w-3xl mt-2.5 leading-relaxed">
                Katalog resmi program dan konsentrasi keahlian SMK Negeri 1 Denpasar sesuai struktur akademik sekolah.
            </p>
        </div>
    </section>

    <section class="py-12 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Filter Bidang Keahlian --}}
            <div class="p-5 rounded-2xl bg-paper-2 border border-line mb-10">
                <div class="text-xs font-bold uppercase tracking-widest text-navy mb-3">Filter Berdasarkan Program Keahlian (9 Program):</div>
                <div class="flex flex-wrap gap-2">
                    <a
                        href="{{ route('majors.index') }}"
                        class="px-3.5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-navy tabular-nums {{ !$fieldSlug ? 'bg-navy text-paper' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                    >
                        Semua Jurusan (12)
                    </a>
                    @foreach($fields as $field)
                        <a
                            href="{{ route('majors.index', ['bidang' => $field->slug]) }}"
                            class="px-3.5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-navy tabular-nums {{ $fieldSlug === $field->slug ? 'bg-navy text-paper' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                        >
                            {{ $field->name }} ({{ $field->majors_count }})
                        </a>
                    @endforeach
                </div>
            </div>

            @if($majors->isEmpty())
                <div class="p-12 rounded-2xl bg-paper-2 border border-line text-center">
                    <h2 class="font-display font-bold text-xl text-ink">Konsentrasi Keahlian Tidak Ditemukan</h2>
                    <a href="{{ route('majors.index') }}" class="inline-block mt-4 px-4 py-2 rounded-xl bg-navy text-paper text-xs font-bold uppercase">Tampilkan Semua</a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($majors as $index => $major)
                        <article class="rounded-2xl bg-paper border-2 border-ink p-6 flex flex-col justify-between hover:border-navy transition-colors group">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-4 pb-3 border-b border-line">
                                    <div class="flex items-center gap-2">
                                        <span class="px-3 py-1 rounded-lg bg-navy text-yellow-skensa text-xs font-extrabold uppercase tracking-wider">
                                            {{ $major->code }}
                                        </span>
                                        <span class="text-xs font-bold text-ink-muted tabular-nums">
                                            #{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </div>
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-navy bg-paper-2 px-2.5 py-1 rounded-md border border-line text-right truncate max-w-[190px]">
                                        {{ $major->field?->name }}
                                    </span>
                                </div>

                                <h2 class="font-display font-extrabold text-xl text-ink group-hover:text-navy transition-colors leading-snug">
                                    <a href="{{ route('majors.show', $major->slug) }}" class="focus-visible:outline-none focus-visible:underline">{{ $major->name }}</a>
                                </h2>

                                <p class="text-sm text-ink-muted mt-3 leading-relaxed">
                                    {{ $major->summary }}
                                </p>

                                @if(!empty($major->career_prospects))
                                    <div class="mt-4 pt-4 border-t border-line">
                                        <span class="block text-[10px] font-bold uppercase tracking-widest text-ink-muted mb-2">Prospek Karir Utama:</span>
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach(array_slice((array) $major->career_prospects, 0, 3) as $career)
                                                <span class="text-xs px-2.5 py-0.5 rounded-md bg-paper-2 border border-line text-ink font-medium">{{ $career }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-6 pt-4 border-t border-line">
                                <a href="{{ route('majors.show', $major->slug) }}" class="flex items-center justify-between w-full px-4 py-2.5 rounded-xl bg-navy text-paper group-hover:bg-yellow-skensa group-hover:text-ink text-xs font-bold uppercase tracking-wider transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-navy">
                                    <span>Lihat Detail &amp; Kurikulum</span>
                                    <span aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

@endsection
