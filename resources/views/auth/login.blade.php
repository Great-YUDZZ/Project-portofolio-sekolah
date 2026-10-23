@extends('layouts.app', ['title' => 'Masuk ke Portal'])

@section('content')
<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-paper">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        {{-- Emblem Logo --}}
        <div class="mx-auto w-16 h-16 rounded-2xl bg-navy text-white flex items-center justify-center font-display font-extrabold text-2xl shadow-sm border border-navy-700">
            S1D
        </div>
        <h2 class="mt-4 text-2xl font-bold tracking-tight text-navy font-display">
            SMK Negeri 1 Denpasar
        </h2>
        <p class="mt-1 text-xs text-ink-muted italic">
            Abhyāsad Dhäryate Vidyä : Peliharalah ilmu sampai menjadi tradisi
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
        <div class="bg-white py-8 px-6 shadow-sm rounded-2xl border border-line sm:px-10">
            <div class="mb-6 pb-4 border-b border-line flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-ink text-base">Gerbang Masuk Akun</h3>
                    <p class="text-xs text-ink-muted">Gunakan NIS (Siswa), NIP (Guru), atau Username Admin</p>
                </div>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-paper-2 text-navy border border-line">
                    Terpadu
                </span>
            </div>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="username" class="block text-xs font-semibold text-ink uppercase tracking-wider">
                        NIS / NIP / Username
                    </label>
                    <div class="mt-1.5">
                        <input id="username" name="username" type="text" autocomplete="username" required
                               value="{{ old('username') }}"
                               placeholder="Contoh: 22001 atau admin"
                               class="block w-full rounded-xl border border-line bg-paper px-3.5 py-2.5 text-sm text-ink placeholder-ink-muted/50 focus:border-navy focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy transition-all @error('username') border-alert-skensa @enderror">
                    </div>
                    @error('username')
                        <p class="mt-1.5 text-xs text-alert-skensa font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-semibold text-ink uppercase tracking-wider">
                            Kata Sandi
                        </label>
                    </div>
                    <div class="mt-1.5">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               placeholder="Masukkan kata sandi"
                               class="block w-full rounded-xl border border-line bg-paper px-3.5 py-2.5 text-sm text-ink placeholder-ink-muted/50 focus:border-navy focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy transition-all @error('password') border-alert-skensa @enderror">
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-alert-skensa font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-line text-navy focus:ring-navy">
                        <span class="ml-2 text-xs text-ink-muted">Ingat sesi saya</span>
                    </label>
                    <span class="text-xs text-ink-muted">Bantuan akun hubungi staf IT</span>
                </div>

                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-navy hover:bg-navy-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-navy transition-all">
                        Masuk ke Sistem
                    </button>
                </div>
            </form>

            {{-- Pintasan Akun Uji Coba --}}
            <div class="mt-8 pt-6 border-t border-line">
                <p class="text-xs font-semibold text-ink-muted uppercase tracking-wider mb-2.5 text-center">
                    Pintasan Akun Uji Coba (Klik untuk mengisi)
                </p>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" onclick="fillCreds('admin', 'admin123')"
                            class="text-xs py-1.5 px-2 rounded-lg bg-paper-2 hover:bg-line text-navy font-medium border border-line transition-colors">
                        Admin
                    </button>
                    <button type="button" onclick="fillCreds('guru_rpl', 'guru123')"
                            class="text-xs py-1.5 px-2 rounded-lg bg-paper-2 hover:bg-line text-navy font-medium border border-line transition-colors">
                        Guru RPL
                    </button>
                    <button type="button" onclick="fillCreds('22001', 'siswa123')"
                            class="text-xs py-1.5 px-2 rounded-lg bg-paper-2 hover:bg-line text-navy font-medium border border-line transition-colors">
                        Siswa (Rama)
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="/" class="text-xs text-ink-muted hover:text-navy transition-colors font-medium">
                &larr; Kembali ke Halaman Utama Portofolio Sekolah
            </a>
        </div>
    </div>
</div>

<script>
    function fillCreds(username, password) {
        document.getElementById('username').value = username;
        document.getElementById('password').value = password;
    }
</script>
@endsection
