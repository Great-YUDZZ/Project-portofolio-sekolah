@extends('layouts.panel')

@section('title', 'Manajemen Staf & Pendidik')
@section('page-title', 'Tenaga Pendidik & Kependidikan')

@section('header-actions')
    <a href="{{ route('panel.staff.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span>Tambah Staf Baru</span>
    </a>
@endsection

@section('content')
<div class="space-y-5">
    <!-- Filter Bar -->
    <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-xs">
        <form method="GET" action="{{ route('panel.staff.index') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
            <div class="sm:col-span-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama staf, jabatan, atau departemen..." class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
            </div>

            <div>
                <select name="department" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-slate-700">
                    <option value="">Semua Departemen</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept }}" {{ request('department') === $dept ? 'selected' : '' }}>{{ $dept }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="w-full px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-lg transition-colors">
                    Saring
                </button>
                @if(request()->hasAny(['q', 'department']))
                    <a href="{{ route('panel.staff.index') }}" class="p-2 text-slate-500 hover:text-slate-800 rounded-lg hover:bg-slate-100" title="Reset">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Staff Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-600 uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Foto & Nama</th>
                        <th class="py-3 px-4">Jabatan / Peran</th>
                        <th class="py-3 px-4">Departemen</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Urutan</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($staff as $member)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 overflow-hidden flex-shrink-0 flex items-center justify-center font-bold text-xs text-slate-500">
                                        @if($member->photo)
                                            <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover" />
                                        @else
                                            {{ substr($member->name, 0, 2) }}
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900">{{ $member->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap font-medium text-slate-700">
                                {{ $member->role_title }}
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-slate-100 text-slate-800">
                                    {{ $member->department ?: 'Pendidik' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap text-xs text-slate-500 font-mono">
                                {{ $member->email ?: '-' }}
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap text-xs text-slate-500 font-mono">
                                {{ $member->order_index }}
                            </td>
                            <td class="py-3 px-4 text-right whitespace-nowrap space-x-1">
                                <a href="{{ route('panel.staff.edit', $member) }}" class="inline-flex p-1.5 text-slate-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors" title="Edit Staf">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('panel.staff.destroy', $member) }}" class="inline-block" onsubmit="return confirm('Hapus data staf {{ $member->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus Staf">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-slate-400">
                                Tidak ada data staf yang cocok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($staff->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $staff->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
