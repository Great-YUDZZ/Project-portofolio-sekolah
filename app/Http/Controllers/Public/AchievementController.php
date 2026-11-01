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

        $stats = [
            'total' => Achievement::count(),
            'gold' => Achievement::where('rank', 'like', '%Emas%')->orWhere('rank', 'like', '%Juara 1%')->count(),
            'national' => Achievement::where('level', 'like', '%Nasional%')->count(),
            'provincial' => Achievement::where('level', 'like', '%Provinsi%')->count(),
        ];

        $hallOfFame = Achievement::with('major')
            ->where('level', 'Nasional')
            ->where(function ($q) {
                $q->where('rank', 'like', '%Emas%')->orWhere('rank', 'like', '%Juara 1%');
            })
            ->orderByDesc('year')
            ->take(3)
            ->get();

        return view('public.achievements', compact('achievements', 'majors', 'level', 'majorCode', 'stats', 'hallOfFame'));
    }
}
