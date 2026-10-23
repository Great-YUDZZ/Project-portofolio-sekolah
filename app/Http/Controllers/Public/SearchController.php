<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Major;
use App\Models\Post;
use App\Models\StaffMember;
use App\Models\StudentWork;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));

        $majors = collect();
        $posts = collect();
        $works = collect();
        $achievements = collect();
        $staff = collect();

        if ($q !== '') {
            $majors = Major::with('field')
                ->where('name', 'like', "%{$q}%")
                ->orWhere('code', 'like', "%{$q}%")
                ->orWhere('tagline', 'like', "%{$q}%")
                ->orWhere('description', 'like', "%{$q}%")
                ->get();

            $posts = Post::where('is_published', true)
                ->where(function ($query) use ($q) {
                    $query->where('title', 'like', "%{$q}%")
                        ->orWhere('excerpt', 'like', "%{$q}%")
                        ->orWhere('content', 'like', "%{$q}%");
                })
                ->latest('published_at')
                ->get();

            $works = StudentWork::with('major')
                ->where('title', 'like', "%{$q}%")
                ->orWhere('student_name', 'like', "%{$q}%")
                ->orWhere('description', 'like', "%{$q}%")
                ->get();

            $achievements = Achievement::with('major')
                ->where('title', 'like', "%{$q}%")
                ->orWhere('student_or_team', 'like', "%{$q}%")
                ->orWhere('description', 'like', "%{$q}%")
                ->get();

            $staff = StaffMember::where('name', 'like', "%{$q}%")
                ->orWhere('role_title', 'like', "%{$q}%")
                ->orWhere('department', 'like', "%{$q}%")
                ->get();
        }

        $totalResults = $majors->count() + $posts->count() + $works->count() + $achievements->count() + $staff->count();

        return view('public.search', compact(
            'q',
            'majors',
            'posts',
            'works',
            'achievements',
            'staff',
            'totalResults'
        ));
    }
}
