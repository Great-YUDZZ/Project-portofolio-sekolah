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

        if (!$user->isAdmin()) {
            return redirect()->route('panel.dashboard');
        }

        $google2fa = new Google2FA();

        // If not generated yet or re-setting, generate secret
        $secret = $user->two_factor_secret;
        if (!$secret || !$user->two_factor_confirmed_at) {
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
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $user = Auth::user();
        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey($user->two_factor_secret, $request->code);

        if (!$valid) {
            return back()->withErrors(['code' => 'Kode autentikasi 6 digit tidak cocok. Silakan coba lagi.']);
        }

        // Generate 8 recovery codes
        $recoveryCodes = [];
        for ($i = 0; $i < 8; $i++) {
            $recoveryCodes[] = strtoupper(Str::random(10));
        }

        $user->two_factor_confirmed_at = now();
        $user->two_factor_recovery_codes = $recoveryCodes;
        $user->save();

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
        $request->validate([
            'code' => ['nullable', 'string'],
            'recovery_code' => ['nullable', 'string'],
        ]);

        $user = Auth::user();
        $google2fa = new Google2FA();

        // 1. Try TOTP code
        if ($request->filled('code')) {
            $code = str_replace(' ', '', $request->code);
            if ($google2fa->verifyKey($user->two_factor_secret, $code)) {
                $request->session()->put('two_factor_verified', true);
                AuditLog::record('auth.2fa.verified', $user, ['method' => 'totp']);

                return redirect()->intended(route('panel.dashboard'))
                    ->with('success', 'Verifikasi autentikasi dua faktor berhasil.');
            }
        }

        // 2. Try Recovery code
        if ($request->filled('recovery_code')) {
            $recCode = strtoupper(trim($request->recovery_code));
            $codes = $user->two_factor_recovery_codes ?: [];

            if (($idx = array_search($recCode, $codes)) !== false) {
                // Use code once and remove
                unset($codes[$idx]);
                $user->two_factor_recovery_codes = array_values($codes);
                $user->save();

                $request->session()->put('two_factor_verified', true);
                AuditLog::record('auth.2fa.recovery_used', $user);

                return redirect()->intended(route('panel.dashboard'))
                    ->with('warning', 'Anda menggunakan recovery code darurat. Sisa recovery code: ' . count($codes));
            }
        }

        return back()->withErrors(['code' => 'Kode autentikasi atau recovery code tidak valid.']);
    }
}
