@extends('layouts.app', ['title' => 'Panel Administrator'])

@section('content')
<div class="min-h-screen bg-paper flex">
    {{-- Sidebar Admin --}}
    <aside class="w-64 bg-navy text-white flex flex-col border-r border-navy-700 shrink-0">
        <div class="p-6 border-b border-navy-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-yellow-skensa text-navy font-display font-black flex items-center justify-center text-lg">
                    S1D
                </div>
                <div>
                    <h2 class="font-display font-bold text-base leading-tight">Admin Skensa</h2>
                    <p class="text-xs text-white/60">Kendali Terpadu</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 text-sm font-medium">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-xl bg-navy-700 text-yellow-skensa border border-white/10">
                Dashboard Ringkasan
            </a>
            <div class="pt-4 pb-1 px-3 text-[10px] font-semibold tracking-wider text-white/40 uppercase">
                Konten Portofolio Publik
            </div>
            <a href="{{ route('admin.content', ['tab' => 'posts']) }}" class="flex items-center px-3 py-2 rounded-xl text-white/80 hover:bg-navy-700 hover:text-white transition-colors">
                Berita & Pengumuman
            </a>
            <a href="{{ route('admin.content', ['tab' => 'works']) }}" class="flex items-center px-3 py-2 rounded-xl text-white/80 hover:bg-navy-700 hover:text-white transition-colors">
                Showcase Karya Siswa
            </a>
            <a href="{{ route('admin.content', ['tab' => 'achievements']) }}" class="flex items-center px-3 py-2 rounded-xl text-white/80 hover:bg-navy-700 hover:text-white transition-colors">
                Prestasi & Penghargaan
            </a>
            <a href="{{ route('admin.content', ['tab' => 'messages']) }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-white/80 hover:bg-navy-700 hover:text-white transition-colors">
                <span>Kotak Masuk Humas</span>
                @if($stats['unread_messages'] > 0)
                    <span class="px-2 py-0.5 rounded bg-yellow-skensa text-ink text-xs font-extrabold">{{ $stats['unread_messages'] }}</span>
                @endif
            </a>
            <a href="{{ route('admin.content', ['tab' => 'settings']) }}" class="flex items-center px-3 py-2 rounded-xl text-white/80 hover:bg-navy-700 hover:text-white transition-colors">
                Pengaturan Situs
            </a>
        </nav>

        <div class="p-4 border-t border-navy-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-xl text-xs text-white/70 hover:bg-alert-skensa hover:text-white transition-colors font-medium cursor-pointer">
                    Keluar Sesi
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8 overflow-y-auto">
        <header class="flex justify-between items-center mb-8 pb-4 border-b border-line">
            <div>
                <h1 class="text-2xl font-bold font-display text-navy">Ringkasan Sistem Skensa Jaya</h1>
                <p class="text-xs text-ink-muted mt-0.5">Status infrastruktur data, kelas, dan konten portofolio aktif</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.content') }}" class="px-3.5 py-1.5 rounded-lg bg-navy text-paper text-xs font-semibold hover:bg-navy-700 transition-colors">
                    Kelola Konten Portofolio
                </a>
                <a href="/" target="_blank" class="px-3.5 py-1.5 rounded-lg border border-line bg-white hover:bg-paper-2 text-xs font-semibold text-navy transition-colors">
                    Lihat Web Publik &rarr;
                </a>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                    Fase 2 Aktif
                </span>
            </div>
        </header>

        {{-- Kartu Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="p-5 rounded-2xl bg-white border border-line">
                <div class="text-xs font-medium text-ink-muted">Total Konsentrasi Keahlian</div>
                <div class="mt-2 text-3xl font-display font-bold text-navy">{{ $stats['total_majors'] }}</div>
                <div class="text-[11px] text-ink-muted mt-1">9 Bidang Keahlian</div>
            </div>
            <div class="p-5 rounded-2xl bg-white border border-line">
                <div class="text-xs font-medium text-ink-muted">Rombel / Kelas Aktif</div>
                <div class="mt-2 text-3xl font-display font-bold text-navy">{{ $stats['total_classrooms'] }}</div>
                <div class="text-[11px] text-ink-muted mt-1">Tingkat X, XI, XII</div>
            </div>
            <div class="p-5 rounded-2xl bg-white border border-line">
                <div class="text-xs font-medium text-ink-muted">Publikasi & Karya Siswa</div>
                <div class="mt-2 text-3xl font-display font-bold text-navy">{{ $stats['total_posts'] + $stats['total_works'] }}</div>
                <div class="text-[11px] text-ink-muted mt-1">{{ $stats['total_posts'] }} Berita • {{ $stats['total_works'] }} Karya</div>
            </div>
            <div class="p-5 rounded-2xl bg-white border border-line">
                <div class="text-xs font-medium text-ink-muted">Pesan Humas Belum Dibaca</div>
                <div class="mt-2 text-3xl font-display font-bold text-navy">{{ $stats['unread_messages'] }}</div>
                <div class="text-[11px] text-ink-muted mt-1">Formulir Kontak Publik</div>
            </div>
        </div>

        {{-- Tabel 13 Konsentrasi Keahlian --}}
        <div class="bg-white rounded-2xl border border-line overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-line bg-paper-2/50 flex justify-between items-center">
                <h3 class="font-display font-bold text-navy text-sm">Daftar 13 Konsentrasi Keahlian (Data Master)</h3>
                <span class="text-xs text-ink-muted">Terdaftar dalam kurikulum operasional sekolah</span>
            </div>
            <div class="divide-y divide-line">
                @foreach($majors as $m)
                    <div class="px-6 py-3.5 flex items-center justify-between hover:bg-paper/50 transition-colors">
                        <div class="flex items-center space-x-3.5">
                            <span class="w-14 text-center py-1 rounded-md bg-paper-2 font-display font-extrabold text-xs text-navy border border-line">
                                {{ $m->code }}
                            </span>
                            <div>
                                <div class="font-semibold text-sm text-ink">{{ $m->name }}</div>
                                <div class="text-xs text-ink-muted">{{ $m->field?->name }} &bull; Kaprodi: {{ $m->head_of_major ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('majors.show', $m->slug) }}" target="_blank" class="text-xs font-bold text-navy hover:underline">Lihat Halaman</a>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-paper-2 text-navy border border-line">
                                {{ $m->classrooms_count }} Rombel
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</div>
@endsection
