@extends('layouts.public')

@section('title', 'Direktori Manajemen, Pendidik & Tenaga Kependidikan - SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block px-3 py-1 rounded bg-[#EAEDFF] text-[#2B4EFF] text-xs font-extrabold uppercase tracking-widest">
                Sumber Daya Manusia SKENSA
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3">Manajemen, Pendidik & Tendik</h1>
            <p class="text-paper/80 text-base max-w-2xl mt-2">
                Struktur kepemimpinan sekolah, Ketua Program Keahlian 12 jurusan, pendidik kejuruan, serta tenaga administrasi SMK Negeri 1 Denpasar.
            </p>
        </div>
    </section>

    <section class="py-12 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Filter & Search Bar --}}
            <form method="GET" action="{{ route('staff.index') }}" class="p-5 rounded-2xl bg-paper-2 border border-line mb-10 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-2">
                    @php
                        $groups = [
                            '' => 'Semua SDM',
                            'kepsek' => 'Kepala Sekolah',
                            'wakasek' => 'Wakil Kepala Sekolah',
                            'kasubag' => 'Kasubag TU',
                            'kaprog' => 'Kaprodi Jurusan',
                            'guru' => 'Pendidik',
                            'tendik' => 'Tenaga Kependidikan',
                        ];
                    @endphp
                    @foreach($groups as $key => $label)
                        <a
                            href="{{ route('staff.index', array_filter(['group' => $key ?: null, 'q' => $search ?: null])) }}"
                            class="px-3.5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors {{ ($group ?? '') === $key ? 'bg-navy text-paper' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                        >
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                <div class="flex items-center gap-2">
                    <input
                        type="search"
                        name="q"
                        value="{{ $search }}"
                        placeholder="Cari nama atau jabatan..."
                        class="px-3.5 py-2 rounded-lg bg-paper border border-line text-sm text-ink focus:outline-none focus:border-navy w-full md:w-64"
                    >
                    @if($group)
                        <input type="hidden" name="group" value="{{ $group }}">
                    @endif
                    <button type="submit" class="px-4 py-2 rounded-lg bg-[#2B4EFF] text-white hover:bg-[#1E3FE0] text-xs font-extrabold uppercase tracking-wider cursor-pointer transition-colors shadow-sm">
                        Filter
                    </button>
                </div>
            </form>

            {{-- Empty State Boundary --}}
            @if($staffMembers->isEmpty())
                <div class="p-12 rounded-2xl bg-paper-2 border border-line text-center">
                    <h2 class="font-display font-bold text-xl text-ink">Data SDM Tidak Ditemukan</h2>
                    <p class="text-sm text-ink-muted mt-1">Tidak ada personel yang cocok dengan kata kunci atau filter jabatan yang dipilih.</p>
                    <a href="{{ route('staff.index') }}" class="inline-block mt-4 px-4 py-2 rounded-lg bg-navy text-paper text-xs font-bold uppercase tracking-wider">
                        Reset Filter SDM
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($staffMembers as $person)
                        <article class="p-6 rounded-2xl bg-paper-2/60 border border-line flex flex-col justify-between hover:border-navy transition-colors">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="px-2.5 py-0.5 rounded bg-[#EAEDFF] text-[#2B4EFF] text-[11px] font-bold uppercase tracking-wider">
                                        {{ strtoupper($person->group) }}
                                    </span>
                                    @if($person->department)
                                        <span class="text-xs font-semibold text-ink-muted">{{ $person->department }}</span>
                                    @endif
                                </div>

                                <h2 class="font-display font-bold text-lg text-ink">{{ $person->name }}</h2>
                                <p class="text-xs font-bold text-navy mt-1">{{ $person->position }}</p>
                                @if($person->nip)
                                    <p class="text-xs text-ink-muted font-mono mt-1">NIP: {{ $person->nip }}</p>
                                @endif
                                @if($person->bio)
                                    <p class="text-sm text-ink-muted mt-3 leading-relaxed">{{ $person->bio }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

@endsection
