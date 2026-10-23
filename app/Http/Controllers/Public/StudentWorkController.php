<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\StudentWork;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentWorkController extends Controller
{
    public function index(Request $request): View
    {
        $majorCode = $request->query('jurusan');
        $year = $request->query('tahun');

        $query = StudentWork::with('major')->latest();

        if ($majorCode) {
            $query->whereHas('major', fn ($q) => $q->where('code', $majorCode)->orWhere('slug', $majorCode));
        }

        if ($year && is_numeric($year)) {
            $query->where('year', (int) $year);
        }

        $works = $query->get();
        $majors = Major::orderBy('order_index')->get();
        $years = StudentWork::select('year')->distinct()->orderByDesc('year')->pluck('year');

        return view('public.works', compact('works', 'majors', 'years', 'majorCode', 'year'));
    }
}
