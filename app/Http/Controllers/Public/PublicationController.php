<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicationController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->query('kategori');

        $postsQuery = Post::where('is_published', true)->orderByDesc('published_at');
        if ($category && in_array($category, ['berita', 'pengumuman'], true)) {
            $postsQuery->where('category', $category);
        }

        $posts = $postsQuery->get();
        $events = Event::orderBy('start_time')->get();

        return view('public.publications.index', compact('posts', 'events', 'category'));
    }

    public function show(string $slug): View
    {
        $post = Post::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $relatedPosts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.publications.show', compact('post', 'relatedPosts'));
    }
}
