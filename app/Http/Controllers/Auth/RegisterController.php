<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Show registration form for students.
     */
    public function showRegistrationForm()
    {
        $majors = Major::orderBy('order_index')->get();
        $classrooms = Classroom::orderBy('grade_level')->orderBy('name')->get();

        return view('auth.register', [
            'majors' => $majors,
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Process student self-registration.
     */
    public function register(Request $request)
    {
        // 1. Anti-bot Honeypot check
        if ($request->filled('institution_website_hp')) {
            // Silently fail bots
            return redirect()->route('login')->with('success', 'Permintaan registrasi Anda telah diproses.');
        }

        // 2. IP Rate limiting (5 per hour)
        $throttleKey = 'register-ip|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);
            throw ValidationException::withMessages([
                'nis' => "Terlalu banyak permintaan pendaftaran dari jaringan Anda. Silakan coba kembali dalam {$minutes} menit.",
            ]);
        }

        // 3. Validation
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'nis' => ['required', 'string', 'regex:/^[0-9]{4,15}$/', 'unique:users,username', 'unique:student_profiles,nis'],
            'major_id' => ['required', 'exists:majors,id'],
            'classroom_id' => ['nullable', 'exists:classrooms,id'],
            'gender' => ['nullable', 'in:L,P'],
            'email' => ['nullable', 'email', 'max:150', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => [
                'required',
                'confirmed',
                Password::min(10)
                    ->letters()
                    ->numbers()
                    ->uncompromised(),
            ],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'nis.required' => 'Nomor Induk Siswa (NIS) wajib diisi.',
            'nis.regex' => 'NIS hanya boleh berupa angka (4-15 digit).',
            'nis.unique' => 'NIS ini sudah terdaftar di sistem Skensa.',
            'major_id.required' => 'Pilih konsentrasi keahlian jurusan Anda.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal harus 10 karakter.',
        ]);

        RateLimiter::hit($throttleKey, 3600);

        // 4. Create user and profile in transaction
        DB::transaction(function () use ($validated, $request) {
            $user = User::create([
                'name' => $validated['name'],
                'username' => $validated['nis'],
                'email' => $validated['email'] ?? null,
                'role' => Role::Siswa,
                'status' => UserStatus::Pending,
                'major_id' => $validated['major_id'],
                'phone' => $validated['phone'] ?? null,
                'password' => Hash::make($validated['password']),
            ]);

            StudentProfile::create([
                'user_id' => $user->id,
                'classroom_id' => $validated['classroom_id'] ?? null,
                'nis' => $validated['nis'],
                'gender' => $validated['gender'] ?? 'L',
            ]);

            AuditLog::record('user.registered', $user, [
                'nis' => $validated['nis'],
                'major_id' => $validated['major_id'],
            ]);
        });

        return redirect()->route('login')->with(
            'warning',
            'Pendaftaran berhasil diajukan! Akun Anda saat ini berstatus Menunggu Aktivasi dan akan diverifikasi oleh guru jurusan Anda atau administrator sebelum dapat digunakan untuk masuk.'
        );
    }
}
