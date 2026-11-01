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
        $group = (string) $request->query('group', '');
        $search = trim((string) $request->query('q', ''));

        $query = StaffMember::query()->orderBy('order_index');

        if ($group === 'manajemen') {
            $query->where(function ($q) {
                $q->where('role_title', 'like', '%Kepala%')
                    ->orWhere('role_title', 'like', '%Wakil%')
                    ->orWhere('department', 'like', '%Pimpinan%')
                    ->orWhere('department', 'like', '%Manajemen%');
            });
        } elseif ($group === 'kaprogli') {
            $query->where(function ($q) {
                $q->where('role_title', 'like', '%Ketua Program%')
                    ->orWhere('role_title', 'like', '%Kaprog%');
            });
        } elseif ($group === 'guru') {
            $query->where(function ($q) {
                $q->where('role_title', 'like', '%Guru%')
                    ->orWhere('department', 'like', '%Guru%');
            });
        } elseif ($group === 'tendik') {
            $query->where(function ($q) {
                $q->where('department', 'like', '%Tata Usaha%')
                    ->orWhere('role_title', 'like', '%Tata Usaha%')
                    ->orWhere('role_title', 'like', '%Laboran%')
                    ->orWhere('role_title', 'like', '%Perpustakaan%')
                    ->orWhere('department', 'like', '%Perpustakaan%');
            });
        } elseif ($group !== '') {
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

        $stats = [
            'total' => StaffMember::count(),
            'manajemen' => StaffMember::where(function ($q) {
                $q->where('role_title', 'like', '%Kepala%')
                    ->orWhere('role_title', 'like', '%Wakil%');
            })->count(),
            'kaprogli' => StaffMember::where('role_title', 'like', '%Ketua Program%')->count(),
            'guru' => StaffMember::where('role_title', 'like', '%Guru%')->count(),
            'tendik' => StaffMember::where(function ($q) {
                $q->where('department', 'like', '%Tata Usaha%')
                    ->orWhere('role_title', 'like', '%Laboran%')
                    ->orWhere('role_title', 'like', '%Perpustakaan%');
            })->count(),
        ];

        return view('public.staff', compact(
            'staffMembers',
            'group',
            'search',
            'stats'
        ));
    }
}
