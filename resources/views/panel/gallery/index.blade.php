@extends('layouts.panel')

@section('title', 'Galeri Kegiatan')
@section('page-title', 'Galeri Kegiatan & Dokumentasi')

@section('header-actions')
    <button type="button" onclick="document.getElementById('modal-create-album').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span>Buat Album Baru</span>
    </button>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Album Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        @forelse($albums as $album)
            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition-shadow flex flex-col group">
                <a href="{{ route('panel.gallery.show', $album) }}" class="relative aspect-video bg-slate-100 overflow-hidden block">
                    @if($album->cover_image)
                        <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-400 font-bold text-xs uppercase">
                            Belum Ada Foto
                        </div>
                    @endif
                    <div class="absolute bottom-2 right-2 px-2 py-0.5 rounded bg-black/70 text-white text-[11px] font-mono">
                        {{ $album->photos_count }} Foto
                    </div>
                </a>

                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="text-[10px] font-bold uppercase tracking-wider px-1.5 py-0.5 rounded bg-slate-100 text-slate-700">
                                {{ $album->category }}
                            </span>
                            @if($album->major)
                                <span class="text-[10px] font-semibold text-amber-800 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-200">
                                    {{ $album->major->code }}
                                </span>
                            @endif
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm leading-snug line-clamp-2 group-hover:text-amber-700 transition-colors">
                            <a href="{{ route('panel.gallery.show', $album) }}">{{ $album->title }}</a>
                        </h4>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                        <span>{{ $album->event_date?->isoFormat('D MMM Y') ?? '-' }}</span>
                        <a href="{{ route('panel.gallery.show', $album) }}" class="font-semibold text-amber-700 hover:underline">
                            Buka Album &rarr;
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-xl border border-slate-200 p-12 text-center text-slate-400">
                <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 flex items-center justify-center font-bold text-lg mb-3">F</div>
                <div class="font-bold text-slate-700 text-sm">Belum ada album kegiatan</div>
                <div class="text-xs text-slate-500 mt-1">Klik tombol Buat Album Baru di atas untuk memulai dokumentasi.</div>
            </div>
        @endforelse
    </div>

    @if($albums->hasPages())
        <div class="mt-4">
            {{ $albums->links() }}
        </div>
    @endif
</div>

<!-- Modal Create Album -->
<div id="modal-create-album" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 backdrop-blur-xs p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h3 class="font-bold text-slate-900 text-base">Buat Album Kegiatan Baru</h3>
            <button type="button" onclick="document.getElementById('modal-create-album').classList.add('hidden')" class="text-slate-400 hover:text-slate-700 font-bold text-lg">&times;</button>
        </div>

        <form method="POST" action="{{ route('panel.gallery.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="modal_title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Judul Album Kegiatan <span class="text-rose-600">*</span>
                </label>
                <input type="text" id="modal_title" name="title" required placeholder="Contoh: Gelar Karya Inovasi Teknologi Skensa 2026" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="modal_category" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Kategori <span class="text-rose-600">*</span>
                    </label>
                    <input type="text" id="modal_category" name="category" required value="Kegiatan Sekolah" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
                </div>

                <div>
                    <label for="modal_event_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Tanggal Kegiatan
                    </label>
                    <input type="date" id="modal_event_date" name="event_date" value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
                </div>
            </div>

            @if(Auth::user()->isAdmin())
                <div>
                    <label for="modal_major_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Khusus Kejuruan (Opsional)
                    </label>
                    <select id="modal_major_id" name="major_id" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-slate-800">
                        <option value="">Umum (Seluruh Sekolah)</option>
                        @foreach($majors as $m)
                            <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->code }})</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div>
                <label for="modal_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Deskripsi Singkat
                </label>
                <textarea id="modal_description" name="description" rows="2" placeholder="Catatan mengenai pelaksanaan kegiatan..." class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Foto Sampul (Maks. 5 MB)
                </label>
                <input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100 cursor-pointer border border-slate-300 rounded-lg p-1" />
            </div>

            <div class="pt-2 flex items-center justify-end gap-2 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-create-album').classList.add('hidden')" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-900">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold shadow-xs">
                    Buat Album
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
