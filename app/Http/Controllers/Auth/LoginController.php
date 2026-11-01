<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'NIS, NIP, Username, atau Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $identity = trim($request->input('username'));
        $ip = $request->ip();

        // 1. Dual-layer rate limiter: per Identity+IP and global per IP
        $throttleIdentityKey = Str::lower('login-user|' . $identity . '|' . $ip);
        $throttleIpKey = Str::lower('login-ip|' . $ip);

        if (RateLimiter::tooManyAttempts($throttleIdentityKey, 5) || RateLimiter::tooManyAttempts($throttleIpKey, 20)) {
            $seconds = max(
                RateLimiter::availableIn($throttleIdentityKey),
                RateLimiter::availableIn($throttleIpKey)
            );
            AuditLog::record('auth.throttle_hit', null, ['identity' => $identity, 'ip' => $ip]);

            throw ValidationException::withMessages([
                'username' => "Terlalu banyak percobaan masuk yang gagal. Silakan tunggu {$seconds} detik lagi sebelum mencoba kembali demi keamanan akun.",
            ]);
        }

        // Determine credential field (email or username)
        $field = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $field => $identity,
            'password' => $request->input('password'),
        ];

        // 2. Pre-check user account status
        $existingUser = User::where($field, $identity)->first();
        if ($existingUser) {
            if ($existingUser->status === UserStatus::Pending) {
                RateLimiter::hit($throttleIdentityKey, 60);
                RateLimiter::hit($throttleIpKey, 60);
                throw ValidationException::withMessages([
                    'username' => 'Akun Anda saat ini masih Menunggu Verifikasi Aktivasi oleh guru jurusan atau administrator.',
                ]);
            }

            if ($existingUser->status === UserStatus::Suspended) {
                RateLimiter::hit($throttleIdentityKey, 60);
                RateLimiter::hit($throttleIpKey, 60);
                throw ValidationException::withMessages([
                    'username' => 'Akun ini telah dinonaktifkan oleh administrator sekolah. Silakan hubungi tata usaha.',
                ]);
            }
        }

        $remember = $request->boolean('remember');

        // 3. Attempt authentication
        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear($throttleIdentityKey);
            RateLimiter::clear($throttleIpKey);
            $request->session()->regenerate();

            $user = Auth::user();
            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => $ip,
            ]);

            AuditLog::record('auth.login.success', $user);

            return $this->redirectBasedOnRole($user)
                ->with('success', "Selamat datang kembali di Panel Skensa, {$user->name}!");
        }

        // Hit rate limiters on failure
        RateLimiter::hit($throttleIdentityKey, 60);
        RateLimiter::hit($throttleIpKey, 60);

        AuditLog::record('auth.login.failed', null, ['identity' => $identity, 'ip' => $ip]);

        // Generic error message to prevent enumeration
        throw ValidationException::withMessages([
            'username' => 'Kombinasi identitas masuk dan kata sandi tidak sesuai dengan pangkalan data kami.',
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            AuditLog::record('auth.logout', $user);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info', 'Anda telah berhasil keluar dari sistem secara aman.');
    }

    protected function redirectBasedOnRole($user)
    {
        // Admin: enforce 2FA verification
        if ($user->isAdmin()) {
            if (!$user->hasTwoFactorEnabled()) {
                return redirect()->route('two-factor.setup');
            }
            if (!session('two_factor_verified', false)) {
                return redirect()->route('two-factor.challenge');
            }
        }

        return redirect()->intended(route('panel.dashboard'));
    }
}
