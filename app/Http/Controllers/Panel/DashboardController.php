<?php

namespace App\Http\Controllers\Panel;

use App\Enums\PostStatus;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\GalleryAlbum;
use App\Models\Major;
use App\Models\Post;
use App\Models\StaffMember;
use App\Models\User;
use App\Services\ServerMetrics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $data = [
            'user' => $user,
        ];

        if ($user->isAdmin()) {
            $data['total_posts'] = Post::count();
            $data['published_posts'] = Post::where('status', PostStatus::Published->value)->count();
            $data['pending_reviews'] = Post::where('status', PostStatus::Pending->value)->count();
            $data['pending_activations'] = User::where('status', UserStatus::Pending->value)->count();
            $data['total_staff'] = StaffMember::count();
            $data['total_albums'] = GalleryAlbum::count();
            $data['total_users'] = User::count();
            $data['recent_posts'] = Post::with(['author', 'major'])->latest()->take(5)->get();
            $data['recent_logs'] = AuditLog::with('user')->latest('id')->take(6)->get();
            $data['server_summary'] = ServerMetrics::get();
        } elseif ($user->isGuru()) {
            $majorId = $user->major_id;
            $data['major'] = $majorId ? Major::find($majorId) : null;
            $data['my_posts_count'] = Post::where('author_id', $user->id)->count();
            $data['my_published_count'] = Post::where('author_id', $user->id)->where('status', PostStatus::Published->value)->count();

            // Student posts from teacher's major awaiting review
            $pendingQuery = Post::where('status', PostStatus::Pending->value);
            if ($majorId) {
                $pendingQuery->where('major_id', $majorId);
            }
            $data['pending_reviews_count'] = $pendingQuery->count();
            $data['pending_posts'] = $pendingQuery->with('author')->latest()->take(5)->get();

            // Students from teacher's major awaiting activation
            $studentsQuery = User::where('role', 'siswa')->where('status', UserStatus::Pending->value);
            if ($majorId) {
                $studentsQuery->where('major_id', $majorId);
            }
            $data['pending_students_count'] = $studentsQuery->count();
            $data['my_recent_posts'] = Post::where('author_id', $user->id)->latest()->take(5)->get();
        } else {
            // Siswa
            $data['my_posts'] = Post::where('author_id', $user->id)->latest()->take(10)->get();
            $data['total_submitted'] = Post::where('author_id', $user->id)->count();
            $data['total_published'] = Post::where('author_id', $user->id)->where('status', PostStatus::Published->value)->count();
            $data['total_pending'] = Post::where('author_id', $user->id)->where('status', PostStatus::Pending->value)->count();
            $data['total_rejected'] = Post::where('author_id', $user->id)->where('status', PostStatus::Rejected->value)->count();
        }

        return view('panel.dashboard', $data);
    }
}
