<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
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
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'NIS, NIP, atau Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $throttleKey = Str($request->input('username') . '|' . $request->ip())->lower();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'username' => "Terlalu banyak percobaan masuk. Silakan tunggu {$seconds} detik lagi.",
            ]);
        }

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            $user = Auth::user();
            return $this->redirectBasedOnRole($user)
                ->with('success', "Selamat datang kembali, {$user->name}!");
        }

        RateLimiter::hit($throttleKey, 60);

        throw ValidationException::withMessages([
            'username' => 'Kombinasi Username/NIS dan Password tidak sesuai.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info', 'Anda telah berhasil keluar.');
    }

    protected function redirectBasedOnRole($user)
    {
        if ($user->role === Role::Admin) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('lms.dashboard'));
    }
}
