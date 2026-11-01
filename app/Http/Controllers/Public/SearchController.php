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
        $rawQuery = trim((string) $request->query('q', ''));
        $q = mb_substr($rawQuery, 0, 100);

        $majors = collect();
        $posts = collect();
        $works = collect();
        $achievements = collect();
        $staff = collect();

        if ($q !== '') {
            $escaped = addcslashes($q, '%_\\');
            $pattern = "%{$escaped}%";

            $majors = Major::with('field')
                ->where(function ($query) use ($pattern) {
                    $query->where('name', 'like', $pattern)
                        ->orWhere('code', 'like', $pattern)
                        ->orWhere('tagline', 'like', $pattern)
                        ->orWhere('description', 'like', $pattern);
                })
                ->limit(30)
                ->get();

            $posts = Post::where('is_published', true)
                ->where(function ($query) use ($pattern) {
                    $query->where('title', 'like', $pattern)
                        ->orWhere('excerpt', 'like', $pattern)
                        ->orWhere('content', 'like', $pattern);
                })
                ->latest('published_at')
                ->limit(30)
                ->get();

            $works = StudentWork::with('major')
                ->where(function ($query) use ($pattern) {
                    $query->where('title', 'like', $pattern)
                        ->orWhere('student_name', 'like', $pattern)
                        ->orWhere('description', 'like', $pattern);
                })
                ->limit(30)
                ->get();

            $achievements = Achievement::with('major')
                ->where(function ($query) use ($pattern) {
                    $query->where('title', 'like', $pattern)
                        ->orWhere('student_or_team', 'like', $pattern)
                        ->orWhere('description', 'like', $pattern);
                })
                ->limit(30)
                ->get();

            $staff = StaffMember::where(function ($query) use ($pattern) {
                $query->where('name', 'like', $pattern)
                    ->orWhere('role_title', 'like', $pattern)
                    ->orWhere('department', 'like', $pattern);
            })
                ->limit(30)
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
