<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\ContactMessage;
use App\Models\Event;
use App\Models\Facility;
use App\Models\GalleryAlbum;
use App\Models\Major;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\StaffMember;
use App\Models\StudentWork;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminContentController extends Controller
{
    public function index(Request $request): View
    {
        $tab = $request->query('tab', 'posts');

        return view('admin.content', [
            'tab' => $tab,
            'majors' => Major::with('field')->orderBy('order_index')->get(),
            'posts' => Post::latest('published_at')->get(),
            'works' => StudentWork::with('major')->latest()->get(),
            'achievements' => Achievement::with('major')->orderByDesc('year')->get(),
            'staffMembers' => StaffMember::orderBy('order_index')->get(),
            'facilities' => Facility::orderBy('id')->get(),
            'events' => Event::orderByDesc('start_time')->get(),
            'albums' => GalleryAlbum::withCount('photos')->orderByDesc('event_date')->get(),
            'messages' => ContactMessage::latest()->get(),
            'settings' => SiteSetting::orderBy('group')->orderBy('key')->get(),
        ]);
    }

    public function storePost(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:220'],
            'category' => ['required', 'in:berita,pengumuman'],
            'excerpt' => ['required', 'string', 'max:500'],
            'body' => ['required', 'string'],
        ]);

        Post::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']) . '-' . Str::lower(Str::random(4)),
            'category' => $data['category'],
            'excerpt' => $data['excerpt'],
            'content' => $data['body'],
            'featured_image' => '/images/gedung_skensa.jpg',
            'author_id' => $request->user()?->id,
            'is_published' => true,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.content', ['tab' => 'posts'])
            ->with('toast_success', 'Publikasi baru berhasil ditambahkan.');
    }

    public function destroyPost(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.content', ['tab' => 'posts'])
            ->with('toast_success', 'Publikasi berhasil dihapus.');
    }

    public function storeWork(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'major_id' => ['required', 'exists:majors,id'],
            'title' => ['required', 'string', 'max:200'],
            'student_name' => ['required', 'string', 'max:150'],
            'year' => ['required', 'integer', 'min:2020', 'max:2030'],
            'description' => ['required', 'string'],
            'project_url' => ['nullable', 'url'],
        ]);

        StudentWork::create([
            'major_id' => $data['major_id'],
            'title' => $data['title'],
            'slug' => Str::slug($data['title']) . '-' . Str::lower(Str::random(4)),
            'student_name' => $data['student_name'],
            'year' => $data['year'],
            'description' => $data['description'],
            'demo_url' => $data['project_url'] ?? null,
            'thumbnail' => '/images/hero_siswa.jpg',
        ]);

        return redirect()->route('admin.content', ['tab' => 'works'])
            ->with('toast_success', 'Karya siswa baru berhasil disimpan.');
    }

    public function destroyWork(StudentWork $work): RedirectResponse
    {
        $work->delete();

        return redirect()->route('admin.content', ['tab' => 'works'])
            ->with('toast_success', 'Karya siswa berhasil dihapus.');
    }

    public function storeAchievement(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'major_id' => ['nullable', 'exists:majors,id'],
            'title' => ['required', 'string', 'max:200'],
            'competition_name' => ['required', 'string', 'max:200'],
            'level' => ['required', 'string', 'max:100'],
            'medal' => ['required', 'string', 'max:100'],
            'winner_name' => ['required', 'string', 'max:150'],
            'year' => ['required', 'integer', 'min:2020', 'max:2030'],
        ]);

        Achievement::create([
            'major_id' => $data['major_id'] ?? null,
            'title' => $data['title'],
            'student_or_team' => $data['winner_name'],
            'rank' => $data['medal'],
            'level' => ucfirst($data['level']),
            'year' => $data['year'],
            'description' => $data['competition_name'],
            'image' => '/images/hero_siswa.jpg',
        ]);

        return redirect()->route('admin.content', ['tab' => 'achievements'])
            ->with('toast_success', 'Data prestasi berhasil ditambahkan.');
    }

    public function destroyAchievement(Achievement $achievement): RedirectResponse
    {
        $achievement->delete();

        return redirect()->route('admin.content', ['tab' => 'achievements'])
            ->with('toast_success', 'Data prestasi berhasil dihapus.');
    }

    public function markMessageRead(ContactMessage $message): RedirectResponse
    {
        $message->update(['is_read' => true]);

        return redirect()->route('admin.content', ['tab' => 'messages'])
            ->with('toast_success', 'Pesan ditandai sudah dibaca.');
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $settings = $request->input('settings', []);
        if (is_array($settings)) {
            foreach ($settings as $key => $value) {
                SiteSetting::where('key', $key)->update(['value' => (string) $value]);
            }
        }

        return redirect()->route('admin.content', ['tab' => 'settings'])
            ->with('toast_success', 'Pengaturan situs berhasil diperbarui.');
    }
}
