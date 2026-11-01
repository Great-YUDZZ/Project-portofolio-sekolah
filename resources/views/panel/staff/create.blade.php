@extends('layouts.panel')

@section('title', 'Tambah Data Staf')
@section('page-title', 'Tambah Staf Baru')

@section('header-actions')
    <a href="{{ route('panel.staff.index') }}" class="px-3 py-1.5 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-100 text-xs font-semibold transition-colors">
        &larr; Kembali ke Daftar
    </a>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <form method="POST" action="{{ route('panel.staff.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-xl border border-slate-200 shadow-xs p-6 space-y-4">
            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Nama Lengkap Beserta Gelar <span class="text-rose-600">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: I Wayan Sudarta, S.Pd., M.Kom." class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
            </div>

            <div>
                <label for="role_title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Jabatan / Peran <span class="text-rose-600">*</span>
                </label>
                <input type="text" id="role_title" name="role_title" value="{{ old('role_title') }}" required placeholder="Contoh: Kepala Program Keahlian RPL / Guru Produktif" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="department" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Departemen / Kelompok
                    </label>
                    <input type="text" id="department" name="department" value="{{ old('department', 'Pendidik') }}" placeholder="Pendidik / Tenaga Kependidikan" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
                </div>

                <div>
                    <label for="order_index" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Nomor Urutan Tampil
                    </label>
                    <input type="number" id="order_index" name="order_index" value="{{ old('order_index', 0) }}" min="0" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
                </div>
            </div>

            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Alamat Email Resmi (Opsional)
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama.guru@smkn1denpasar.sch.id" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Foto Profil (Maks. 5 MB)
                </label>
                <input type="file" name="photo" accept="image/jpeg,image/png,image/webp" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100 cursor-pointer border border-slate-300 rounded-lg p-1" />
                <p class="text-[11px] text-slate-500 mt-1">Otomatis dioptimasi ke format WebP bebas metadata lokasi.</p>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('panel.staff.index') }}" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-900 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold shadow-sm transition-colors">
                Simpan Data Staf
            </button>
        </div>
    </form>
</div>
@endsection
