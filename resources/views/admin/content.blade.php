@extends('layouts.app', ['title' => 'Manajemen Konten Portofolio - Admin Skensa'])

@section('content')
<div class="min-h-screen bg-paper flex">
    {{-- Sidebar Admin --}}
    <aside class="w-64 bg-navy text-white flex flex-col border-r border-navy-700 shrink-0">
        <div class="p-6 border-b border-navy-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-yellow-skensa text-navy font-display font-black flex items-center justify-center text-lg">
                    S1D
                </div>
                <div>
                    <h2 class="font-display font-bold text-base leading-tight">Admin Skensa</h2>
                    <p class="text-xs text-white/60">Manajemen Konten</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 text-sm font-medium">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 rounded-xl text-white/80 hover:bg-navy-700">
                Dashboard Ringkasan
            </a>
            <div class="pt-4 pb-1 px-3 text-[10px] font-semibold tracking-wider text-white/40 uppercase">
                Modul Portofolio Publik
            </div>
            <a href="{{ route('admin.content', ['tab' => 'posts']) }}" class="flex items-center px-3 py-2.5 rounded-xl {{ $tab === 'posts' ? 'bg-navy-700 text-yellow-skensa' : 'text-white/80 hover:bg-navy-700' }}">
                Berita & Pengumuman ({{ $posts->count() }})
            </a>
            <a href="{{ route('admin.content', ['tab' => 'works']) }}" class="flex items-center px-3 py-2.5 rounded-xl {{ $tab === 'works' ? 'bg-navy-700 text-yellow-skensa' : 'text-white/80 hover:bg-navy-700' }}">
                Showcase Karya Siswa ({{ $works->count() }})
            </a>
            <a href="{{ route('admin.content', ['tab' => 'achievements']) }}" class="flex items-center px-3 py-2.5 rounded-xl {{ $tab === 'achievements' ? 'bg-navy-700 text-yellow-skensa' : 'text-white/80 hover:bg-navy-700' }}">
                Prestasi Siswa ({{ $achievements->count() }})
            </a>
            <a href="{{ route('admin.content', ['tab' => 'messages']) }}" class="flex items-center px-3 py-2.5 rounded-xl {{ $tab === 'messages' ? 'bg-navy-700 text-yellow-skensa' : 'text-white/80 hover:bg-navy-700' }}">
                Pesan Kontak Humas ({{ $messages->count() }})
            </a>
            <a href="{{ route('admin.content', ['tab' => 'settings']) }}" class="flex items-center px-3 py-2.5 rounded-xl {{ $tab === 'settings' ? 'bg-navy-700 text-yellow-skensa' : 'text-white/80 hover:bg-navy-700' }}">
                Pengaturan Situs
            </a>
        </nav>

        <div class="p-4 border-t border-navy-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-xl text-xs text-white/70 hover:bg-alert-skensa hover:text-white transition-colors font-medium cursor-pointer">
                    Keluar Sesi
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Area --}}
    <main class="flex-1 p-8 overflow-y-auto">
        <header class="flex justify-between items-center mb-8 pb-4 border-b border-line">
            <div>
                <h1 class="text-2xl font-bold font-display text-navy">Manajemen Konten Portofolio Publik</h1>
                <p class="text-xs text-ink-muted mt-0.5">Kelola publikasi, karya siswa, prestasi, pesan humas, dan parameter situs</p>
            </div>
            <a href="/" target="_blank" class="px-4 py-2 rounded-lg bg-navy text-paper text-xs font-bold uppercase tracking-wider">
                Pratinjau Web Publik &nearr;
            </a>
        </header>

        @if(session('toast_success'))
            <div class="mb-6 p-4 rounded-xl bg-navy text-paper border-l-4 border-yellow-skensa text-sm font-semibold">
                {{ session('toast_success') }}
            </div>
        @endif

        {{-- TAB: POSTS --}}
        @if($tab === 'posts')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-5">
                    <form method="POST" action="{{ route('admin.posts.store') }}" class="p-6 rounded-2xl bg-white border border-line space-y-4">
                        @csrf
                        <h2 class="font-display font-bold text-lg text-navy">Tambah Publikasi Baru</h2>
                        <div>
                            <label class="block text-xs font-bold uppercase text-ink mb-1">Judul Artikel</label>
                            <input type="text" name="title" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-ink mb-1">Kategori</label>
                            <select name="category" class="w-full px-3.5 py-2 rounded-lg border border-line text-sm bg-white">
                                <option value="berita">Berita</option>
                                <option value="pengumuman">Pengumuman</option>
                                <option value="prestasi">Prestasi</option>
                                <option value="agenda">Agenda</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-ink mb-1">Ringkasan Singkat</label>
                            <textarea name="excerpt" rows="2" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-ink mb-1">Isi Artikel</label>
                            <textarea name="body" rows="5" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-navy text-paper text-xs font-bold uppercase tracking-wider cursor-pointer">
                            Terbitkan Artikel
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-7 space-y-3">
                    @foreach($posts as $post)
                        <div class="p-5 rounded-2xl bg-white border border-line flex items-start justify-between gap-4">
                            <div>
                                <span class="px-2 py-0.5 rounded bg-yellow-skensa text-ink text-[11px] font-bold uppercase">{{ $post->category }}</span>
                                <h3 class="font-display font-bold text-base text-ink mt-1">{{ $post->title }}</h3>
                                <p class="text-xs text-ink-muted mt-1">{{ $post->excerpt }}</p>
                            </div>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded bg-alert-skensa text-paper text-xs font-bold uppercase cursor-pointer">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- TAB: WORKS --}}
        @if($tab === 'works')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-5">
                    <form method="POST" action="{{ route('admin.works.store') }}" class="p-6 rounded-2xl bg-white border border-line space-y-4">
                        @csrf
                        <h2 class="font-display font-bold text-lg text-navy">Tambah Karya Siswa</h2>
                        <div>
                            <label class="block text-xs font-bold uppercase text-ink mb-1">Konsentrasi Keahlian</label>
                            <select name="major_id" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm bg-white">
                                @foreach($majors as $m)
                                    <option value="{{ $m->id }}">{{ $m->code }} - {{ $m->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-ink mb-1">Judul Karya</label>
                            <input type="text" name="title" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold uppercase text-ink mb-1">Nama Siswa / Tim</label>
                                <input type="text" name="student_name" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-ink mb-1">Kelas & Tahun</label>
                                <input type="text" name="class_name" placeholder="XII RPL 1" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm">
                                <input type="hidden" name="year" value="{{ date('Y') }}">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-ink mb-1">Deskripsi Karya</label>
                            <textarea name="description" rows="3" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-navy text-paper text-xs font-bold uppercase tracking-wider cursor-pointer">
                            Simpan Karya Siswa
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-7 space-y-3">
                    @foreach($works as $work)
                        <div class="p-5 rounded-2xl bg-white border border-line flex items-start justify-between gap-4">
                            <div>
                                <span class="px-2 py-0.5 rounded bg-navy text-yellow-skensa text-[11px] font-bold uppercase">{{ $work->major?->code }} • {{ $work->year }}</span>
                                <h3 class="font-display font-bold text-base text-ink mt-1">{{ $work->title }}</h3>
                                <p class="text-xs text-navy font-semibold">{{ $work->student_name }} ({{ $work->class_name }})</p>
                                <p class="text-xs text-ink-muted mt-1">{{ $work->description }}</p>
                            </div>
                            <form method="POST" action="{{ route('admin.works.destroy', $work) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded bg-alert-skensa text-paper text-xs font-bold uppercase cursor-pointer">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- TAB: ACHIEVEMENTS --}}
        @if($tab === 'achievements')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-5">
                    <form method="POST" action="{{ route('admin.achievements.store') }}" class="p-6 rounded-2xl bg-white border border-line space-y-4">
                        @csrf
                        <h2 class="font-display font-bold text-lg text-navy">Tambah Prestasi Baru</h2>
                        <div>
                            <label class="block text-xs font-bold uppercase text-ink mb-1">Judul Capaian</label>
                            <input type="text" name="title" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-ink mb-1">Nama Ajang / Kompetisi</label>
                            <input type="text" name="competition_name" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold uppercase text-ink mb-1">Tingkat</label>
                                <select name="level" class="w-full px-3.5 py-2 rounded-lg border border-line text-sm bg-white">
                                    <option value="kota">Kota</option>
                                    <option value="provinsi">Provinsi</option>
                                    <option value="nasional">Nasional</option>
                                    <option value="internasional">Internasional</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-ink mb-1">Medali / Juara</label>
                                <input type="text" name="medal" placeholder="Juara 1 / Emas" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold uppercase text-ink mb-1">Nama Peraih</label>
                                <input type="text" name="winner_name" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-ink mb-1">Tahun</label>
                                <input type="number" name="year" value="{{ date('Y') }}" required class="w-full px-3.5 py-2 rounded-lg border border-line text-sm">
                            </div>
                        </div>
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-navy text-paper text-xs font-bold uppercase tracking-wider cursor-pointer">
                            Simpan Prestasi
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-7 space-y-3">
                    @foreach($achievements as $achievement)
                        <div class="p-5 rounded-2xl bg-white border border-line flex items-start justify-between gap-4">
                            <div>
                                <span class="px-2 py-0.5 rounded bg-yellow-skensa text-ink text-[11px] font-bold uppercase">{{ $achievement->medal }} • {{ ucfirst($achievement->level) }}</span>
                                <h3 class="font-display font-bold text-base text-ink mt-1">{{ $achievement->title }}</h3>
                                <p class="text-xs text-ink-muted">{{ $achievement->competition_name }} ({{ $achievement->year }})</p>
                                <p class="text-xs font-bold text-navy mt-1">{{ $achievement->winner_name }}</p>
                            </div>
                            <form method="POST" action="{{ route('admin.achievements.destroy', $achievement) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded bg-alert-skensa text-paper text-xs font-bold uppercase cursor-pointer">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- TAB: MESSAGES --}}
        @if($tab === 'messages')
            <div class="space-y-4">
                @forelse($messages as $msg)
                    <div class="p-6 rounded-2xl bg-white border border-line flex flex-col sm:flex-row items-start justify-between gap-4">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded text-xs font-bold uppercase {{ $msg->is_read ? 'bg-paper-2 text-ink-muted' : 'bg-yellow-skensa text-ink' }}">
                                    {{ $msg->is_read ? 'Sudah Dibaca' : 'Baru' }}
                                </span>
                                <span class="text-xs font-bold text-navy">{{ $msg->name }} ({{ $msg->email }})</span>
                            </div>
                            <h3 class="font-display font-bold text-lg text-ink">{{ $msg->subject }}</h3>
                            <p class="text-sm text-ink-muted">{{ $msg->message }}</p>
                        </div>
                        @if(!$msg->is_read)
                            <form method="POST" action="{{ route('admin.messages.read', $msg) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 rounded-lg bg-navy text-paper text-xs font-bold uppercase cursor-pointer">
                                    Tandai Dibaca
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <div class="p-10 rounded-2xl bg-white border border-line text-center text-sm text-ink-muted">
                        Belum ada pesan masuk dari formulir kontak publik.
                    </div>
                @endforelse
            </div>
        @endif

        {{-- TAB: SETTINGS --}}
        @if($tab === 'settings')
            <form method="POST" action="{{ route('admin.settings.update') }}" class="p-6 rounded-2xl bg-white border border-line space-y-4 max-w-3xl">
                @csrf
                <h2 class="font-display font-bold text-lg text-navy">Parameter Identitas & Statistik SKENSA</h2>
                @foreach($settings as $setting)
                    <div>
                        <label class="block text-xs font-bold uppercase text-ink mb-1">{{ $setting->key }} ({{ $setting->group }})</label>
                        <input
                            type="text"
                            name="settings[{{ $setting->key }}]"
                            value="{{ $setting->value }}"
                            class="w-full px-3.5 py-2 rounded-lg border border-line text-sm"
                        >
                    </div>
                @endforeach
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-navy text-paper text-xs font-bold uppercase tracking-wider cursor-pointer">
                    Simpan Pengaturan Situs
                </button>
            </form>
        @endif
    </main>
</div>
@endsection
