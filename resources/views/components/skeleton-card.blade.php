<div class="grid grid-cols-1 md:grid-cols-3 gap-6" aria-busy="true" aria-label="Memuat Konten">
    @for($i = 0; $i < ($count ?? 3); $i++)
        <div class="p-6 rounded-2xl bg-paper-2 border border-line space-y-4">
            <div class="h-44 w-full rounded-xl skeleton-shimmer"></div>
            <div class="h-4 w-24 rounded skeleton-shimmer"></div>
            <div class="h-6 w-3/4 rounded skeleton-shimmer"></div>
            <div class="h-4 w-full rounded skeleton-shimmer"></div>
            <div class="h-4 w-5/6 rounded skeleton-shimmer"></div>
        </div>
    @endfor
</div>
