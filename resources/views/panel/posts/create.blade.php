@extends('layouts.panel')

@section('title', 'Tulis Publikasi Baru')
@section('page-title', Auth::user()->isSiswa() ? 'Tulis Berita Baru' : 'Buat Publikasi Baru')

@section('header-actions')
    <a href="{{ route('panel.posts.index') }}" class="px-3 py-1.5 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-100 text-xs font-semibold transition-colors">
        &larr; Kembali ke Daftar
    </a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <form method="POST" action="{{ route('panel.posts.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Main Form Card -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-xs p-6 space-y-6">
            <!-- Judul -->
            <div>
                <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Judul Publikasi <span class="text-rose-600">*</span>
                </label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Contoh: Siswa Rekayasa Perangkat Lunak Raih Juara 1 LKS Tingkat Provinsi" class="w-full px-4 py-2.5 text-base font-semibold border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
            </div>

            <!-- Grid: Kategori & Kejuruan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Kategori -->
                <div>
                    <label for="category" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kategori Publikasi <span class="text-rose-600">*</span>
                    </label>
                    @if(Auth::user()->isSiswa())
                        <input type="text" readonly value="Berita" class="w-full px-3 py-2 bg-slate-100 border border-slate-200 rounded-lg text-slate-600 text-sm font-semibold cursor-not-allowed" />
                        <input type="hidden" name="category" value="berita" />
                        <p class="text-[11px] text-slate-500 mt-1">Akun siswa secara khusus diperuntukkan untuk menulis berita kegiatan sekolah.</p>
                    @else
                        <select id="category" name="category" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-slate-800 font-medium">
                            <option value="berita" {{ old('category') === 'berita' ? 'selected' : '' }}>Berita Sekolah</option>
                            <option value="pengumuman" {{ old('category') === 'pengumuman' ? 'selected' : '' }}>Pengumuman Resmi</option>
                        </select>
                    @endif
                </div>

                <!-- Kejuruan -->
                <div>
                    <label for="major_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Terkait Kejuruan
                    </label>
                    @if(Auth::user()->isSiswa())
                        <input type="text" readonly value="{{ Auth::user()->major?->name ?? 'Umum' }}" class="w-full px-3 py-2 bg-slate-100 border border-slate-200 rounded-lg text-slate-600 text-sm font-semibold cursor-not-allowed" />
                        <input type="hidden" name="major_id" value="{{ Auth::user()->major_id }}" />
                    @elseif(Auth::user()->isGuru())
                        <select id="major_id" name="major_id" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-slate-800">
                            @if(Auth::user()->major)
                                <option value="{{ Auth::user()->major_id }}" selected>{{ Auth::user()->major->name }} (Jurusan Anda)</option>
                            @endif
                            <option value="">Umum (Seluruh Sekolah)</option>
                        </select>
                    @else
                        <select id="major_id" name="major_id" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-slate-800">
                            <option value="">Umum (Seluruh Sekolah)</option>
                            @foreach($majors as $m)
                                <option value="{{ $m->id }}" {{ old('major_id') == $m->id ? 'selected' : '' }}>{{ $m->name }} ({{ $m->code }})</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>

            <!-- Ringkasan / Excerpt -->
            <div>
                <label for="excerpt" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Ringkasan Singkat (Lead Paragraph)
                </label>
                <textarea id="excerpt" name="excerpt" rows="2" placeholder="Tuliskan 1-2 kalimat ringkasan yang menarik untuk ditampilkan pada kartu berita..." class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500">{{ old('excerpt') }}</textarea>
            </div>

            <!-- Gambar Sampul (Featured Image) -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Gambar Sampul Berita (Maksimal 5 MB, Otomatis Dikonversi ke WebP)
                </label>
                <input type="file" name="featured_image" accept="image/jpeg,image/png,image/webp,image/gif" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100 cursor-pointer border border-slate-300 rounded-lg p-1" />
                <p class="text-[11px] text-slate-500 mt-1">Sistem akan membersihkan metadata EXIF/GPS demi privasi dan keamanan berkas.</p>
            </div>

            <!-- Video Tambahan (YouTube Embed atau MP4 Direct Upload) -->
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                <div class="text-xs font-bold text-slate-800 uppercase tracking-wider">Lampiran Video (Opsional)</div>

                <div>
                    <label for="video_url" class="block text-xs font-semibold text-slate-600 mb-1">
                        Tautan Video YouTube (Contoh: https://www.youtube.com/watch?v=...)
                    </label>
                    <input type="url" id="video_url" name="video_url" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=..." class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 bg-white" />
                </div>

                @if(Auth::user()->isAdmin() || Auth::user()->isGuru())
                    <div class="pt-2 border-t border-slate-200">
                        <label class="block text-xs font-semibold text-slate-600 mb-1">
                            Atau Unggah Berkas Video MP4 Langsung (Khusus Guru & Admin, Maks. 50 MB)
                        </label>
                        <input type="file" name="video_file" accept="video/mp4" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-200 file:text-slate-800 hover:file:bg-slate-300 cursor-pointer border border-slate-300 rounded-lg p-1 bg-white" />
                    </div>
                @endif
            </div>

            <!-- Tiptap Rich Text Editor -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Isi Konten Lengkap <span class="text-rose-600">*</span>
                </label>

                <!-- Toolbar -->
                <div id="tiptap-toolbar" class="flex flex-wrap items-center gap-1 p-2 bg-slate-100 border border-slate-300 rounded-t-xl">
                    <button type="button" data-tiptap-cmd="bold" class="px-2.5 py-1 text-xs font-bold rounded bg-white text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors" title="Tebal (Ctrl+B)">B</button>
                    <button type="button" data-tiptap-cmd="italic" class="px-2.5 py-1 text-xs italic rounded bg-white text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors" title="Miring (Ctrl+I)">I</button>
                    <button type="button" data-tiptap-cmd="strike" class="px-2.5 py-1 text-xs line-through rounded bg-white text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors" title="Coret">S</button>
                    <span class="w-px h-5 bg-slate-300 mx-1"></span>
                    <button type="button" data-tiptap-cmd="heading" data-tiptap-level="2" class="px-2.5 py-1 text-xs font-bold rounded bg-white text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors">H2</button>
                    <button type="button" data-tiptap-cmd="heading" data-tiptap-level="3" class="px-2.5 py-1 text-xs font-bold rounded bg-white text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors">H3</button>
                    <span class="w-px h-5 bg-slate-300 mx-1"></span>
                    <button type="button" data-tiptap-cmd="bulletList" class="px-2.5 py-1 text-xs rounded bg-white text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors" title="Daftar Titik">&bull; List</button>
                    <button type="button" data-tiptap-cmd="orderedList" class="px-2.5 py-1 text-xs rounded bg-white text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors" title="Daftar Angka">1. List</button>
                    <button type="button" data-tiptap-cmd="blockquote" class="px-2.5 py-1 text-xs rounded bg-white text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors" title="Kutipan">&ldquo; Kutip</button>
                    <button type="button" data-tiptap-cmd="horizontalRule" class="px-2.5 py-1 text-xs rounded bg-white text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors" title="Garis Pemisah">&mdash; Garis</button>
                    <span class="w-px h-5 bg-slate-300 mx-1"></span>
                    <button type="button" data-tiptap-cmd="link" class="px-2.5 py-1 text-xs rounded bg-white text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors" title="Sisipkan Tautan">Link</button>
                    <button type="button" data-tiptap-cmd="image-upload" class="px-2.5 py-1 text-xs font-semibold rounded bg-amber-100 text-amber-900 hover:bg-amber-200 border border-amber-300 transition-colors flex items-center gap-1" title="Sisipkan Foto ke Naskah">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Sisipkan Gambar</span>
                    </button>
                    <span class="w-px h-5 bg-slate-300 mx-1"></span>
                    <button type="button" data-tiptap-cmd="undo" class="px-2.5 py-1 text-xs rounded bg-white text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors" title="Urungkan (Ctrl+Z)">&larr;</button>
                    <button type="button" data-tiptap-cmd="redo" class="px-2.5 py-1 text-xs rounded bg-white text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors" title="Ulangi (Ctrl+Y)">&rarr;</button>
                </div>

                <!-- Hidden file input for image upload inside tiptap -->
                <input type="file" id="tiptap-image-input" accept="image/jpeg,image/png,image/webp,image/gif" data-upload-url="{{ route('panel.media.upload') }}" class="hidden" />

                <!-- Editor Container -->
                <div id="tiptap-editor" class="border-x border-b border-slate-300 rounded-b-xl min-h-[320px] bg-white"></div>
                <input type="hidden" name="content" id="post-content-hidden" value="{{ old('content') }}" required />
            </div>

            <!-- Status Terbit -->
            @if(Auth::user()->isSiswa())
                <div class="rounded-lg bg-amber-50 border border-amber-200 p-4 text-xs text-amber-900">
                    <div class="font-bold mb-1">Status Pengajuan: Menunggu Persetujuan</div>
                    <p>Berita ini akan disimpan dengan status <span class="font-semibold text-amber-950">Menunggu Review</span> dan otomatis masuk ke antrean persetujuan guru kejuruan atau administrator.</p>
                </div>
            @else
                <div>
                    <label for="status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Status Publikasi
                    </label>
                    <select id="status" name="status" class="w-full sm:w-64 px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-slate-800 font-semibold">
                        <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Langsung Terbitkan (Published)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Simpan Sebagai Draf (Draft)</option>
                    </select>
                </div>
            @endif
        </div>

        <!-- Submit Button Row -->
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('panel.posts.index') }}" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-900 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ Auth::user()->isSiswa() ? 'Kirim Berita untuk Ditinjau' : 'Simpan & Terbitkan' }}</span>
            </button>
        </div>
    </form>
</div>
@endsection
