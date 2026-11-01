@extends('layouts.panel')

@section('title', Auth::user()->isAdmin() ? 'Manajemen Pengguna' : 'Verifikasi Siswa')
@section('page-title', Auth::user()->isAdmin() ? 'Manajemen Pengguna Sistem' : 'Verifikasi Pendaftaran Siswa')

@section('header-actions')
    @if(Auth::user()->isAdmin())
        <a href="{{ route('panel.users.create-guru') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah Akun Guru</span>
        </a>
    @endif
@endsection

@section('content')
<div class="space-y-6">
    <!-- Pending Student Notice Banner -->
    @if($pendingCount > 0)
        <div class="rounded-xl bg-amber-50 border border-amber-300 p-4 text-xs text-amber-900 shadow-xs flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="w-8 h-8 rounded-lg bg-amber-500 text-slate-950 font-bold flex items-center justify-center text-sm flex-shrink-0">
                    {{ $pendingCount }}
                </span>
                <div>
                    <div class="font-bold text-sm text-amber-950">Pendaftaran Siswa Menunggu Aktivasi</div>
                    <div class="text-amber-800">Terdapat {{ $pendingCount }} akun siswa baru yang membutuhkan persetujuan sebelum dapat masuk ke sistem.</div>
                </div>
            </div>
            <a href="{{ route('panel.users.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-lg bg-amber-600 text-white font-bold text-xs hover:bg-amber-700">
                Saring Menunggu Saja
            </a>
        </div>
    @endif

    <!-- Filter Bar -->
    <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-xs">
        <form method="GET" action="{{ route('panel.users.index') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
            <div class="sm:col-span-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, username, NIS, atau email..." class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
            </div>

            @if(Auth::user()->isAdmin())
                <div>
                    <select name="role" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-slate-700">
                        <option value="">Semua Peran</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="guru" {{ request('role') === 'guru' ? 'selected' : '' }}>Guru / Pendidik</option>
                        <option value="siswa" {{ request('role') === 'siswa' ? 'selected' : '' }}>Siswa</option>
                    </select>
                </div>
            @endif

            <div>
                <select name="status" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-slate-700">
                    <option value="">Semua Status</option>
                    @foreach(\App\Enums\UserStatus::cases() as $st)
                        <option value="{{ $st->value }}" {{ request('status') === $st->value ? 'selected' : '' }}>{{ $st->label() }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2 {{ Auth::user()->isAdmin() ? 'sm:col-span-4 justify-end' : '' }}">
                <button type="submit" class="px-5 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-lg transition-colors">
                    Saring Pengguna
                </button>
                @if(request()->hasAny(['q', 'role', 'status']))
                    <a href="{{ route('panel.users.index') }}" class="p-2 text-slate-500 hover:text-slate-800 rounded-lg hover:bg-slate-100" title="Reset">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-600 uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Nama & Akun</th>
                        <th class="py-3 px-4">Peran</th>
                        <th class="py-3 px-4">Kejuruan</th>
                        <th class="py-3 px-4">Status Akun</th>
                        <th class="py-3 px-4">Login Terakhir</th>
                        <th class="py-3 px-4 text-right">Aksi & Keputusan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $u)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="font-bold text-slate-900">{{ $u->name }}</div>
                                <div class="text-xs text-slate-500 font-mono">
                                    {{ $u->username }} &bull; {{ $u->email }}
                                </div>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $u->isAdmin() ? 'bg-rose-100 text-rose-800 border border-rose-200' : ($u->isGuru() ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-emerald-100 text-emerald-800 border border-emerald-200') }}">
                                    {{ $u->role_label }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                @if($u->major)
                                    <span class="text-xs font-semibold text-slate-800">{{ $u->major->name }}</span>
                                @else
                                    <span class="text-xs text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-bold {{ $u->status->badgeColor() }}">
                                    {{ $u->status->label() }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap text-xs text-slate-500">
                                {{ $u->last_login_at ? $u->last_login_at->diffForHumans() : 'Belum pernah' }}
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap space-x-1">
                                <!-- Student activation decision for Guru or Admin -->
                                @if($u->isSiswa() && $u->isPending())
                                    <form method="POST" action="{{ route('panel.users.activate', $u) }}" class="inline-block" onsubmit="return confirm('Aktifkan akun siswa {{ $u->name }}?')">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 rounded bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors">
                                            Aktifkan
                                        </button>
                                    </form>

                                    <!-- Reject Student Modal/Form toggle -->
                                    <button type="button" onclick="document.getElementById('reject-student-modal-{{ $u->id }}').classList.remove('hidden')" class="px-2.5 py-1 rounded bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-bold transition-colors">
                                        Tolak
                                    </button>

                                    <!-- Modal Reject Student -->
                                    <div id="reject-student-modal-{{ $u->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 p-4 text-left">
                                        <div class="bg-white rounded-xl max-w-md w-full p-6 shadow-xl space-y-4">
                                            <h4 class="font-bold text-slate-900 text-base">Tolak Pendaftaran Siswa</h4>
                                            <p class="text-xs text-slate-600">Berikan alasan penolakan untuk siswa <strong class="text-slate-900">{{ $u->name }}</strong> (NIS: {{ $u->username }}):</p>
                                            <form method="POST" action="{{ route('panel.users.reject', $u) }}">
                                                @csrf
                                                <textarea name="reason" rows="3" required placeholder="Contoh: NIS tidak terdaftar pada buku induk jurusan..." class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 mb-4"></textarea>
                                                <div class="flex justify-end gap-2">
                                                    <button type="button" onclick="document.getElementById('reject-student-modal-{{ $u->id }}').classList.add('hidden')" class="px-3 py-1.5 text-xs text-slate-600">Batal</button>
                                                    <button type="submit" class="px-4 py-1.5 rounded-lg bg-rose-600 text-white text-xs font-bold hover:bg-rose-700">Kirim Penolakan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif

                                @if(Auth::user()->isAdmin() && $u->id !== Auth::user()->id)
                                    <!-- Toggle Active / Suspended -->
                                    <form method="POST" action="{{ route('panel.users.toggle-status', $u) }}" class="inline-block" onsubmit="return confirm('Ubah status akun {{ $u->name }}?')">
                                        @csrf
                                        <button type="submit" class="p-1.5 text-slate-500 hover:text-slate-900 rounded-lg hover:bg-slate-100 text-xs font-semibold" title="Ubah Status">
                                            {{ $u->status === \App\Enums\UserStatus::Active ? 'Suspend' : 'Aktifkan' }}
                                        </button>
                                    </form>

                                    <!-- Delete User -->
                                    <form method="POST" action="{{ route('panel.users.destroy', $u) }}" class="inline-block" onsubmit="return confirm('Hapus permanen akun {{ $u->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-rose-50" title="Hapus Pengguna">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-slate-400">
                                Tidak ada data pengguna yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
