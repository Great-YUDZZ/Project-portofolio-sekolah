@extends('layouts.public')

@section('title', '404 Halaman Tidak Ditemukan - SMK Negeri 1 Denpasar')

@section('content')
    <section class="py-24 bg-paper">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="p-10 sm:p-14 rounded-3xl bg-paper-2 border-2 border-ink">
                <span class="inline-block px-3.5 py-1 rounded bg-navy text-yellow-skensa text-xs font-extrabold uppercase tracking-widest">
                    Kode Galat 404 • Rute Tidak Ditemukan
                </span>
                <h1 class="font-display font-extrabold text-5xl sm:text-6xl text-ink mt-4">404</h1>
                <h2 class="font-display font-bold text-2xl text-navy mt-2">Halaman yang Anda Tuju Tidak Tersedia</h2>
                <p class="text-sm sm:text-base text-ink-muted mt-3 leading-relaxed">
                    Tautan yang Anda akses mungkin telah dipindahkan, diubah alamatnya, atau tidak terdaftar dalam arsip direktori SMK Negeri 1 Denpasar.
                </p>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-navy text-paper font-bold text-xs uppercase tracking-wider hover:bg-navy-700">
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('majors.index') }}" class="px-6 py-3 rounded-xl bg-yellow-skensa text-ink font-extrabold text-xs uppercase tracking-wider">
                        Jelajahi 13 Jurusan
                    </a>
                    <a href="{{ route('search.index') }}" class="px-6 py-3 rounded-xl border border-line bg-paper text-ink font-bold text-xs uppercase tracking-wider hover:border-navy">
                        Pencarian Global
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
