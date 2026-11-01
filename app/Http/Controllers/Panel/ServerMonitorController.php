<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Services\ServerMetrics;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServerMonitorController extends Controller
{
    public function index(Request $request): View
    {
        if (!$request->user()->isAdmin()) {
            abort(403, 'Hanya Administrator yang memiliki akses ke pemantau beban server.');
        }

        $metrics = ServerMetrics::getMetrics();

        return view('panel.server', compact('metrics'));
    }

    public function poll(Request $request): JsonResponse
    {
        if (!$request->user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $metrics = ServerMetrics::getMetrics();

        return response()->json($metrics);
    }
}
