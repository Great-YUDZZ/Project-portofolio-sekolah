<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditLogController extends Controller
{
    public function index(Request $request): View
    {
        if (!$request->user()->isAdmin()) {
            abort(403, 'Hanya Administrator yang memiliki akses ke catatan audit keamanan.');
        }

        $query = AuditLog::query()->with('user')->latest();

        if ($action = $request->input('action')) {
            $query->where('action', $action);
        }

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }

        $logs = $query->paginate(25)->withQueryString();
        $actions = AuditLog::distinct()->pluck('action');

        return view('panel.audit.index', compact('logs', 'actions'));
    }
}
