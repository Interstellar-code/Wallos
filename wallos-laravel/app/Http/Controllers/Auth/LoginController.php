<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
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
    }