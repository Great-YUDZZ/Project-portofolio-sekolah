<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Major;
use App\Models\SiteSetting;
use App\Models\EcosystemLink;

class HomeController extends Controller
{
    public function index()
    {
        $fields = Field::with('majors')->get();
        $majors = Major::with('field')->orderBy('order_index')->get();
        $ecosystemLinks = EcosystemLink::orderBy('order_index')->get();

        $schoolName = SiteSetting::get('school_name', 'SMK Negeri 1 Denpasar');
        $slogan = SiteSetting::get('school_slogan', 'Abhyāsad Dhäryate Vidyä');
        $sloganMeaning = SiteSetting::get('school_slogan_meaning', 'Peliharalah ilmu sampai menjadi tradisi');
        $characterValues = SiteSetting::get('character_values', []);

        return view('public.home', compact(
            'fields',
            'majors',
            'ecosystemLinks',
            'schoolName',
            'slogan',
            'sloganMeaning',
            'characterValues'
        ));
    }
}
