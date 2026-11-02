<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    /**
     * Show 2FA Setup page (QR Code & Secret) for Admin.
     */
    public function setup(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return redirect()->route('panel.dashboard');
        }

        // Prevent secret leakage or overwrite when 2FA is already confirmed
        if ($user->hasTwoFactorEnabled()) {
            if ($request->session()->get('two_factor_verified', false)) {
                return redirect()->route('panel.dashboard');
            }

            return redirect()->route('two-factor.challenge');
        }

        $google2fa = new Google2FA();

        // Generate secret only during initial unconfirmed setup
        $secret = $user->two_factor_secret;
        if (!$secret) {
            $secret = $google2fa->generateSecretKey(32);
            $user->two_factor_secret = $secret;
            $user->save();
        }

        $company = 'SMKN 1 Denpasar';
        $holder = $user->username ?: $user->email;
        $qrUrl = $google2fa->getQRCodeUrl($company, $holder, $secret);

        $renderer = new ImageRenderer(
            new RendererStyle(220, 1),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCodeSvg = $writer->writeString($qrUrl);

        return view('auth.two-factor-setup', [
            'user' => $user,
            'secret' => $secret,
            'qrCodeSvg' => $qrCodeSvg,
        ]);
    }

    /**
     * Confirm 2FA setup with first 6-digit code.
     */
    public function confirmSetup(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        // Block re-setup if 2FA is already active
        if ($user->hasTwoFactorEnabled()) {
            return redirect()->route('two-factor.challenge');
        }

        $throttleKey = '2fa-setup|' . $user->id . '|' . $request->ip();
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($throttleKey);
            AuditLog::record('auth.2fa.throttle_hit', $user, ['context' => 'setup', 'ip' => $request->ip()]);

            return back()->withErrors([
                'code' => "Terlalu banyak percobaan kode 2FA yang gagal. Silakan tunggu {$seconds} detik lagi.",
            ]);
        }

        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        if (!$user->two_factor_secret) {
            return redirect()->route('two-factor.setup');
        }

        $google2fa = new Google2FA();
        try {
            $valid = $google2fa->verifyKey($user->two_factor_secret, $request->code);
        } catch (\Throwable) {
            $valid = false;
        }

        if (!$valid) {
            \Illuminate\Support\Facades\RateLimiter::hit($throttleKey, 60);
            AuditLog::record('auth.2fa.setup_failed', $user, ['ip' => $request->ip()]);

            return back()->withErrors(['code' => 'Kode autentikasi 6 digit tidak cocok. Silakan coba lagi.']);
        }

        \Illuminate\Support\Facades\RateLimiter::clear($throttleKey);

        // Generate 8 recovery codes
        $recoveryCodes = [];
        for ($i = 0; $i < 8; $i++) {
            $recoveryCodes[] = strtoupper(Str::random(10));
        }

        $user->two_factor_confirmed_at = now();
        $user->two_factor_recovery_codes = $recoveryCodes;
        $user->save();

        $request->session()->regenerate();
        $request->session()->put('two_factor_verified', true);
        AuditLog::record('auth.2fa.enabled', $user);

        return redirect()->route('panel.dashboard')
            ->with('success', 'Autentikasi dua faktor berhasil diaktifkan untuk akun administrator Anda.');
    }

    /**
     * Show 2FA Challenge page during login.
     */
    public function challenge()
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin() || !$user->hasTwoFactorEnabled()) {
            return redirect()->route('panel.dashboard');
        }

        if (session('two_factor_verified', false)) {
            return redirect()->route('panel.dashboard');
        }

        return view('auth.two-factor-challenge');
    }

    /**
     * Verify 2FA challenge code or recovery code.
     */
    public function verifyChallenge(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin() || !$user->hasTwoFactorEnabled()) {
            return redirect()->route('panel.dashboard');
        }

        $throttleKey = '2fa-challenge|' . $user->id . '|' . $request->ip();
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($throttleKey);
            AuditLog::record('auth.2fa.throttle_hit', $user, ['context' => 'challenge', 'ip' => $request->ip()]);

            return back()->withErrors([
                'code' => "Terlalu banyak percobaan verifikasi 2FA yang gagal. Silakan tunggu {$seconds} detik lagi.",
            ]);
        }

        $request->validate([
            'code' => ['nullable', 'string', 'max:20'],
            'recovery_code' => ['nullable', 'string', 'max:32'],
        ]);

        $google2fa = new Google2FA();

        // 1. Try TOTP code
        if ($request->filled('code')) {
            $code = preg_replace('/\s+/', '', (string) $request->code);
            $totpValid = false;
            if (strlen($code) === 6 && ctype_digit($code)) {
                try {
                    $totpValid = (bool) $google2fa->verifyKey($user->two_factor_secret, $code);
                } catch (\Throwable) {
                    $totpValid = false;
                }
            }

            if ($totpValid) {
                \Illuminate\Support\Facades\RateLimiter::clear($throttleKey);
                $request->session()->regenerate();
                $request->session()->put('two_factor_verified', true);
                AuditLog::record('auth.2fa.verified', $user, ['method' => 'totp']);

                return redirect()->intended(route('panel.dashboard'))
                    ->with('success', 'Verifikasi autentikasi dua faktor berhasil.');
            }
        }

        // 2. Try Recovery code with constant-time comparison
        if ($request->filled('recovery_code')) {
            $recCode = strtoupper(trim((string) $request->recovery_code));
            $codes = is_array($user->two_factor_recovery_codes) ? $user->two_factor_recovery_codes : [];
            $matchedIndex = null;

            foreach ($codes as $idx => $storedCode) {
                if (is_string($storedCode) && hash_equals($storedCode, $recCode)) {
                    $matchedIndex = $idx;
                    break;
                }
            }

            if ($matchedIndex !== null) {
                unset($codes[$matchedIndex]);
                $user->two_factor_recovery_codes = array_values($codes);
                $user->save();

                \Illuminate\Support\Facades\RateLimiter::clear($throttleKey);
                $request->session()->regenerate();
                $request->session()->put('two_factor_verified', true);
                AuditLog::record('auth.2fa.recovery_used', $user);

                return redirect()->intended(route('panel.dashboard'))
                    ->with('warning', 'Anda menggunakan recovery code darurat. Sisa recovery code: ' . count($codes));
            }
        }

        \Illuminate\Support\Facades\RateLimiter::hit($throttleKey, 60);
        AuditLog::record('auth.2fa.failed', $user, ['ip' => $request->ip()]);

        return back()->withErrors(['code' => 'Kode autentikasi atau recovery code tidak valid.']);
    }
}
