<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('warning', 'Silakan masuk terlebih dahulu untuk mengakses halaman ini.');
        }

        $user = Auth::user();

        // Cek apakah role user cocok dengan salah satu role yang diizinkan
        $userRoleValue = $user->role instanceof Role ? $user->role->value : (string)$user->role;

        if (!in_array($userRoleValue, $roles)) {
            abort(403, 'Akses ditolak: Anda tidak memiliki wewenang untuk membuka halaman ini.');
        }

        return $next($request);
    }
}
