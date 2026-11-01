@extends('layouts.panel')

@section('title', 'Moderasi Berita Siswa')
@section('page-title', 'Antrean Moderasi Berita Siswa')

@section('content')
<div class="space-y-6">
    <div class="rounded-xl bg-amber-50/80 border border-amber-200 p-4 text-xs text-amber-900 flex items-start gap-3">
        <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <span class="font-bold">Panduan Moderasi:</span> Berita yang ditulis siswa ditahan secara aman hingga disetujui. Pastikan konten informatif, tidak mengandung ujaran kebencian, foto sopan dan relevan. Menolak berita mewajibkan penulisan catatan revisi agar siswa dapat memperbaiki karyanya.
        </div>
    </div>

    <!-- Review Queue Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-600 uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Judul Berita</th>
                        <th class="py-3 px-4">Penulis (Siswa)</th>
                        <th class="py-3 px-4">Kejuruan</th>
                        <th class="py-3 px-4">Diajukan Pada</th>
                        <th class="py-3 px-4 text-right">Aksi Peninjauan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($posts as $post)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-4">
                                <div class="font-bold text-slate-900 max-w-md truncate">{{ $post->title }}</div>
                                <div class="text-xs text-slate-500 mt-1 line-clamp-1">{{ $post->excerpt ?: strip_tags($post->content) }}</div>
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">
                                <div class="font-semibold text-slate-800">{{ $post->author?->name ?? 'Anonim' }}</div>
                                <div class="text-xs text-slate-400 font-mono">NIS: {{ $post->author?->username }}</div>
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold bg-amber-100 text-amber-900 border border-amber-200">
                                    {{ $post->major?->name ?? 'Umum' }}
                                </span>
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap text-xs text-slate-500">
                                {{ $post->created_at->diffForHumans() }}
                            </td>
                            <td class="py-4 px-4 text-right whitespace-nowrap">
                                <a href="{{ route('panel.review.show', $post) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold transition-colors">
                                    <span>Tinjau Naskah</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-slate-400">
                                <div class="w-12 h-12 mx-auto rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg mb-3">&check;</div>
                                <div class="font-bold text-slate-700 text-sm">Semua naskah telah dimoderasi</div>
                                <div class="text-xs text-slate-500 mt-1">Tidak ada berita siswa yang tertahan dalam antrean saat ini.</div>
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
