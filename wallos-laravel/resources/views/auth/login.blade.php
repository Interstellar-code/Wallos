@extends('layouts.app')

@section('content')
<div class="content">
    <section class="container">
        <header>
            <div class="logo-image" title="Wallos - Subscription Tracker">
                @include('partials.logo')
            </div>
            <p>{{ __('please_login') }}</p>
        </header>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="username">{{ __('username') }}:</label>
                <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('password') }}:</label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            @if(!config('app.demo_mode'))
                <div class="form-group-inline">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">{{ __('stay_logged_in') }}</label>
                </div>
            @endif

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('login') }}
                </button>
            </div>

            @if(session('error'))
                <ul class="error-box">
                    <li><i class="fa-solid fa-triangle-exclamation"></i>{{ session('error') }}</li>
                </ul>
            @endif

            @if(session('success'))
                <ul class="success-box">
                    <li><i class="fa-solid fa-check"></i>{{ session('success') }}</li>
                </ul>
            @endif

            @if(config('mail.enabled'))
                <div class="login-form-link">
                    <a href="{{ route('password.request') }}">{{ __('forgot_password') }}</a>
                </div>
            @endif

            @if(config('auth.registration_enabled'))
                <div class="separator">
                    <a href="{{ route('register') }}" class="secondary-button">
                        {{ __('register') }}
                    </button>
                </div>
            @endif
        </form>
    </section>
</div>
@endsection