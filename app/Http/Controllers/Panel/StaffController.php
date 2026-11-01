<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\StaffMember;
use App\Services\MediaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', StaffMember::class);

        $query = StaffMember::query()->orderBy('order_index')->orderBy('name');

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('role_title', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($dept = $request->input('department')) {
            $query->where('department', $dept);
        }

        $staff = $query->paginate(15)->withQueryString();
        $departments = StaffMember::distinct()->whereNotNull('department')->pluck('department');

        return view('panel.staff.index', compact('staff', 'departments'));
    }

    public function create(): View
    {
        Gate::authorize('create', StaffMember::class);

        return view('panel.staff.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', StaffMember::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'role_title' => ['required', 'string', 'max:100'],
            'department' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:150'],
            'order_index' => ['nullable', 'integer', 'min:0'],
            'photo' => ['nullable', 'file', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $media = MediaService::storeImage($request->file('photo'), $request->user(), "Foto {$validated['name']}");
            $photoPath = $media->path;
        }

        $staff = StaffMember::create([
            'name' => $validated['name'],
            'role_title' => $validated['role_title'],
            'department' => $validated['department'] ?? 'Pendidik',
            'email' => $validated['email'] ?? null,
            'order_index' => $validated['order_index'] ?? 0,
            'photo' => $photoPath,
        ]);

        AuditLog::record(
            action: 'create_staff',
            auditable: $staff,
            description: "Menambahkan data staf: {$staff->name} ({$staff->role_title})"
        );

        return redirect()->route('panel.staff.index')
            ->with('status', "Data staf {$staff->name} berhasil ditambahkan.");
    }

    public function edit(StaffMember $staff): View
    {
        Gate::authorize('update', $staff);

        return view('panel.staff.edit', compact('staff'));
    }

    public function update(Request $request, StaffMember $staff): RedirectResponse
    {
        Gate::authorize('update', $staff);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'role_title' => ['required', 'string', 'max:100'],
            'department' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:150'],
            'order_index' => ['nullable', 'integer', 'min:0'],
            'photo' => ['nullable', 'file', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
        ]);

        if ($request->hasFile('photo')) {
            $media = MediaService::storeImage($request->file('photo'), $request->user(), "Foto {$validated['name']}");
            $validated['photo'] = $media->path;
        } else {
            unset($validated['photo']);
        }

        $staff->update($validated);

        AuditLog::record(
            action: 'update_staff',
            auditable: $staff,
            description: "Memperbarui data staf: {$staff->name}"
        );

        return redirect()->route('panel.staff.index')
            ->with('status', "Data staf {$staff->name} berhasil diperbarui.");
    }

    public function destroy(StaffMember $staff): RedirectResponse
    {
        Gate::authorize('delete', $staff);

        $name = $staff->name;
        $staff->delete();

        AuditLog::record(
            action: 'delete_staff',
            auditable: $staff,
            description: "Menghapus data staf: {$name}"
        );

        return redirect()->route('panel.staff.index')
            ->with('status', "Data staf {$name} berhasil dihapus.");
    }
}
