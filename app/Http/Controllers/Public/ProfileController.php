<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\StaffMember;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $pages = Page::orderBy('id')->get()->keyBy('slug');
        $settings = SiteSetting::pluck('value', 'key');
        $facilities = Facility::orderBy('id')->get();
        $principal = StaffMember::orderBy('order_index')->first();
        $vicePrincipals = StaffMember::where('department', 'like', '%Wakil Kepala%')
            ->orderBy('order_index')
            ->get();

        return view('public.profile', compact(
            'pages',
            'settings',
            'facilities',
            'principal',
            'vicePrincipals'
        ));
    }
}
