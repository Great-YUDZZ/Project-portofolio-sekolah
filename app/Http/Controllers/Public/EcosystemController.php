<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\EcosystemLink;
use Illuminate\View\View;

class EcosystemController extends Controller
{
    public function index(): View
    {
        $links = EcosystemLink::orderBy('order_index')->get();

        return view('public.ecosystem', compact('links'));
    }
}
