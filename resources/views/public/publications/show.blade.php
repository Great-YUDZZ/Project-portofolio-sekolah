@extends('layouts.public')

@section('title', $post->title . ' - Warta SMK Negeri 1 Denpasar')

@section('content')

    {{-- ============================================================= --}}
    {{-- EDITORIAL HERO HEADER                                         --}}
    {{-- ============================================================= --}}
    <section class="bg-navy text-white border-b-2 border-line py-14 sm:py-18 relative overflow-hidden" data-reveal>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-white/[0.08] via-transparent to-transparent pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- Breadcrumb & Meta Bar --}}
            <div class="flex flex-wrap items-center gap-2.5 text-xs font-mono mb-5">
                <a href="{{ route('publications.index') }}" class="text-cyan-300 hover:underline inline-flex items-center gap-1 font-bold">
                    <span>&larr;</span>
                    <span>Semua Publikasi</span>
                </a>
                <span class="text-slate-400">/</span>
                <span class="px-2.5 py-0.5 rounded text-[11px] font-bold uppercase {{ $post->category === 'pengumuman' ? 'bg-amber-400 text-amber-950' : 'bg-white/15 text-white' }}">
                    {{ $post->category }}
                </span>
                <span class="text-slate-400">/</span>
                <span class="text-slate-300">
                    {{ optional($post->published_at)->format('d F Y') }}
                </span>
                <span class="text-slate-400">•</span>
                <span class="text-cyan-300">
                    {{ $readTime ?? 2 }} menit waktu baca
                </span>
            </div>

            {{-- Title --}}
            <h1 class="font-display font-extrabold text-2xl sm:text-4xl lg:text-5xl text-white tracking-tight leading-tight">
                {{ $post->title }}
            </h1>

            {{-- Lead Excerpt --}}
            @if($post->excerpt)
                <p class="text-slate-300 text-sm sm:text-base mt-4 leading-relaxed font-sans border-l-2 border-cyan-400 pl-4 py-1">
                    {{ $post->excerpt }}
                </p>
            @endif
        </div>
    </section>

    {{-- ============================================================= --}}
    {{-- EDITORIAL ARTICLE BODY                                        --}}
    {{-- ============================================================= --}}
    <article class="py-12 sm:py-16 bg-paper">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- Featured Image if exists --}}
            @if($post->thumbnail)
                <div class="rounded-3xl overflow-hidden border-2 border-line bg-navy shadow-sm" data-reveal>
                    <img
                        src="{{ $post->thumbnail }}"
                        alt="{{ $post->title }}"
                        class="w-full aspect-video object-cover"
                        loading="lazy"
                    >
                </div>
            @endif

            {{-- Main Article Text Content --}}
            <div class="p-8 sm:p-12 rounded-3xl bg-paper-2 border border-line shadow-xs space-y-6 text-ink leading-relaxed" data-reveal>
                <div class="prose max-w-none text-sm sm:text-base space-y-5 text-ink leading-relaxed">
                    {!! $post->content ?: nl2br(e($post->body)) !!}
                </div>

                {{-- Author & Verification Stamp --}}
                <div class="pt-8 mt-8 border-t border-line flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-xs font-mono">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-navy text-white flex items-center justify-center font-bold text-xs shrink-0">
                            H
                        </div>
                        <div>
                            <span class="font-bold text-ink block">Redaksi Humas &amp; Publikasi</span>
                            <span class="text-ink-muted">SMK Negeri 1 Denpasar</span>
                        </div>
                    </div>

                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-[11px] font-bold">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Dokumen Terverifikasi Resmi</span>
                    </div>
                </div>

                {{-- Social Share Toolbar --}}
                <div class="pt-4 border-t border-line flex flex-wrap items-center justify-between gap-3 text-xs">
                    <span class="font-mono font-bold text-ink-muted uppercase tracking-wider">
                        Bagikan Warta:
                    </span>
                    <div class="flex items-center gap-2">
                        <button
                            type="button"
                            id="copy-link-btn"
                            class="px-3 py-1.5 rounded-lg bg-paper border border-line text-ink hover:border-navy font-mono font-bold text-xs cursor-pointer transition-colors"
                        >
                            Salin Tautan
                        </button>
                        <a
                            href="https://wa.me/?text={{ urlencode($post->title . ' - ' . url()->current()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="px-3 py-1.5 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 font-mono font-bold text-xs transition-colors"
                        >
                            WhatsApp
                        </a>
                        <a
                            href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="px-3 py-1.5 rounded-lg bg-slate-900 text-white hover:bg-black font-mono font-bold text-xs transition-colors"
                        >
                            X
                        </a>
                    </div>
                </div>
            </div>

            {{-- Related Publications Section --}}
            @if($relatedPosts->isNotEmpty())
                <section class="pt-8 border-t border-line" data-reveal>
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <span class="text-xs font-mono font-bold uppercase tracking-widest text-navy block mb-1">
                                Warta Lainnya
                            </span>
                            <h3 class="font-display font-extrabold text-2xl text-ink">
                                Rekomendasi Terkait
                            </h3>
                        </div>
                        <a href="{{ route('publications.index') }}" class="text-xs font-mono font-bold uppercase text-navy hover:underline">
                            Lihat Semua &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5" data-reveal-stagger>
                        @foreach($relatedPosts as $rel)
                            <article data-reveal-item class="p-5 rounded-2xl bg-paper-2 border border-line hover:border-navy hover:shadow-sm transition-all duration-300 flex flex-col justify-between group">
                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase {{ $rel->category === 'pengumuman' ? 'bg-amber-400 text-amber-950' : 'bg-navy text-white' }}">
                                            {{ $rel->category }}
                                        </span>
                                        <span class="text-[11px] font-mono text-ink-muted">
                                            {{ optional($rel->published_at)->format('d M Y') }}
                                        </span>
                                    </div>
                                    <h4 class="font-display font-bold text-sm text-ink group-hover:text-navy transition-colors line-clamp-2 leading-snug">
                                        <a href="{{ route('publications.show', $rel->slug) }}">
                                            {{ $rel->title }}
                                        </a>
                                    </h4>
                                </div>
                                <div class="mt-4 pt-3 border-t border-line/60">
                                    <a href="{{ route('publications.show', $rel->slug) }}" class="text-[11px] font-mono font-bold uppercase text-navy group-hover:underline">
                                        Baca &rarr;
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

        </div>
    </article>

    {{-- Copy Link Feedback Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const copyBtn = document.getElementById('copy-link-btn');
            if (copyBtn) {
                copyBtn.addEventListener('click', function () {
                    navigator.clipboard.writeText(window.location.href).then(function () {
                        const originalText = copyBtn.textContent;
                        copyBtn.textContent = 'Tautan Disalin!';
                        copyBtn.classList.add('bg-navy', 'text-white');
                        setTimeout(function () {
                            copyBtn.textContent = originalText;
                            copyBtn.classList.remove('bg-navy', 'text-white');
                        }, 2000);
                    });
                });
            }
        });
    </script>

@endsection
