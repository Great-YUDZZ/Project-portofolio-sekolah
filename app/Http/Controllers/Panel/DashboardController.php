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

        $stats = [];
        $recentPosts = collect();
        $pendingReviews = collect();
        $data = [
            'user' => $user,
        ];

        if ($user->isAdmin()) {
            $totalPosts = Post::count();
            $publishedPosts = Post::where('status', PostStatus::Published->value)->count();
            $pendingPosts = Post::where('status', PostStatus::Pending->value)->count();
            $pendingStudents = User::where('status', UserStatus::Pending->value)->count();
            $serverMetrics = ServerMetrics::get();

            $recentPosts = Post::with(['author', 'major'])->latest()->take(5)->get();
            $pendingReviews = Post::where('status', PostStatus::Pending->value)->with(['author', 'major'])->latest()->take(5)->get();

            $stats = [
                'total_posts' => $totalPosts,
                'published_posts' => $publishedPosts,
                'pending_posts' => $pendingPosts,
                'pending_students' => $pendingStudents,
                'server' => $serverMetrics,
            ];

            $data['total_posts'] = $totalPosts;
            $data['published_posts'] = $publishedPosts;
            $data['pending_reviews'] = $pendingPosts;
            $data['pending_activations'] = $pendingStudents;
            $data['total_staff'] = StaffMember::count();
            $data['total_albums'] = GalleryAlbum::count();
            $data['total_users'] = User::count();
            $data['recent_posts'] = $recentPosts;
            $data['recent_logs'] = AuditLog::with('user')->latest('id')->take(6)->get();
            $data['server_summary'] = $serverMetrics;
        } elseif ($user->isGuru()) {
            $majorId = $user->major_id;
            $major = $majorId ? Major::find($majorId) : null;
            $myPostsCount = Post::where('author_id', $user->id)->count();
            $myPublishedCount = Post::where('author_id', $user->id)->where('status', PostStatus::Published->value)->count();

            // Student posts from teacher's major awaiting review
            $pendingQuery = Post::where('status', PostStatus::Pending->value);
            if ($majorId) {
                $pendingQuery->where('major_id', $majorId);
            }
            $pendingReviewsCount = (clone $pendingQuery)->count();
            $pendingReviews = (clone $pendingQuery)->with('author')->latest()->take(5)->get();

            // Students from teacher's major awaiting activation
            $studentsQuery = User::where('role', 'siswa')->where('status', UserStatus::Pending->value);
            if ($majorId) {
                $studentsQuery->where('major_id', $majorId);
            }
            $pendingStudentsCount = $studentsQuery->count();
            $recentPosts = Post::where('author_id', $user->id)->latest()->take(5)->get();

            $stats = [
                'my_posts' => $myPostsCount,
                'my_published' => $myPublishedCount,
                'pending_reviews' => $pendingReviewsCount,
                'pending_students' => $pendingStudentsCount,
            ];

            $data['major'] = $major;
            $data['my_posts_count'] = $myPostsCount;
            $data['my_published_count'] = $myPublishedCount;
            $data['pending_reviews_count'] = $pendingReviewsCount;
            $data['pending_posts'] = $pendingReviews;
            $data['pending_students_count'] = $pendingStudentsCount;
            $data['my_recent_posts'] = $recentPosts;
        } else {
            // Siswa
            $recentPosts = Post::where('author_id', $user->id)->latest()->take(10)->get();
            $totalSubmitted = Post::where('author_id', $user->id)->count();
            $totalPublished = Post::where('author_id', $user->id)->where('status', PostStatus::Published->value)->count();
            $totalPending = Post::where('author_id', $user->id)->where('status', PostStatus::Pending->value)->count();
            $totalRejected = Post::where('author_id', $user->id)->where('status', PostStatus::Rejected->value)->count();

            $stats = [
                'total_submitted' => $totalSubmitted,
                'total_published' => $totalPublished,
                'total_pending' => $totalPending,
                'total_rejected' => $totalRejected,
            ];

            $data['my_posts'] = $recentPosts;
            $data['total_submitted'] = $totalSubmitted;
            $data['total_published'] = $totalPublished;
            $data['total_pending'] = $totalPending;
            $data['total_rejected'] = $totalRejected;
        }

        $data['stats'] = $stats;
        $data['recentPosts'] = $recentPosts;
        $data['pendingReviews'] = $pendingReviews;

        return view('panel.dashboard', $data);
    }
}
