<?php

namespace App\Http\Controllers\Panel;

use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Major;
use App\Models\Post;
use App\Services\HtmlSanitizer;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * Display a listing of posts based on role and active tab.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $statusTab = $request->query('status', 'all');
        $category = $request->query('kategori');
        $search = $request->query('q');

        $query = Post::with(['author', 'major', 'reviewer'])->latest();

        // Role filtering
        if ($user->isSiswa()) {
            $query->where('author_id', $user->id);
        } elseif ($user->isGuru()) {
            // Guru sees their own posts, or posts in their major
            $query->where(function ($q) use ($user) {
                $q->where('author_id', $user->id);
                if ($user->major_id) {
                    $q->orWhere('major_id', $user->major_id);
                }
            });
        }
        // Admin sees all

        // Filter by Status Tab
        if ($statusTab !== 'all') {
            $query->where('status', $statusTab);
        }

        // Filter by Category
        if ($category && in_array($category, ['berita', 'pengumuman'])) {
            $query->where('category', $category);
        }

        // Search Keyword
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(15)->withQueryString();

        // Count per status tab for badges
        $baseCountQuery = Post::query();
        if ($user->isSiswa()) {
            $baseCountQuery->where('author_id', $user->id);
        } elseif ($user->isGuru()) {
            $baseCountQuery->where(function ($q) use ($user) {
                $q->where('author_id', $user->id);
                if ($user->major_id) {
                    $q->orWhere('major_id', $user->major_id);
                }
            });
        }

        $counts = [
            'all' => (clone $baseCountQuery)->count(),
            'published' => (clone $baseCountQuery)->where('status', PostStatus::Published->value)->count(),
            'pending' => (clone $baseCountQuery)->where('status', PostStatus::Pending->value)->count(),
            'draft' => (clone $baseCountQuery)->where('status', PostStatus::Draft->value)->count(),
            'rejected' => (clone $baseCountQuery)->where('status', PostStatus::Rejected->value)->count(),
        ];

        return view('panel.posts.index', [
            'posts' => $posts,
            'statusTab' => $statusTab,
            'category' => $category,
            'search' => $search,
            'counts' => $counts,
        ]);
    }

    /**
     * Show form to create a new post.
     */
    public function create()
    {
        $user = Auth::user();
        Gate::authorize('create', Post::class);

        $majors = Major::orderBy('order_index')->get();

        return view('panel.posts.create', [
            'majors' => $majors,
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        Gate::authorize('create', Post::class);

        // Allowed categories: Siswa can ONLY create 'berita'
        $allowedCategories = $user->isSiswa() ? ['berita'] : ['berita', 'pengumuman'];

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'category' => ['required', Rule::in($allowedCategories)],
            'major_id' => ['nullable', 'exists:majors,id'],
            'excerpt' => ['nullable', 'string', 'max:350'],
            'content' => ['required', 'string', 'min:20'],
            'featured_image' => ['nullable', 'image', 'max:5120'], // 5MB
            'video_url' => ['nullable', 'url', 'regex:/^https:\/\/(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[\w-]{11}/i'],
            'video_file' => ['nullable', 'file', 'mimetypes:video/mp4', 'max:51200'], // 50MB (admin/guru only)
            'action' => ['nullable', Rule::in(['draft', 'publish', 'submit'])],
        ], [
            'title.required' => 'Judul publikasi wajib diisi.',
            'category.required' => 'Pilih kategori publikasi.',
            'category.in' => 'Kategori yang dipilih tidak diizinkan untuk peran Anda.',
            'content.required' => 'Isi artikel berita/pengumuman wajib diisi.',
            'content.min' => 'Isi artikel minimal terdiri dari 20 karakter.',
            'featured_image.max' => 'Ukuran gambar unggulan maksimal adalah 5 MB.',
            'video_url.regex' => 'Format URL video harus berupa tautan YouTube yang valid (contoh: https://youtube.com/watch?v=... atau https://youtu.be/...).',
            'video_file.max' => 'Ukuran file video MP4 maksimal adalah 50 MB.',
        ]);

        $action = $request->input('action') ?? ($user->isSiswa() ? 'submit' : ($request->input('status') === 'draft' ? 'draft' : 'publish'));

        // 1. Sanitize HTML
        $cleanContent = HtmlSanitizer::clean($validated['content']);

        // 2. Generate Unique Slug
        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-" . $counter++;
        }

        // 3. Handle Featured Image Upload
        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $media = MediaService::storeImage($request->file('featured_image'), $user, $validated['title']);
            $featuredImagePath = $media->url;
        }

        // 4. Handle Video File Upload (Admin & Guru only)
        $videoFilePath = null;
        if ($request->hasFile('video_file')) {
            $videoMedia = MediaService::storeVideo($request->file('video_file'), $user, $validated['title']);
            $videoFilePath = $videoMedia->url;
        }

        // 5. Determine Post Status
        $status = PostStatus::Draft;
        $isPublished = false;
        $publishedAt = null;

        if ($user->isSiswa()) {
            // Siswa always submits to Pending approval queue
            $status = PostStatus::Pending;
        } else {
            // Admin & Guru
            if ($action === 'publish') {
                $status = PostStatus::Published;
                $isPublished = true;
                $publishedAt = now();
            } else {
                $status = PostStatus::Draft;
            }
        }

        // Determine major_id
        $majorId = ($validated['major_id'] ?? null) ?: $user->major_id;

        $post = Post::create([
            'author_id' => $user->id,
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'status' => $status,
            'major_id' => $majorId,
            'excerpt' => ($validated['excerpt'] ?? null) ?: Str::limit(strip_tags($cleanContent), 180),
            'content' => $cleanContent,
            'featured_image' => $featuredImagePath,
            'video_url' => ($validated['video_url'] ?? null) ?: null,
            'video_path' => $videoFilePath,
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
        ]);

        AuditLog::record('post.created', $post, [
            'status' => $status->value,
            'category' => $validated['category'],
        ]);

        $message = match($status) {
            PostStatus::Published => 'Publikasi berhasil diterbitkan secara langsung ke website publik!',
            PostStatus::Pending => 'Berita berhasil dikirimkan! Saat ini berada di antrean persetujuan guru jurusan atau admin.',
            PostStatus::Draft => 'Draf publikasi berhasil disimpan.',
            default => 'Publikasi berhasil disimpan.',
        };

        return redirect()->route('panel.posts.index')->with('success', $message);
    }

    /**
     * Show form to edit an existing post.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        $majors = Major::orderBy('order_index')->get();

        return view('panel.posts.edit', [
            'post' => $post,
            'majors' => $majors,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, Post $post)
    {
        $user = Auth::user();
        Gate::authorize('update', $post);

        $allowedCategories = $user->isSiswa() ? ['berita'] : ['berita', 'pengumuman'];

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'category' => ['required', Rule::in($allowedCategories)],
            'major_id' => ['nullable', 'exists:majors,id'],
            'excerpt' => ['nullable', 'string', 'max:350'],
            'content' => ['required', 'string', 'min:20'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'video_url' => ['nullable', 'url', 'regex:/^https:\/\/(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[\w-]{11}/i'],
            'video_file' => ['nullable', 'file', 'mimetypes:video/mp4', 'max:51200'],
            'action' => ['nullable', Rule::in(['draft', 'publish', 'submit'])],
        ]);

        $action = $request->input('action') ?? ($user->isSiswa() ? 'submit' : ($request->input('status') === 'draft' ? 'draft' : 'publish'));

        // 1. Sanitize HTML
        $cleanContent = HtmlSanitizer::clean($validated['content']);

        // 2. Handle Featured Image
        if ($request->hasFile('featured_image')) {
            $media = MediaService::storeImage($request->file('featured_image'), $user, $validated['title']);
            $post->featured_image = $media->url;
        }

        // 3. Handle Video File
        if ($request->hasFile('video_file')) {
            $videoMedia = MediaService::storeVideo($request->file('video_file'), $user, $validated['title']);
            $post->video_path = $videoMedia->url;
        }

        // 4. Status Transition
        if ($user->isSiswa()) {
            // If siswa updates a rejected post, it resubmits to Pending!
            $post->status = PostStatus::Pending;
            $post->review_note = null; // reset rejection note
            $post->reviewed_at = null;
            $post->reviewed_by = null;
        } else {
            // Admin / Guru
            if ($action === 'publish') {
                $post->status = PostStatus::Published;
                $post->is_published = true;
                if (!$post->published_at) {
                    $post->published_at = now();
                }
            } else {
                $post->status = PostStatus::Draft;
                $post->is_published = false;
            }
        }

        $post->title = $validated['title'];
        $post->category = $validated['category'];
        $post->major_id = ($validated['major_id'] ?? null) ?: $post->major_id;
        $post->excerpt = ($validated['excerpt'] ?? null) ?: Str::limit(strip_tags($cleanContent), 180);
        $post->content = $cleanContent;
        $post->video_url = ($validated['video_url'] ?? null) ?: null;
        $post->save();

        AuditLog::record('post.updated', $post, ['status' => $post->status->value]);

        return redirect()->route('panel.posts.index')->with(
            'success',
            $user->isSiswa()
                ? 'Perubahan berhasil disimpan dan kiriman Anda telah diajukan kembali untuk persetujuan!'
                : 'Publikasi berhasil diperbarui!'
        );
    }

    /**
     * Remove the specified post (soft delete).
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $title = $post->title;
        $post->delete();

        AuditLog::record('post.deleted', $post, ['title' => $title]);

        return redirect()->route('panel.posts.index')->with('success', "Publikasi '{$title}' berhasil dihapus.");
    }
}
