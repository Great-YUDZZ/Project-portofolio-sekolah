<?php

namespace App\Http\Controllers\Lms;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LmsDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Data dinamis akan diperluas pada Fase 3
        return view('lms.dashboard', compact('user'));
    }
}
