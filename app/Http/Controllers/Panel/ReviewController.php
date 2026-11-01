<?php

namespace App\Http\Controllers\Panel;

use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{
    /**
     * Display listing of pending posts awaiting review.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->isSiswa()) {
            abort(403, 'Akses ditolak: Siswa tidak memiliki wewenang untuk meninjau persetujuan konten.');
        }

        $query = Post::with(['author.studentProfile.classroom', 'major'])->where('status', PostStatus::Pending->value);

        if ($user->isGuru() && $user->major_id) {
            $query->where(function ($q) use ($user) {
                $q->where('major_id', $user->major_id)
                  ->orWhereHas('author', function ($aq) use ($user) {
                      $aq->where('major_id', $user->major_id);
                  });
            });
        }

        $pendingPosts = $query->latest()->paginate(15);

        return view('panel.review.index', [
            'posts' => $pendingPosts,
            'pendingPosts' => $pendingPosts,
            'user' => $user,
        ]);
    }

    /**
     * Show preview and decision form for a pending post.
     */
    public function show(Post $post)
    {
        Gate::authorize('review', $post);

        $post->load(['author.studentProfile.classroom', 'major']);

        return view('panel.review.show', [
            'post' => $post,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Approve the pending post for immediate publication.
     */
    public function approve(Request $request, Post $post)
    {
        Gate::authorize('review', $post);

        $user = Auth::user();

        $post->update([
            'status' => PostStatus::Published,
            'is_published' => true,
            'published_at' => now(),
            'reviewed_by' => $user->id,
            'reviewed_at' => now(),
            'review_note' => $request->input('review_note') ?: 'Disetujui untuk terbit ke website publik.',
        ]);

        AuditLog::record('post.approved', $post, [
            'reviewer_id' => $user->id,
            'author_id' => $post->author_id,
        ]);

        return redirect()->route('panel.review.index')->with(
            'success',
            "Berita '{$post->title}' karya {$post->author?->name} berhasil disetujui dan kini telah tayang di website publik!"
        );
    }

    /**
     * Reject the pending post with an actionable reason for student revision.
     */
    public function reject(Request $request, Post $post)
    {
        Gate::authorize('review', $post);

        $request->validate([
            'review_note' => ['required', 'string', 'min:10', 'max:500'],
        ], [
            'review_note.required' => 'Wajib menyertakan catatan alasan penolakan atau petunjuk revisi untuk siswa.',
            'review_note.min' => 'Catatan penolakan minimal 10 karakter agar informatif bagi siswa.',
        ]);

        $user = Auth::user();

        $post->update([
            'status' => PostStatus::Rejected,
            'is_published' => false,
            'reviewed_by' => $user->id,
            'reviewed_at' => now(),
            'review_note' => $request->review_note,
        ]);

        AuditLog::record('post.rejected', $post, [
            'reviewer_id' => $user->id,
            'author_id' => $post->author_id,
            'reason' => $request->review_note,
        ]);

        return redirect()->route('panel.review.index')->with(
            'warning',
            "Berita '{$post->title}' telah ditolak dengan catatan revisi. Siswa dapat melihat catatan dan memperbaiki kirimannya."
        );
    }
}
