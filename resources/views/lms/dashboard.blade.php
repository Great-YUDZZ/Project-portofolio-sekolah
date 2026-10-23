@extends('layouts.app', ['title' => 'LMS Skensa'])

@section('content')
<div class="min-h-screen bg-paper flex flex-col">
    {{-- Header LMS --}}
    <header class="bg-navy text-white px-6 py-4 border-b border-navy-700 flex justify-between items-center sticky top-0 z-40">
        <div class="flex items-center space-x-4">
            <a href="/" class="w-9 h-9 rounded-xl bg-yellow-skensa text-navy font-display font-extrabold flex items-center justify-center text-sm shadow-sm">
                S1D
            </a>
            <div>
                <div class="flex items-center space-x-2">
                    <span class="font-display font-bold text-base tracking-tight">LMS Skensa</span>
                    <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-white/10 text-yellow-skensa border border-white/10">
                        {{ $user->role->label() }}
                    </span>
                </div>
                <p class="text-[11px] text-white/60">SMK Negeri 1 Denpasar</p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <div class="text-right hidden sm:block">
                <div class="text-xs font-semibold text-white">{{ $user->name }}</div>
                <div class="text-[10px] text-white/60">{{ $user->username }}</div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs px-3 py-1.5 rounded-lg bg-white/10 hover:bg-alert-skensa text-white font-medium transition-colors">
                    Keluar
                </button>
            </form>
        </div>
    </header>

    {{-- Body LMS --}}
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Banner Sapaan --}}
        <div class="rounded-2xl bg-white border border-line p-6 mb-8 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold font-display text-navy">
                    Selamat datang, {{ $user->name }}
                </h1>
                <p class="text-xs text-ink-muted mt-1">
                    Anda berhasil masuk ke portal pembelajaran digital SMK Negeri 1 Denpasar sebagai <span class="font-semibold text-navy">{{ $user->role->label() }}</span>.
                </p>
            </div>
            <div class="inline-flex items-center px-3 py-1.5 rounded-xl bg-paper-2 text-xs font-semibold text-navy border border-line">
                Infrastruktur Fase 1 Siap
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Kolom Kiri: Notifikasi Alur Pembelajaran --}}
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-line p-6 shadow-sm">
                    <h3 class="font-display font-bold text-navy text-sm mb-2">Status Kursus & Pembelajaran</h3>
                    <p class="text-xs text-ink-muted mb-4">
                        Modul materi pembelajaran, pengumpulan tugas, kuis online interaktif, dan rekap buku nilai otomatis akan diaktifkan secara lengkap pada <span class="font-semibold text-navy">Fase 3 & Fase 4</span>.
                    </p>

                    <div class="p-4 rounded-xl bg-paper border border-line space-y-2">
                        <div class="text-xs font-semibold text-navy">Pilar Nilai Karakter Belajar SKENSA:</div>
                        <ul class="text-xs text-ink-muted space-y-1 list-disc list-inside">
                            <li><strong class="text-ink">Siap:</strong> Menghadapi tantangan akademik dan praktik kejuruan.</li>
                            <li><strong class="text-ink">Kompeten:</strong> Menguasai keterampilan kejuruan sesuai standar dunia kerja.</li>
                            <li><strong class="text-ink">Disiplin:</strong> Tepat waktu dalam kehadiran dan pengumpulan tugas.</li>
                            <li><strong class="text-ink">Beretika:</strong> Berperilaku santun dan menjunjung tinggi kejujuran ilmiah.</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Informasi Akun --}}
            <div class="space-y-6">
                <div class="bg-white rounded-2xl border border-line p-6 shadow-sm">
                    <h3 class="font-display font-bold text-navy text-sm mb-3">Profil Pengguna</h3>
                    <div class="space-y-2.5 text-xs">
                        <div class="flex justify-between py-1.5 border-b border-line">
                            <span class="text-ink-muted">Nama Lengkap</span>
                            <span class="font-semibold text-ink">{{ $user->name }}</span>
                        </div>
                        <div class="flex justify-between py-1.5 border-b border-line">
                            <span class="text-ink-muted">ID / Username</span>
                            <span class="font-semibold text-ink">{{ $user->username }}</span>
                        </div>
                        <div class="flex justify-between py-1.5 border-b border-line">
                            <span class="text-ink-muted">Peran</span>
                            <span class="font-semibold text-navy">{{ $user->role->label() }}</span>
                        </div>
                        <div class="flex justify-between py-1.5 border-b border-line">
                            <span class="text-ink-muted">Email</span>
                            <span class="font-semibold text-ink">{{ $user->email ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-paper-2 rounded-2xl border border-line p-5 text-center">
                    <a href="/" class="text-xs font-semibold text-navy hover:underline">
                        &larr; Buka Website Portofolio Sekolah
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
