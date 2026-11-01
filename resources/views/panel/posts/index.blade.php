@extends('layouts.panel')

@section('title', 'Daftar Publikasi')
@section('page-title', Auth::user()->isSiswa() ? 'Berita Saya' : 'Manajemen Berita & Pengumuman')

@section('header-actions')
    <a href="{{ route('panel.posts.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span>{{ Auth::user()->isSiswa() ? 'Tulis Berita Baru' : 'Buat Publikasi Baru' }}</span>
    </a>
@endsection

@section('content')
<div class="space-y-5">
    <!-- Filter Bar -->
    <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-xs">
        <form method="GET" action="{{ route('panel.posts.index') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
            <div class="sm:col-span-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul atau isi publikasi..." class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
            </div>

            <div>
                <select name="status" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-slate-700">
                    <option value="">Semua Status</option>
                    @foreach(\App\Enums\PostStatus::cases() as $st)
                        <option value="{{ $st->value }}" {{ request('status') === $st->value ? 'selected' : '' }}>{{ $st->label() }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="w-full px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-lg transition-colors">
                    Saring Data
                </button>
                @if(request()->hasAny(['q', 'status', 'category']))
                    <a href="{{ route('panel.posts.index') }}" class="p-2 text-slate-500 hover:text-slate-800 rounded-lg hover:bg-slate-100" title="Reset Filter">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Posts Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-600 uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Judul & Kategori</th>
                        <th class="py-3 px-4">Penulis</th>
                        <th class="py-3 px-4">Kejuruan</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Tanggal Buat</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($posts as $post)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-slate-900 max-w-md truncate">{{ $post->title }}</div>
                                <div class="flex items-center gap-2 mt-0.5 text-xs text-slate-500">
                                    <span class="font-semibold uppercase tracking-wider text-[10px] px-1.5 py-0.5 rounded bg-slate-100 border border-slate-200 text-slate-700">
                                        {{ $post->category }}
                                    </span>
                                    @if($post->featured_image)
                                        <span class="text-emerald-600 font-medium text-[11px] flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            Gambar
                                        </span>
                                    @endif
                                    @if($post->video_url || $post->video_path)
                                        <span class="text-rose-600 font-medium text-[11px] flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Video
                                        </span>
                                    @endif
                                </div>
                                @if($post->status === \App\Enums\PostStatus::Rejected && $post->review_note)
                                    <div class="mt-2 text-xs text-rose-700 bg-rose-50 border border-rose-200 rounded p-2">
                                        <strong>Catatan Penolakan:</strong> {{ $post->review_note }}
                                    </div>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="font-medium text-slate-800">{{ $post->author?->name ?? 'Anonim' }}</div>
                                <div class="text-xs text-slate-400 font-mono">{{ $post->author?->role_label }}</div>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                @if($post->major)
                                    <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold bg-slate-100 text-slate-800 border border-slate-200">
                                        {{ $post->major->code }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400">Umum</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-bold {{ $post->status->badgeColor() }}">
                                    {{ $post->status->label() }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap text-xs text-slate-500">
                                {{ $post->created_at->isoFormat('D MMM Y, HH:mm') }}
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap space-x-1">
                                @if($post->status === \App\Enums\PostStatus::Published)
                                    <a href="{{ route('publications.show', $post->slug) }}" target="_blank" class="inline-flex p-1.5 text-slate-400 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors" title="Buka Halaman Publik">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @endif

                                @can('update', $post)
                                    <a href="{{ route('panel.posts.edit', $post) }}" class="inline-flex p-1.5 text-slate-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors" title="Edit Artikel">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                @endcan

                                @can('delete', $post)
                                    <form method="POST" action="{{ route('panel.posts.destroy', $post) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus publikasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-slate-400">
                                <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3 font-mono font-bold text-lg">0</div>
                                <div class="font-bold text-slate-700 text-sm">Tidak ada artikel publikasi yang ditemukan</div>
                                <div class="text-xs text-slate-500 mt-1">Coba sesuaikan kata kunci pencarian atau filter status.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
