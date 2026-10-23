<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Classroom;
use App\Models\ContactMessage;
use App\Models\Major;
use App\Models\Post;
use App\Models\StudentWork;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_students' => User::where('role', 'siswa')->count(),
            'total_teachers' => User::where('role', 'guru')->count(),
            'total_majors' => Major::count(),
            'total_classrooms' => Classroom::count(),
            'total_posts' => Post::count(),
            'total_works' => StudentWork::count(),
            'total_achievements' => Achievement::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
        ];

        $majors = Major::with('field')->withCount('classrooms')->orderBy('order_index')->get();
        $recentUsers = User::latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'majors', 'recentUsers', 'recentMessages'));
    }
}
