@extends('layouts.panel')

@section('title', 'Detail Album: ' . $gallery->title)
@section('page-title', $gallery->title)

@section('header-actions')
    <a href="{{ route('panel.gallery.index') }}" class="px-3 py-1.5 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-100 text-xs font-semibold transition-colors">
        &larr; Kembali ke Galeri
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Album Header Card -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-xs p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div class="flex items-start gap-4">
            <div class="w-24 h-20 rounded-lg overflow-hidden bg-slate-100 border border-slate-200 flex-shrink-0">
                @if($gallery->cover_image)
                    <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover" />
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-400 font-bold text-xs uppercase">No Cover</div>
                @endif
            </div>
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-slate-100 text-slate-700">
                        {{ $gallery->category }}
                    </span>
                    @if($gallery->major)
                        <span class="text-xs font-semibold text-amber-900 bg-amber-100 px-2 py-0.5 rounded border border-amber-300">
                            {{ $gallery->major->name }}
                        </span>
                    @endif
                    <span class="text-xs text-slate-400">&bull; {{ $gallery->event_date?->isoFormat('D MMMM Y') ?? '-' }}</span>
                </div>
                <h2 class="text-xl font-bold text-slate-900">{{ $gallery->title }}</h2>
                @if($gallery->description)
                    <p class="text-xs text-slate-600 mt-1 max-w-2xl">{{ $gallery->description }}</p>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-2 flex-shrink-0">
            @can('delete', $gallery)
                <form method="POST" action="{{ route('panel.gallery.destroy', $gallery) }}" onsubmit="return confirm('Hapus seluruh album ini beserta semua foto di dalamnya?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-2 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-semibold transition-colors">
                        Hapus Album
                    </button>
                </form>
            @endcan
        </div>
    </div>

    <!-- Upload Photos Card -->
    @can('addPhotos', $gallery)
        <div class="bg-white rounded-xl border border-slate-200 shadow-xs p-6">
            <h3 class="text-sm font-bold text-slate-900 mb-2">Tambahkan Foto Kegiatan ke Album Ini</h3>
            <p class="text-xs text-slate-500 mb-4">Pilih satu atau hingga 20 berkas foto sekaligus (JPG, PNG, WebP, Maks. 5 MB per foto). Foto akan otomatis dikonversi ke WebP dan dibersihkan dari metadata lokasi GPS.</p>

            <form method="POST" action="{{ route('panel.gallery.photos.upload', $gallery) }}" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center gap-3">
                @csrf
                <input type="file" name="photos[]" multiple required accept="image/jpeg,image/png,image/webp" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100 cursor-pointer border border-slate-300 rounded-lg p-1" />
                <button type="submit" class="w-full sm:w-auto px-6 py-2.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold shadow-xs whitespace-nowrap transition-colors">
                    Unggah Foto
                </button>
            </form>
        </div>
    @endcan

    <!-- Photos Grid -->
    <div>
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-slate-900 text-base">Koleksi Foto ({{ $gallery->photos->count() }})</h3>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @forelse($gallery->photos as $photo)
                <div class="group relative aspect-square bg-slate-100 rounded-xl overflow-hidden border border-slate-200 shadow-2xs">
                    <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />

                    @can('update', $gallery)
                        <form method="POST" action="{{ route('panel.gallery.photos.destroy', [$gallery, $photo]) }}" onsubmit="return confirm('Hapus foto ini?')" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 rounded-lg bg-slate-900/80 hover:bg-rose-600 text-white text-xs transition-colors shadow-sm" title="Hapus Foto">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    @endcan
                </div>
            @empty
                <div class="col-span-full bg-white rounded-xl border border-slate-200 p-12 text-center text-slate-400">
                    Belum ada foto yang diunggah ke album ini.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
