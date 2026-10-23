@extends('layouts.public')

@section('title', $post->title . ' - Publikasi SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 text-xs font-bold uppercase tracking-widest">
                <a href="{{ route('publications.index') }}" class="text-yellow-skensa hover:underline">&larr; Kembali ke Publikasi</a>
                <span>•</span>
                <span class="px-2.5 py-0.5 rounded bg-navy-700 text-paper">{{ $post->category }}</span>
                <span>•</span>
                <span class="text-paper/75">{{ optional($post->published_at)->format('d F Y') }}</span>
            </div>
            <h1 class="font-display font-extrabold text-3xl sm:text-5xl mt-4 leading-tight">{{ $post->title }}</h1>
        </div>
    </section>

    <section class="py-14 bg-paper">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($post->thumbnail)
                <div class="aspect-video rounded-2xl overflow-hidden border-2 border-ink mb-8 bg-navy">
                    <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <article class="p-8 sm:p-10 rounded-2xl bg-paper-2/60 border border-line space-y-4 text-ink leading-relaxed">
                <p class="font-semibold text-lg text-navy">{{ $post->excerpt }}</p>
                <div class="border-t border-line pt-4 space-y-4 text-ink-muted">
                    {!! nl2br(e($post->body)) !!}
                </div>
            </article>

            @if($relatedPosts->isNotEmpty())
                <div class="mt-12 pt-8 border-t border-line">
                    <h2 class="font-display font-bold text-xl text-ink mb-4">Publikasi Terkait Lainnya</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        @foreach($relatedPosts as $rel)
                            <a href="{{ route('publications.show', $rel->slug) }}" class="p-5 rounded-xl bg-paper-2 border border-line hover:border-navy block">
                                <span class="text-[11px] font-bold uppercase text-navy">{{ $rel->category }}</span>
                                <h3 class="font-display font-bold text-base text-ink mt-1">{{ $rel->title }}</h3>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection
