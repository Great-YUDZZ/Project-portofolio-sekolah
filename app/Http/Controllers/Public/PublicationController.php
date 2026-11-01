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

        $counts = [
            'total' => Post::where('is_published', true)->count(),
            'berita' => Post::where('is_published', true)->where('category', 'berita')->count(),
            'pengumuman' => Post::where('is_published', true)->where('category', 'pengumuman')->count(),
            'events' => $events->count(),
        ];

        return view('public.publications.index', compact('posts', 'events', 'category', 'counts'));
    }

    public function show(string $slug): View
    {
        $post = Post::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $relatedPosts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        $wordCount = str_word_count(strip_tags($post->content));
        $readTime = max(1, (int) ceil($wordCount / 200));

        return view('public.publications.show', compact('post', 'relatedPosts', 'readTime'));
    }
}
