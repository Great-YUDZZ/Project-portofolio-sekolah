<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\GalleryAlbum;
use App\Models\GalleryPhoto;
use App\Models\Major;
use App\Services\MediaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', GalleryAlbum::class);

        $user = $request->user() ?: Auth::user();
        $query = GalleryAlbum::query()->with(['major', 'creator'])->withCount('photos')->latest('event_date');

        // If guru, show albums belonging to their major or general
        if ($user->isGuru()) {
            $query->where(function ($q) use ($user) {
                $q->whereNull('major_id')
                  ->orWhere('major_id', $user->major_id);
            });
        }

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $albums = $query->paginate(12)->withQueryString();
        $majors = Major::orderBy('name')->get();

        return view('panel.gallery.index', compact('albums', 'majors'));
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', GalleryAlbum::class);

        $user = $request->user();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'category' => ['required', 'string', 'max:100'],
            'event_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string', 'max:1000'],
            'major_id' => ['nullable', 'exists:majors,id'],
            'cover_image' => ['nullable', 'file', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
        ]);

        if ($user->isGuru()) {
            $validated['major_id'] = $user->major_id;
        }

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $media = MediaService::storeImage($request->file('cover_image'), $user, "Sampul Album: {$validated['title']}");
            $coverPath = $media->path;
        }

        $slug = Str::slug($validated['title']);
        $uniqueSlug = $slug;
        $counter = 1;
        while (GalleryAlbum::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = "{$slug}-{$counter}";
            $counter++;
        }

        $album = GalleryAlbum::create([
            'title' => $validated['title'],
            'slug' => $uniqueSlug,
            'category' => $validated['category'],
            'description' => $validated['description'] ?? null,
            'cover_image' => $coverPath,
            'event_date' => $validated['event_date'] ?? now()->toDateString(),
            'major_id' => $validated['major_id'] ?? null,
            'created_by' => $user->id,
        ]);

        AuditLog::record(
            action: 'create_album',
            auditable: $album,
            description: "Membuat album galeri: {$album->title}"
        );

        return redirect()->route('panel.gallery.show', $album)
            ->with('status', "Album '{$album->title}' berhasil dibuat. Silakan tambahkan foto kegiatan.");
    }

    public function show(GalleryAlbum $gallery): View
    {
        Gate::authorize('view', $gallery);

        $gallery->load(['photos', 'major', 'creator']);

        return view('panel.gallery.show', compact('gallery'));
    }

    public function uploadPhotos(Request $request, GalleryAlbum $gallery): RedirectResponse
    {
        Gate::authorize('addPhotos', $gallery);

        $request->validate([
            'photos' => ['required', 'array', 'min:1', 'max:20'],
            'photos.*' => ['required', 'file', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
        ]);

        $user = $request->user();
        $currentMaxOrder = (int) $gallery->photos()->max('order_index');
        $uploadedCount = 0;

        foreach ($request->file('photos') as $file) {
            $currentMaxOrder++;
            $media = MediaService::storeImage($file, $user, "Foto kegiatan: {$gallery->title}");

            GalleryPhoto::create([
                'gallery_album_id' => $gallery->id,
                'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'caption' => null,
                'image_path' => $media->path,
                'order_index' => $currentMaxOrder,
            ]);

            // If album has no cover, use first uploaded photo
            if (empty($gallery->cover_image)) {
                $gallery->update(['cover_image' => $media->path]);
            }

            $uploadedCount++;
        }

        AuditLog::record(
            action: 'upload_album_photos',
            auditable: $gallery,
            description: "Menambahkan {$uploadedCount} foto ke album: {$gallery->title}"
        );

        return back()->with('status', "{$uploadedCount} foto berhasil ditambahkan ke album.");
    }

    public function destroyPhoto(GalleryAlbum $gallery, GalleryPhoto $photo): RedirectResponse
    {
        Gate::authorize('update', $gallery);

        if ($photo->gallery_album_id !== $gallery->id) {
            abort(404);
        }

        $photo->delete();

        AuditLog::record(
            action: 'delete_album_photo',
            auditable: $gallery,
            description: "Menghapus foto ID {$photo->id} dari album: {$gallery->title}"
        );

        return back()->with('status', "Foto berhasil dihapus.");
    }

    public function destroy(GalleryAlbum $gallery): RedirectResponse
    {
        Gate::authorize('delete', $gallery);

        $title = $gallery->title;
        $gallery->photos()->delete();
        $gallery->delete();

        AuditLog::record(
            action: 'delete_album',
            auditable: $gallery,
            description: "Menghapus album galeri: {$title}"
        );

        return redirect()->route('panel.gallery.index')
            ->with('status', "Album '{$title}' berhasil dihapus.");
    }
}
