@extends('layouts.panel')

@section('title', 'Dashboard')
@section('page-title', 'Pusat Kendali - ' . Auth::user()->role_label)

@section('header-badge')
    @if(Auth::user()->major)
        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-900 border border-amber-300">
            Jurusan: {{ Auth::user()->major->name }}
        </span>
    @endif
@endsection

@section('header-actions')
    <a href="{{ route('panel.posts.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span>{{ Auth::user()->isSiswa() ? 'Tulis Berita Baru' : 'Buat Publikasi Baru' }}</span>
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Welcome Greeting Card -->
    <div class="rounded-2xl bg-gradient-to-r from-[#071C3F] to-[#0E1133] text-white p-6 md:p-8 shadow-sm relative overflow-hidden">
        <div class="relative z-10 max-w-2xl">
            <div class="inline-block text-xs uppercase tracking-widest text-amber-400 font-semibold mb-2">Selamat Datang di Panel</div>
            <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-white mb-2">{{ Auth::user()->name }}</h2>
            <p class="text-slate-300 text-sm leading-relaxed">
                @if(Auth::user()->isAdmin())
                    Anda memiliki wewenang administrator penuh: mengelola seluruh berita, pengumuman, data staf, galeri kegiatan, pengguna, serta memantau kondisi beban dan keamanan server sekolah.
                @elseif(Auth::user()->isGuru())
                    Anda terdaftar sebagai Pendidik untuk kejuruan <span class="text-amber-400 font-semibold">{{ Auth::user()->major?->name ?? 'Umum' }}</span>. Anda dapat menerbitkan pengumuman resmi kejuruan, memoderasi berita karya siswa jurusan, dan mengelola dokumentasi galeri.
                @else
                    Selamat berkontribusi untuk almamater SMKN 1 Denpasar. Berita yang Anda kirimkan akan ditinjau oleh guru kejuruan atau administrator sebelum dipublikasikan ke situs umum.
                @endif
            </p>
        </div>
        <div class="absolute right-0 bottom-0 translate-x-8 translate-y-8 opacity-10 pointer-events-none">
            <img src="{{ asset('images/logo_emblem.png') }}" alt="" class="w-72 h-72 object-contain" />
        </div>
    </div>

    <!-- Stat Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
        @if(Auth::user()->isAdmin())
            <!-- Admin Stat Cards -->
            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Total Publikasi</span>
                    <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs">PUB</span>
                </div>
                <div class="text-2xl font-bold text-slate-900">{{ $stats['total_posts'] ?? 0 }}</div>
                <div class="text-xs text-slate-500 mt-1">Berita & pengumuman di sistem</div>
            </div>

            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Menunggu Review</span>
                    <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xs">REV</span>
                </div>
                <div class="text-2xl font-bold text-amber-600">{{ $stats['pending_posts'] ?? 0 }}</div>
                <div class="text-xs text-slate-500 mt-1">Draf berita siswa perlu persetujuan</div>
            </div>

            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Verifikasi Siswa</span>
                    <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">REG</span>
                </div>
                <div class="text-2xl font-bold text-emerald-600">{{ $stats['pending_students'] ?? 0 }}</div>
                <div class="text-xs text-slate-500 mt-1">Pendaftaran siswa baru</div>
            </div>

            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Pesan Humas</span>
                    <span class="w-8 h-8 rounded-lg {{ ($stats['unread_messages'] ?? 0) > 0 ? 'bg-amber-100 text-amber-900' : 'bg-slate-100 text-slate-700' }} flex items-center justify-center font-bold text-xs">MSG</span>
                </div>
                <div class="text-2xl font-bold {{ ($stats['unread_messages'] ?? 0) > 0 ? 'text-amber-600' : 'text-slate-900' }}">
                    {{ $stats['unread_messages'] ?? 0 }}
                </div>
                <div class="text-xs text-slate-500 mt-1">
                    {{ ($stats['unread_messages'] ?? 0) > 0 ? 'Pesan baru belum dibaca' : 'Total ' . ($stats['total_messages'] ?? 0) . ' pesan diterima' }}
                </div>
            </div>

            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Beban Server</span>
                    <span class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-xs">CPU</span>
                </div>
                <div class="text-2xl font-bold text-slate-900">{{ $stats['server']['cpu_usage'] ?? 0 }}%</div>
                <div class="text-xs text-slate-500 mt-1">RAM: {{ $stats['server']['memory']['used_percent'] ?? 0 }}% terpakai</div>
            </div>

        @elseif(Auth::user()->isGuru())
            <!-- Guru Stat Cards -->
            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Publikasi Kejuruan</span>
                    <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs">JUR</span>
                </div>
                <div class="text-2xl font-bold text-slate-900">{{ $stats['my_posts'] ?? 0 }}</div>
                <div class="text-xs text-slate-500 mt-1">Berita & pengumuman jurusan dibuat</div>
            </div>

            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Antrean Review Siswa</span>
                    <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xs">REV</span>
                </div>
                <div class="text-2xl font-bold text-amber-600">{{ $stats['pending_reviews'] ?? 0 }}</div>
                <div class="text-xs text-slate-500 mt-1">Berita siswa jurusan menunggu izin</div>
            </div>

            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Siswa Aktif Jurusan</span>
                    <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">MHS</span>
                </div>
                <div class="text-2xl font-bold text-slate-900">{{ $stats['active_students'] ?? 0 }}</div>
                <div class="text-xs text-slate-500 mt-1">Siswa terdaftar di jurusan ini</div>
            </div>

            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Album Galeri</span>
                    <span class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xs">FTO</span>
                </div>
                <div class="text-2xl font-bold text-slate-900">{{ $stats['total_albums'] ?? 0 }}</div>
                <div class="text-xs text-slate-500 mt-1">Dokumentasi kegiatan foto/video</div>
            </div>

        @else
            <!-- Siswa Stat Cards -->
            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Total Berita Saya</span>
                    <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs">ALL</span>
                </div>
                <div class="text-2xl font-bold text-slate-900">{{ $stats['my_total_posts'] ?? 0 }}</div>
                <div class="text-xs text-slate-500 mt-1">Artikel yang pernah diajukan</div>
            </div>

            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Telah Terbit</span>
                    <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">ACC</span>
                </div>
                <div class="text-2xl font-bold text-emerald-600">{{ $stats['my_published_posts'] ?? 0 }}</div>
                <div class="text-xs text-slate-500 mt-1">Muncul di website publik sekolah</div>
            </div>

            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Menunggu Peninjauan</span>
                    <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xs">WAIT</span>
                </div>
                <div class="text-2xl font-bold text-amber-600">{{ $stats['my_pending_posts'] ?? 0 }}</div>
                <div class="text-xs text-slate-500 mt-1">Sedang ditinjau oleh guru jurusan</div>
            </div>

            <div class="rounded-xl bg-white p-5 border border-slate-200 shadow-xs">
                <div class="flex items-center justify-between text-slate-500 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider">Perlu Perbaikan</span>
                    <span class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-xs">REV</span>
                </div>
                <div class="text-2xl font-bold text-rose-600">{{ $stats['my_rejected_posts'] ?? 0 }}</div>
                <div class="text-xs text-slate-500 mt-1">Dapat diedit dan diajukan ulang</div>
            </div>
        @endif
    </div>

    <!-- Main Content Section: Tables & Review Queue -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left 2 Cols: Posts / Submissions -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Pending Review Card (for Admin and Guru) -->
            @if(Auth::user()->isAdmin() || Auth::user()->isGuru())
                <div class="rounded-xl bg-white border border-slate-200 shadow-xs overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                        <div>
                            <h3 class="font-bold text-slate-900 text-base">Antrean Moderasi Berita Siswa</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Pengajuan berita baru oleh siswa yang tertahan membutuhkan izin Anda</p>
                        </div>
                        <a href="{{ route('panel.review.index') }}" class="text-xs text-amber-700 font-semibold hover:underline">
                            Lihat Semua Antrean &rarr;
                        </a>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @forelse($pendingReviews ?? [] as $rev)
                            <div class="p-4 hover:bg-slate-50 transition-colors flex items-center justify-between gap-4">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2 py-0.5 text-[11px] font-semibold rounded bg-amber-100 text-amber-800">
                                            {{ $rev->major?->code ?? 'Umum' }}
                                        </span>
                                        <span class="text-xs text-slate-500">Penulis: <span class="font-semibold text-slate-700">{{ $rev->author?->name }}</span> ({{ $rev->author?->username }})</span>
                                        <span class="text-xs text-slate-400">&bull; {{ $rev->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-900 truncate">{{ $rev->title }}</h4>
                                </div>
                                <div class="flex items-center gap-2 flex-shrink-0">
                                    <a href="{{ route('panel.review.show', $rev) }}" class="px-3 py-1.5 rounded-lg bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200 text-xs font-semibold transition-colors">
                                        Tinjau & Verifikasi
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-slate-400 text-sm">
                                Tidak ada antrean berita siswa yang menunggu persetujuan saat ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

            @if(Auth::user()->isAdmin())
                <!-- Contact Messages Inbox Widget -->
                <div class="rounded-xl bg-white border border-slate-200 shadow-xs overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="font-bold text-slate-900 text-base">Pesan Masuk Humas & Publik</h3>
                                    @if(($unread_messages ?? 0) > 0)
                                        <span class="px-2 py-0.5 text-xs font-bold rounded-full bg-amber-100 text-amber-900 border border-amber-300">
                                            {{ $unread_messages }} Baru
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5">Pesan yang dikirimkan melalui formulir kontak resmi website sekolah</p>
                            </div>
                        </div>
                        <a href="{{ route('panel.messages.index') }}" class="text-xs text-amber-700 font-semibold hover:underline flex items-center gap-1">
                            <span>Buka Semua Pesan ({{ $total_messages ?? 0 }})</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @forelse($recent_messages ?? [] as $msg)
                            <div class="p-5 hover:bg-slate-50 transition-colors {{ !$msg->is_read ? 'bg-amber-50/20' : '' }}">
                                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3 mb-2">
                                    <div class="min-w-0">
                                        <div class="flex flex-wrap items-center gap-2 mb-1">
                                            <span class="font-bold text-slate-900 text-sm">{{ $msg->name }}</span>
                                            @if(!$msg->is_read)
                                                <span class="px-2 py-0.5 text-[11px] font-bold rounded bg-amber-500 text-slate-950">
                                                    Belum Dibaca
                                                </span>
                                            @else
                                                <span class="px-2 py-0.5 text-[11px] font-medium rounded bg-slate-100 text-slate-600">
                                                    Sudah Dibaca
                                                </span>
                                            @endif
                                            <span class="text-xs text-slate-400">&bull; {{ $msg->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                                            <a href="mailto:{{ $msg->email }}" class="text-slate-600 hover:text-amber-700 hover:underline flex items-center gap-1 font-mono">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                                                {{ $msg->email }}
                                            </a>
                                            @if($msg->phone)
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" rel="noopener" class="text-emerald-700 hover:underline flex items-center gap-1 font-mono font-medium">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                                    {{ $msg->phone }}
                                                </a>
                                            @endif
                                            <span class="text-slate-600 font-semibold truncate max-w-xs">Perihal: {{ $msg->subject }}</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 flex-shrink-0 self-start">
                                        <a href="{{ route('panel.messages.show', $msg) }}" class="px-3 py-1.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition-colors">
                                            Buka Detail
                                        </a>
                                        @if(!$msg->is_read)
                                            <form method="POST" action="{{ route('panel.messages.read', $msg) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold transition-colors">
                                                    Tandai Dibaca
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-2 text-xs text-slate-800 bg-slate-50 border border-slate-200/80 rounded-lg p-3 leading-relaxed font-sans">
                                    {{ $msg->message }}
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-slate-400 text-sm">
                                Belum ada pesan kontak dari masyarakat atau instansi mitra.
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

            <!-- Recent Posts List -->
            <div class="rounded-xl bg-white border border-slate-200 shadow-xs overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900 text-base">
                            {{ Auth::user()->isSiswa() ? 'Daftar Berita Saya Terkini' : 'Publikasi Terkini' }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">Status dan riwayat publikasi artikel</p>
                    </div>
                    <a href="{{ route('panel.posts.index') }}" class="text-xs text-amber-700 font-semibold hover:underline">
                        Buka Arsip &rarr;
                    </a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($recentPosts ?? [] as $post)
                        <div class="p-4 hover:bg-slate-50 transition-colors flex items-center justify-between gap-4">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="px-2 py-0.5 text-[11px] font-semibold rounded {{ $post->status->badgeColor() }}">
                                        {{ $post->status->label() }}
                                    </span>
                                    <span class="text-xs text-slate-500 font-mono">{{ $post->category }}</span>
                                    <span class="text-xs text-slate-400">&bull; {{ $post->created_at->isoFormat('D MMMM Y') }}</span>
                                </div>
                                <h4 class="text-sm font-bold text-slate-900 truncate">{{ $post->title }}</h4>
                                @if($post->status === \App\Enums\PostStatus::Rejected && $post->review_note)
                                    <div class="mt-1 text-xs text-rose-700 bg-rose-50 border border-rose-200 rounded p-1.5 font-sans">
                                        <strong>Catatan Penolakan:</strong> {{ $post->review_note }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                @can('update', $post)
                                    <a href="{{ route('panel.posts.edit', $post) }}" class="p-2 text-slate-500 hover:text-slate-900 rounded-lg hover:bg-slate-100" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                @endcan
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-slate-400 text-sm">
                            Belum ada artikel publikasi yang dibuat.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right 1 Col: Quick Links, Info, Server Snapshot (Admin) -->
        <div class="space-y-6">
            @if(Auth::user()->isAdmin() && isset($stats['server']))
                <!-- Server Snapshot Card -->
                <div class="rounded-xl bg-white border border-slate-200 shadow-xs p-5">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <h4 class="text-sm font-bold text-slate-900">Pemantau Server Singkat</h4>
                        <a href="{{ route('panel.server.index') }}" class="text-xs text-amber-700 font-semibold hover:underline">
                            Detail Lengkap &rarr;
                        </a>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <div class="flex justify-between text-xs font-semibold mb-1">
                                <span class="text-slate-600">Beban CPU</span>
                                <span class="text-slate-900">{{ $stats['server']['cpu_usage'] }}%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-amber-500 rounded-full transition-all" style="width: {{ $stats['server']['cpu_usage'] }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-semibold mb-1">
                                <span class="text-slate-600">Penggunaan Memori RAM</span>
                                <span class="text-slate-900">{{ $stats['server']['memory']['used_percent'] }}%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full transition-all" style="width: {{ $stats['server']['memory']['used_percent'] }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-semibold mb-1">
                                <span class="text-slate-600">Kapasitas Penyimpanan Disk</span>
                                <span class="text-slate-900">{{ $stats['server']['disk']['used_percent'] }}%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full transition-all" style="width: {{ $stats['server']['disk']['used_percent'] }}%"></div>
                            </div>
                        </div>

                        <div class="pt-2 border-t border-slate-100 text-xs text-slate-500 flex justify-between">
                            <span>Uptime Sistem:</span>
                            <span class="font-mono text-slate-700">{{ $stats['server']['uptime']['human'] ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quick Action Links -->
            <div class="rounded-xl bg-white border border-slate-200 shadow-xs p-5">
                <h4 class="text-sm font-bold text-slate-900 mb-3">Tindakan Cepat</h4>
                <div class="space-y-2">
                    <a href="{{ route('panel.posts.create') }}" class="flex items-center gap-3 p-2.5 rounded-lg border border-slate-200 hover:border-amber-300 hover:bg-amber-50/50 text-slate-700 hover:text-slate-900 text-xs font-semibold transition-all">
                        <span class="w-7 h-7 rounded-md bg-amber-100 text-amber-800 flex items-center justify-center font-bold">+</span>
                        <span>{{ Auth::user()->isSiswa() ? 'Kirim Berita Baru' : 'Buat Berita / Pengumuman' }}</span>
                    </a>

                    @if(Auth::user()->isAdmin() || Auth::user()->isGuru())
                        <a href="{{ route('panel.gallery.index') }}" class="flex items-center gap-3 p-2.5 rounded-lg border border-slate-200 hover:border-amber-300 hover:bg-amber-50/50 text-slate-700 hover:text-slate-900 text-xs font-semibold transition-all">
                            <span class="w-7 h-7 rounded-md bg-indigo-100 text-indigo-800 flex items-center justify-center font-bold">F</span>
                            <span>Unggah Dokumentasi Galeri</span>
                        </a>

                        <a href="{{ route('panel.users.index') }}" class="flex items-center gap-3 p-2.5 rounded-lg border border-slate-200 hover:border-amber-300 hover:bg-amber-50/50 text-slate-700 hover:text-slate-900 text-xs font-semibold transition-all">
                            <span class="w-7 h-7 rounded-md bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold">U</span>
                            <span>{{ Auth::user()->isAdmin() ? 'Kelola Akun Guru & Siswa' : 'Aktivasi Pendaftaran Siswa' }}</span>
                        </a>
                    @endif

                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('panel.messages.index') }}" class="flex items-center gap-3 p-2.5 rounded-lg border border-slate-200 hover:border-amber-300 hover:bg-amber-50/50 text-slate-700 hover:text-slate-900 text-xs font-semibold transition-all">
                            <span class="w-7 h-7 rounded-md bg-amber-100 text-amber-800 flex items-center justify-center font-bold">M</span>
                            <span>Buka Pesan Masuk Humas ({{ $unread_messages ?? 0 }})</span>
                        </a>

                        <a href="{{ route('panel.staff.create') }}" class="flex items-center gap-3 p-2.5 rounded-lg border border-slate-200 hover:border-amber-300 hover:bg-amber-50/50 text-slate-700 hover:text-slate-900 text-xs font-semibold transition-all">
                            <span class="w-7 h-7 rounded-md bg-blue-100 text-blue-800 flex items-center justify-center font-bold">G</span>
                            <span>Tambah Guru / Tenaga Pendidik</span>
                        </a>

                        <a href="{{ route('panel.audit.index') }}" class="flex items-center gap-3 p-2.5 rounded-lg border border-slate-200 hover:border-amber-300 hover:bg-amber-50/50 text-slate-700 hover:text-slate-900 text-xs font-semibold transition-all">
                            <span class="w-7 h-7 rounded-md bg-slate-100 text-slate-800 flex items-center justify-center font-bold">A</span>
                            <span>Periksa Catatan Audit Keamanan</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Guidelines / Help Card -->
            <div class="rounded-xl bg-amber-50/70 border border-amber-200/80 p-5 text-xs text-amber-900">
                <h5 class="font-bold mb-1.5 flex items-center gap-2 text-amber-950">
                    <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    <span>Pedoman Alur Penerbitan</span>
                </h5>
                <p class="leading-relaxed text-amber-900/90">
                    @if(Auth::user()->isSiswa())
                        Setiap naskah berita yang Anda tulis akan disaring secara otomatis demi mencegah kode berbahaya dan diteruskan ke Guru Jurusan Anda untuk ditinjau. Pastikan isi berita menggunakan bahasa baku dan foto beresolusi jelas.
                    @else
                        Admin dan Guru dapat langsung menerbitkan konten ke publik. Konten yang diunggah siswa akan tertahan di tab Moderasi Berita hingga Anda meninjau dan menyetujuinya.
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
