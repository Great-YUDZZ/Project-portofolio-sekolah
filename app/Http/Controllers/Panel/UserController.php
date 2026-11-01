<?php

namespace App\Http\Controllers\Panel;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', User::class);

        $currentUser = $request->user();
        $query = User::query()->with('major')->latest();

        // Guru can only view students of their major
        if ($currentUser->isGuru()) {
            $query->where('role', 'siswa')
                  ->where('major_id', $currentUser->major_id);
        } else {
            // Admin can filter by role
            if ($role = $request->input('role')) {
                $query->where('role', $role);
            }
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(15)->withQueryString();
        $majors = Major::orderBy('name')->get();

        // Count pending students for banner/badge
        $pendingCount = 0;
        if ($currentUser->isAdmin()) {
            $pendingCount = User::where('role', 'siswa')->where('status', UserStatus::Pending)->count();
        } elseif ($currentUser->isGuru() && $currentUser->major_id) {
            $pendingCount = User::where('role', 'siswa')
                ->where('major_id', $currentUser->major_id)
                ->where('status', UserStatus::Pending)
                ->count();
        }

        return view('panel.users.index', compact('users', 'majors', 'pendingCount'));
    }

    public function createGuru(): View
    {
        Gate::authorize('create', User::class);

        $majors = Major::orderBy('name')->get();

        return view('panel.users.create-guru', compact('majors'));
    }

    public function storeGuru(Request $request): RedirectResponse
    {
        Gate::authorize('create', User::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'nip' => ['nullable', 'string', 'max:50'],
            'major_id' => ['required', 'exists:majors,id'],
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'role' => 'guru',
            'status' => UserStatus::Active,
            'major_id' => $validated['major_id'],
            'password' => Hash::make($validated['password']),
        ]);

        TeacherProfile::create([
            'user_id' => $user->id,
            'nip' => $validated['nip'] ?? null,
            'major_id' => $validated['major_id'],
        ]);

        AuditLog::record(
            action: 'create_guru',
            auditable: $user,
            description: "Membuat akun Guru: {$user->name} ({$user->username}) untuk kejuruan ID {$user->major_id}"
        );

        return redirect()->route('panel.users.index', ['role' => 'guru'])
            ->with('status', "Akun Guru '{$user->name}' berhasil dibuat.");
    }

    public function activateStudent(Request $request, User $user): RedirectResponse
    {
        Gate::authorize('activateStudent', $user);

        $user->update([
            'status' => UserStatus::Active,
            'activated_by' => $request->user()->id,
            'rejection_reason' => null,
        ]);

        AuditLog::record(
            action: 'activate_student',
            auditable: $user,
            description: "Menyetujui dan mengaktifkan akun siswa: {$user->name} ({$user->username})"
        );

        return back()->with('status', "Akun siswa {$user->name} berhasil diaktifkan. Siswa kini dapat masuk ke panel.");
    }

    public function rejectStudent(Request $request, User $user): RedirectResponse
    {
        Gate::authorize('rejectStudent', $user);

        $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ]);

        $user->update([
            'status' => UserStatus::Suspended,
            'rejection_reason' => $request->input('reason'),
        ]);

        AuditLog::record(
            action: 'reject_student',
            auditable: $user,
            description: "Menolak aktivasi akun siswa: {$user->name} dengan alasan: {$request->input('reason')}"
        );

        return back()->with('status', "Pendaftaran siswa {$user->name} telah ditolak.");
    }

    public function toggleStatus(Request $request, User $user): RedirectResponse
    {
        Gate::authorize('update', $user);

        if ($user->id === $request->user()->id) {
            return back()->withErrors(['error' => 'Anda tidak dapat mengubah status akun Anda sendiri.']);
        }

        $newStatus = $user->status === UserStatus::Active ? UserStatus::Suspended : UserStatus::Active;
        $user->update(['status' => $newStatus]);

        AuditLog::record(
            action: 'toggle_user_status',
            auditable: $user,
            description: "Mengubah status user {$user->username} menjadi: {$newStatus->value}"
        );

        return back()->with('status', "Status user {$user->username} diubah menjadi {$newStatus->label()}.");
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        Gate::authorize('delete', $user);

        $username = $user->username;
        $name = $user->name;
        $user->delete();

        AuditLog::record(
            action: 'delete_user',
            auditable: $user,
            description: "Menghapus akun pengguna: {$name} ({$username})"
        );

        return back()->with('status', "Pengguna {$name} ({$username}) berhasil dihapus.");
    }
}
