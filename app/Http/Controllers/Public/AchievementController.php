<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AchievementController extends Controller
{
    public function index(Request $request): View
    {
        $level = $request->query('tingkat');
        $majorCode = $request->query('jurusan');

        $query = Achievement::with('major')->orderByDesc('year')->latest();

        if ($level) {
            $query->where('level', 'like', "%{$level}%");
        }

        if ($majorCode) {
            $query->whereHas('major', fn ($q) => $q->where('code', $majorCode)->orWhere('slug', $majorCode));
        }

        $achievements = $query->get();
        $majors = Major::orderBy('order_index')->get();

        return view('public.achievements', compact('achievements', 'majors', 'level', 'majorCode'));
    }
}
