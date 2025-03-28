<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;

    class LoginController extends Controller
    {
        use AuthenticatesUsers;

        protected $redirectTo = '/';

        // Constructor removed as middleware is handled via routes or bootstrap/app.php

        public function username()
        {
            return 'username';
        }
    
        protected function authenticated(Request $request, $user): RedirectResponse
        {
            // Initialize session with user data
            session([
                'main_currency' => $user->main_currency,
                'language' => $user->language
            ]);
    
            // Handle 2FA if enabled
            if ($user->two_factor_enabled && !$request->session()->has('2fa_verified')) {
                return redirect()->route('2fa.verify');
            }
    
            return redirect()->intended($this->redirectPath());
        }
    
        protected function validateLogin(Request $request): void
        {
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);
        }
    }