@extends('layouts.public')

@section('title', 'Direktori Manajemen, Pendidik & Tenaga Kependidikan - SMK Negeri 1 Denpasar')

@section('content')

    {{-- Hero Section --}}
    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-reveal>
            <span class="inline-block px-3 py-1 rounded bg-ink text-white text-xs font-extrabold uppercase tracking-widest">
                Sumber Daya Manusia SKENSA
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3 tracking-tight">Manajemen, Pendidik &amp; Tendik</h1>
            <p class="text-paper/80 text-base max-w-3xl mt-2 leading-relaxed">
                Struktur kepemimpinan sekolah, Ketua Program Keahlian 12 jurusan, pendidik kejuruan tersertifikasi, serta tenaga administrasi profesional SMK Negeri 1 Denpasar.
            </p>

            {{-- Metric Ribbon --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8 pt-8 border-t border-paper/10 text-xs uppercase tracking-wider">
                <div class="p-4 rounded-xl bg-paper/5 border border-paper/10">
                    <span class="block text-2xl font-extrabold font-mono text-white">1</span>
                    <span class="text-paper/70 font-semibold mt-1 block">Kepala Sekolah</span>
                </div>
                <div class="p-4 rounded-xl bg-paper/5 border border-paper/10">
                    <span class="block text-2xl font-extrabold font-mono text-white">5</span>
                    <span class="text-paper/70 font-semibold mt-1 block">Wakil Kepala Sekolah</span>
                </div>
                <div class="p-4 rounded-xl bg-paper/5 border border-paper/10">
                    <span class="block text-2xl font-extrabold font-mono text-white">12</span>
                    <span class="text-paper/70 font-semibold mt-1 block">Ketua Program Keahlian</span>
                </div>
                <div class="p-4 rounded-xl bg-paper/5 border border-paper/10">
                    <span class="block text-2xl font-extrabold font-mono text-white">150+</span>
                    <span class="text-paper/70 font-semibold mt-1 block">Pendidik &amp; Tendik</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content Section --}}
    <section class="py-12 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Filter & Search Form --}}
            <form method="GET" action="{{ route('staff.index') }}" class="p-5 rounded-2xl bg-paper-2 border border-line mb-10 flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4" data-reveal>
                <div class="flex flex-wrap items-center gap-2">
                    @php
                        $filterOptions = [
                            '' => ['label' => 'Semua SDM', 'count' => $stats['total'] ?? 0],
                            'manajemen' => ['label' => 'Manajemen & Pimpinan', 'count' => $stats['manajemen'] ?? 0],
                            'kaprogli' => ['label' => 'Kaprodi Jurusan', 'count' => $stats['kaprogli'] ?? 0],
                            'guru' => ['label' => 'Guru Produktif', 'count' => $stats['guru'] ?? 0],
                            'tendik' => ['label' => 'Tenaga Kependidikan', 'count' => $stats['tendik'] ?? 0],
                        ];
                    @endphp
                    @foreach($filterOptions as $key => $opt)
                        <a
                            href="{{ route('staff.index', array_filter(['group' => $key ?: null, 'q' => $search ?: null])) }}"
                            class="px-3.5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors inline-flex items-center gap-1.5 {{ ($group ?? '') === $key ? 'bg-navy text-paper shadow-sm' : 'bg-paper text-ink border border-line hover:border-navy' }}"
                        >
                            <span>{{ $opt['label'] }}</span>
                            <span class="px-1.5 py-0.5 rounded text-[10px] {{ ($group ?? '') === $key ? 'bg-white/20 text-white' : 'bg-paper-2 text-ink-muted' }}">
                                {{ $opt['count'] }}
                            </span>
                        </a>
                    @endforeach
                </div>

                <div class="flex items-center gap-2">
                    <div class="relative w-full lg:w-72">
                        <input
                            type="search"
                            name="q"
                            value="{{ $search }}"
                            placeholder="Cari nama, jabatan, jurusan..."
                            class="w-full pl-9 pr-3.5 py-2 rounded-lg bg-paper border border-line text-sm text-ink focus:outline-none focus:border-navy"
                        >
                        <svg class="w-4 h-4 text-ink-muted absolute left-3 top-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    @if($group)
                        <input type="hidden" name="group" value="{{ $group }}">
                    @endif
                    <button type="submit" class="px-4 py-2 rounded-lg bg-ink text-white hover:bg-slate-800 text-xs font-extrabold uppercase tracking-wider cursor-pointer transition-colors shadow-sm shrink-0">
                        Filter
                    </button>
                    @if($group || $search)
                        <a href="{{ route('staff.index') }}" class="px-3 py-2 rounded-lg bg-paper border border-line text-xs font-bold text-ink-muted hover:text-ink shrink-0" title="Reset filter">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            {{-- Empty State --}}
            @if($staffMembers->isEmpty())
                <div class="p-12 rounded-2xl bg-paper-2 border border-line text-center max-w-xl mx-auto my-8" data-reveal>
                    <div class="w-12 h-12 rounded-xl bg-navy/10 text-navy mx-auto flex items-center justify-center font-bold text-lg mb-3">
                        ?
                    </div>
                    <h2 class="font-display font-bold text-xl text-ink">Data SDM Tidak Ditemukan</h2>
                    <p class="text-sm text-ink-muted mt-2 leading-relaxed">
                        Tidak ada personel yang sesuai dengan kata kunci pencarian atau kategori jabatan yang Anda pilih.
                    </p>
                    <a href="{{ route('staff.index') }}" class="inline-block mt-5 px-5 py-2.5 rounded-lg bg-navy text-paper text-xs font-bold uppercase tracking-wider hover:bg-navy-700 transition-colors">
                        Reset Semua Filter
                    </a>
                </div>
            @else

                {{-- Group: Manajemen Pimpinan Spotlight (shown when not filtered by other specific group) --}}
                @php
                    $leadership = $staffMembers->filter(function ($item) {
                        return str_contains(strtolower($item->department), 'manajemen') || str_contains(strtolower($item->role_title), 'kepala sekolah');
                    });
                    $otherStaff = $staffMembers->reject(function ($item) {
                        return str_contains(strtolower($item->department), 'manajemen') || str_contains(strtolower($item->role_title), 'kepala sekolah');
                    });
                @endphp

                @if($leadership->isNotEmpty() && ($group === '' || $group === 'manajemen') && empty($search))
                    <div class="mb-12" data-reveal>
                        <div class="flex items-center justify-between mb-6 pb-3 border-b border-line">
                            <div>
                                <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Manajemen &amp; Pimpinan</span>
                                <h2 class="font-display font-extrabold text-2xl text-ink mt-0.5">Kepala Sekolah &amp; Wakil Kepala Sekolah</h2>
                            </div>
                            <span class="text-xs font-bold text-ink-muted uppercase tracking-wider">SKENSA 2024/2025</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-reveal-stagger>
                            @foreach($leadership as $leader)
                                <article class="p-6 rounded-2xl bg-white border-2 border-line hover:border-navy transition-all duration-200 flex flex-col justify-between shadow-xs">
                                    <div>
                                        <div class="flex items-center gap-4 mb-4">
                                            <div class="w-14 h-14 rounded-xl bg-navy text-paper flex items-center justify-center font-display font-extrabold text-xl shrink-0 shadow-xs">
                                                {{ strtoupper(substr($leader->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span class="px-2 py-0.5 rounded bg-ink text-white text-[10px] font-extrabold uppercase tracking-wider">
                                                    {{ $leader->role_title === 'Kepala Sekolah' ? 'Pimpinan Utama' : 'Wakil Pimpinan' }}
                                                </span>
                                                <h3 class="font-display font-extrabold text-base text-ink mt-1 leading-snug">
                                                    {{ $leader->name }}
                                                </h3>
                                            </div>
                                        </div>

                                        <p class="text-xs font-bold text-navy mt-1 border-t border-line pt-2">
                                            {{ $leader->role_title }}
                                        </p>
                                        <p class="text-xs text-ink-muted mt-1">
                                            Divisi: {{ $leader->department }}
                                        </p>
                                    </div>

                                    @if($leader->email)
                                        <div class="mt-5 pt-3 border-t border-line flex items-center justify-between">
                                            <span class="text-[11px] text-ink-muted font-mono">{{ $leader->email }}</span>
                                            <a href="mailto:{{ $leader->email }}" class="text-xs font-bold text-navy hover:underline">
                                                Surel &rarr;
                                            </a>
                                        </div>
                                    @endif
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Remaining Staff Members / All Filtered Staff --}}
                @php
                    $displayStaff = ($group === '' && empty($search)) ? $otherStaff : $staffMembers;
                @endphp

                @if($displayStaff->isNotEmpty())
                    <div data-reveal>
                        @if($group === '' && empty($search))
                            <div class="flex items-center justify-between mb-6 pb-3 border-b border-line">
                                <div>
                                    <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Pendidik &amp; Tenaga Kejuruan</span>
                                    <h2 class="font-display font-extrabold text-2xl text-ink mt-0.5">Ketua Program Keahlian, Guru &amp; Tenaga Kependidikan</h2>
                                </div>
                                <span class="text-xs font-bold text-ink-muted uppercase tracking-wider">{{ $displayStaff->count() }} Personel</span>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-reveal-stagger>
                            @foreach($displayStaff as $person)
                                <article class="p-6 rounded-2xl bg-paper-2/70 border border-line flex flex-col justify-between hover:border-navy hover:bg-paper-2 transition-all duration-200">
                                    <div>
                                        <div class="flex items-center justify-between gap-2 mb-3">
                                            <span class="px-2.5 py-0.5 rounded text-[10px] font-extrabold uppercase tracking-wider {{ str_contains(strtolower($person->role_title), 'ketua program') ? 'bg-amber-600 text-white' : (str_contains(strtolower($person->role_title), 'guru') ? 'bg-navy text-paper' : 'bg-slate-700 text-white') }}">
                                                {{ str_contains(strtolower($person->role_title), 'ketua program') ? 'Kaprogli' : (str_contains(strtolower($person->role_title), 'guru') ? 'Guru Produktif' : 'Tendik') }}
                                            </span>
                                            @if($person->department)
                                                <span class="text-[11px] font-semibold text-ink-muted truncate max-w-[160px]" title="{{ $person->department }}">{{ $person->department }}</span>
                                            @endif
                                        </div>

                                        <div class="flex items-start gap-3.5 mt-2">
                                            <div class="w-11 h-11 rounded-lg bg-paper border border-line text-ink flex items-center justify-center font-display font-bold text-sm shrink-0">
                                                {{ strtoupper(substr($person->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h3 class="font-display font-bold text-base text-ink leading-snug">{{ $person->name }}</h3>
                                                <p class="text-xs font-semibold text-navy mt-1">{{ $person->role_title }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @if($person->email)
                                        <div class="mt-4 pt-3 border-t border-line flex items-center justify-between text-xs">
                                            <span class="text-[11px] text-ink-muted font-mono truncate max-w-[200px]">{{ $person->email }}</span>
                                            <a href="mailto:{{ $person->email }}" class="font-bold text-navy hover:underline shrink-0">
                                                Hubungi
                                            </a>
                                        </div>
                                    @endif
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif

            @endif

        </div>
    </section>

@endsection
