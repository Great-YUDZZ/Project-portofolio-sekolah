<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // 2FA is strictly mandatory for Admin accounts
            if ($user->isAdmin()) {
                // If 2FA not set up yet, force setup
                if (!$user->hasTwoFactorEnabled()) {
                    if (!$request->routeIs('two-factor.setup*') && !$request->routeIs('logout')) {
                        return redirect()->route('two-factor.setup')
                            ->with('warning', 'Keamanan Wajib: Akun Administrator wajib mengaktifkan autentikasi dua faktor (2FA) Google Authenticator.');
                    }
                } else {
                    // 2FA enabled, check if session is verified
                    if (!$request->session()->get('two_factor_verified', false)) {
                        if (!$request->routeIs('two-factor.challenge*') && !$request->routeIs('logout')) {
                            return redirect()->route('two-factor.challenge');
                        }
                    }
                }
            }
        }

        return $next($request);
    }
}
