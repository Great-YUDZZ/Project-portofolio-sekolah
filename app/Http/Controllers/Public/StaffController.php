<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\StaffMember;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function index(Request $request): View
    {
        $group = $request->query('group');
        $search = trim((string) $request->query('q', ''));

        $query = StaffMember::query()->orderBy('order_index');

        if ($group) {
            $query->where(function ($q) use ($group) {
                $q->where('department', 'like', "%{$group}%")
                    ->orWhere('role_title', 'like', "%{$group}%");
            });
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('role_title', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            });
        }

        $staffMembers = $query->get();

        return view('public.staff', compact(
            'staffMembers',
            'group',
            'search'
        ));
    }
}
