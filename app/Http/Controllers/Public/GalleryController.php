<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $albums = GalleryAlbum::with(['photos' => fn ($q) => $q->orderBy('order_index')])
            ->orderByDesc('event_date')
            ->get();

        return view('public.gallery', compact('albums'));
    }
}
