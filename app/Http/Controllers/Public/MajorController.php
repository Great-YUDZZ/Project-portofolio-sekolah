<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MajorController extends Controller
{
    public function index(Request $request): View
    {
        $fieldSlug = $request->query('bidang');
        $fields = Field::withCount('majors')->orderBy('id')->get();

        $majorsQuery = Major::with('field')->orderBy('order_index');
        if ($fieldSlug) {
            $majorsQuery->whereHas('field', fn ($q) => $q->where('slug', $fieldSlug));
        }

        $majors = $majorsQuery->get();

        return view('public.majors.index', compact('fields', 'majors', 'fieldSlug'));
    }

    public function show(string $slug): View
    {
        $major = Major::with(['field', 'classrooms', 'studentWorks', 'achievements'])
            ->where('slug', $slug)
            ->firstOrFail();

        $otherMajors = Major::where('id', '!=', $major->id)
            ->orderBy('order_index')
            ->get();

        return view('public.majors.show', compact('major', 'otherMajors'));
    }
}
