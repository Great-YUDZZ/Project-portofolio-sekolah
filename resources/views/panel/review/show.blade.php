@extends('layouts.panel')

@section('title', 'Tinjau Naskah: ' . $post->title)
@section('page-title', 'Tinjau Berita Siswa')

@section('header-actions')
    <a href="{{ route('panel.review.index') }}" class="px-3 py-1.5 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-100 text-xs font-semibold transition-colors">
        &larr; Kembali ke Antrean
    </a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Action Decision Card -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-xs p-5">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <span class="inline-flex px-2 py-0.5 rounded text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200 mb-1">
                    Status: Menunggu Keputusan
                </span>
                <h3 class="text-base font-bold text-slate-900">Keputusan Moderasi untuk Naskah Ini</h3>
                <p class="text-xs text-slate-500">Pilihlah untuk menyetujui agar langsung terbit ke publik atau tolak dengan memberikan catatan revisi.</p>
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <!-- Approve Form -->
                <form method="POST" action="{{ route('panel.review.approve', $post) }}" onsubmit="return confirm('Setujui naskah berita ini untuk segera diterbitkan ke publik?')" class="flex-1 sm:flex-none">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-xs transition-colors flex items-center justify-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Setujui & Terbitkan</span>
                    </button>
                </form>

                <!-- Toggle Reject Form Button -->
                <button type="button" onclick="document.getElementById('reject-form-panel').classList.toggle('hidden')" class="flex-1 sm:flex-none px-4 py-2 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-bold transition-colors">
                    Tolak Naskah &hellip;
                </button>
            </div>
        </div>

        <!-- Hidden Reject Form Panel -->
        <div id="reject-form-panel" class="hidden mt-4 pt-4 border-t border-slate-200">
            <form method="POST" action="{{ route('panel.review.reject', $post) }}" class="space-y-3">
                @csrf
                <div>
                    <label for="review_note" class="block text-xs font-bold text-rose-800 uppercase tracking-wider mb-1">
                        Alasan Penolakan / Catatan Perbaikan untuk Siswa <span class="text-rose-600">*</span>
                    </label>
                    <textarea id="review_note" name="review_note" rows="3" required placeholder="Jelaskan secara spesifik bagian mana yang perlu diperbaiki oleh siswa (contoh: Gunakan ejaan baku dan tambahkan sumber foto kegiatan)..." class="w-full px-3 py-2 text-sm border border-rose-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500"></textarea>
                </div>
                <div class="flex items-center justify-end gap-2">
                    <button type="button" onclick="document.getElementById('reject-form-panel').classList.add('hidden')" class="px-3 py-1.5 text-xs text-slate-500 hover:text-slate-800">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-xs transition-colors">
                        Kirim Penolakan ke Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Student Author Info Card -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-xs p-5 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-amber-50 border border-amber-200 text-amber-800 font-bold flex items-center justify-center text-base">
                {{ substr($post->author?->name ?? 'S', 0, 2) }}
            </div>
            <div>
                <div class="font-bold text-slate-900 text-sm">{{ $post->author?->name }}</div>
                <div class="text-xs text-slate-500 flex items-center gap-2 mt-0.5">
                    <span>NIS: <strong class="font-mono text-slate-700">{{ $post->author?->username }}</strong></span>
                    <span>&bull;</span>
                    <span>Jurusan: <strong>{{ $post->major?->name ?? 'Umum' }}</strong></span>
                </div>
            </div>
        </div>
        <div class="text-right text-xs text-slate-400">
            <div>Diajukan pada:</div>
            <div class="font-semibold text-slate-700">{{ $post->created_at->isoFormat('D MMMM Y, HH:mm') }} WITA</div>
        </div>
    </div>

    <!-- Article Content Preview Card -->
    <article class="bg-white rounded-xl border border-slate-200 shadow-xs p-6 md:p-8 space-y-6">
        <div>
            <span class="inline-block text-xs uppercase tracking-widest text-amber-700 font-bold mb-2">
                {{ $post->category }} &bull; {{ $post->major?->code ?? 'UMUM' }}
            </span>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 leading-tight">
                {{ $post->title }}
            </h1>
        </div>

        @if($post->excerpt)
            <div class="text-base font-medium text-slate-600 border-l-4 border-amber-500 pl-4 italic">
                {{ $post->excerpt }}
            </div>
        @endif

        @if($post->featured_image)
            <div class="rounded-xl overflow-hidden border border-slate-200 bg-slate-100 max-h-[420px]">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover" />
            </div>
        @endif

        <!-- Video Attachment Preview -->
        @if($post->video_url)
            @php
                $youtubeId = null;
                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $post->video_url, $match)) {
                    $youtubeId = $match[1];
                }
            @endphp
            @if($youtubeId)
                <div class="aspect-video rounded-xl overflow-hidden border border-slate-200 bg-black">
                    <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" class="w-full h-full" allowfullscreen></iframe>
                </div>
            @else
                <div class="p-3 rounded-lg bg-slate-100 text-xs text-slate-700 font-mono">
                    Tautan Video: <a href="{{ $post->video_url }}" target="_blank" class="text-amber-700 underline">{{ $post->video_url }}</a>
                </div>
            @endif
        @endif

        @if($post->video_path)
            <div class="rounded-xl overflow-hidden border border-slate-200 bg-black">
                <video src="{{ asset('storage/' . $post->video_path) }}" controls class="w-full max-h-[420px]"></video>
            </div>
        @endif

        <!-- Sanitized Body Content -->
        <div class="prose prose-slate max-w-none text-slate-800 leading-relaxed font-sans pt-4 border-t border-slate-100">
            {!! $post->content !!}
        </div>
    </article>
</div>
@endsection
