@extends('layouts.panel')

@section('title', 'Tambah Akun Guru')
@section('page-title', 'Tambah Akun Guru / Pendidik')

@section('header-actions')
    <a href="{{ route('panel.users.index') }}" class="px-3 py-1.5 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-100 text-xs font-semibold transition-colors">
        &larr; Kembali ke Daftar
    </a>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <form method="POST" action="{{ route('panel.users.store-guru') }}" class="space-y-6">
        @csrf

        <div class="bg-white rounded-xl border border-slate-200 shadow-xs p-6 space-y-4">
            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Nama Lengkap Guru <span class="text-rose-600">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: I Ketut Suardana, S.T., M.Cs." class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="username" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Username / NIP <span class="text-rose-600">*</span>
                    </label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required placeholder="guru_rpl2" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
                </div>

                <div>
                    <label for="nip" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        NIP Resmi
                    </label>
                    <input type="text" id="nip" name="nip" value="{{ old('nip') }}" placeholder="19850101 201001 1 005" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
                </div>
            </div>

            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Alamat Email <span class="text-rose-600">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama.guru@smkn1denpasar.sch.id" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
            </div>

            <div>
                <label for="major_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Penugasan Kejuruan <span class="text-rose-600">*</span>
                </label>
                <select id="major_id" name="major_id" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-slate-800">
                    <option value="">Pilih Program Keahlian...</option>
                    @foreach($majors as $m)
                        <option value="{{ $m->id }}" {{ old('major_id') == $m->id ? 'selected' : '' }}>{{ $m->name }} ({{ $m->code }})</option>
                    @endforeach
                </select>
                <p class="text-[11px] text-slate-500 mt-1">Guru kejuruan memiliki wewenang untuk meninjau naskah berita siswa di jurusan ini serta mengaktivasi pendaftaran siswa.</p>
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Kata Sandi Akun <span class="text-rose-600">*</span>
                </label>
                <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter huruf & angka" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('panel.users.index') }}" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-900 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold shadow-sm transition-colors">
                Buat Akun Guru
            </button>
        </div>
    </form>
</div>
@endsection
