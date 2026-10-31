<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\EcosystemLink;
use App\Models\Event;
use App\Models\Facility;
use App\Models\Field;
use App\Models\Major;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\StaffMember;
use App\Models\StudentWork;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $fields = Field::withCount('majors')->orderBy('id')->get();
        $majors = Major::with('field')->orderBy('order_index')->get();
        $settings = SiteSetting::pluck('value', 'key');

        $featuredWorks = StudentWork::with('major')
            ->latest()
            ->take(6)
            ->get();

        $achievements = Achievement::with('major')
            ->orderByDesc('year')
            ->latest()
            ->take(4)
            ->get();

        $posts = Post::where('is_published', true)
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        $events = Event::orderBy('start_time')
            ->take(4)
            ->get();

        $facilities = Facility::orderBy('id')->take(4)->get();
        $leaders = StaffMember::orderBy('order_index')->take(5)->get();
        $ecosystemLinks = EcosystemLink::orderBy('order_index')->get();

        return view('public.home', compact(
            'fields',
            'majors',
            'settings',
            'featuredWorks',
            'achievements',
            'posts',
            'events',
            'facilities',
            'leaders',
            'ecosystemLinks'
        ));
    }
}
