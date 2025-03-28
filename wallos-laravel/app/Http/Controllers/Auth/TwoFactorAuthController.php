<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OTPHP\TOTP;
use App\Models\User;

class TwoFactorAuthController extends Controller
{
    public function showVerificationForm(): View
    {
        return view('auth.two-factor');
    }

    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => 'required|string',
            'use_recovery' => 'nullable|boolean'
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();
        $code = $request->code;

        // Check recovery code if requested
        if ($request->use_recovery && $user->useRecoveryCode($code)) {
            $request->session()->put('2fa_verified', true);
            return redirect()->intended('/');
        }

        // Check TOTP code
        if (!$request->use_recovery && $this->verifyCode($code)) {
            $request->session()->put('2fa_verified', true);
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'code' => $request->use_recovery
                ? 'Invalid recovery code'
                : 'Invalid authentication code'
        ]);
    }

    public function showRecoveryCodes()
    {
        $codes = \Illuminate\Support\Facades\Auth::user()->two_factor_recovery_codes;
        return view('auth.two-factor-recovery', ['codes' => $codes]);
    }

    public function generateNewRecoveryCodes()
    {
        $codes = \Illuminate\Support\Facades\Auth::user()->generateRecoveryCodes();
        return view('auth.two-factor-recovery', ['codes' => $codes]);
    }

    protected function verifyCode(string $code): bool
    {
        try {
            $user = \Illuminate\Support\Facades\Auth::user();
            
            if (empty($user->two_factor_secret)) {
                return false;
            }

            $otp = new \OTPHP\TOTP(
                $user->email, // Use email as label
                $user->two_factor_secret,
                30,   // 30-second window
                'sha1',
                6     // 6-digit codes
            );

            return $otp->verify($code, null, 1); // Allow 1 window of leeway
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('2FA verification failed: '.$e->getMessage());
            return false;
        }
    }
}