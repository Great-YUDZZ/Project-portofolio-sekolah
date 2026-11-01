<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExtracurricularController extends Controller
{
    public function index(Request $request): View
    {
        $category = (string) $request->query('kategori', '');
        $search = trim((string) $request->query('q', ''));

        $query = Extracurricular::query()->orderBy('order_index');

        if (in_array($category, ['non-akademik', 'akademik'], true)) {
            $query->where('category', $category);
        }

        if ($search !== '') {
            $query->search($search);
        }

        $extracurriculars = $query->get();

        $stats = [
            'total' => Extracurricular::count(),
            'non_akademik' => Extracurricular::nonAcademic()->count(),
            'akademik' => Extracurricular::academic()->count(),
        ];

        return view('public.extracurriculars.index', compact(
            'extracurriculars',
            'category',
            'search',
            'stats'
        ));
    }
}
