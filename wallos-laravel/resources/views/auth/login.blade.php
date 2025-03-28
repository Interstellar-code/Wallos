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
        
        <div class="login-subtitle">{{ __('login.subtitle') ?? 'Sign in to your account' }}</div>
        
        <form method="POST" action="{{ route('auth.login') }}">
            @csrf

            <div class="form-group">
                <label for="username">{{ __('username') }}:</label>
                <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                @error('username')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('password') }}:</label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            @if(!config('app.demo_mode'))
                <div class="form-group-inline">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">{{ __('stay_logged_in') }}</label>
                </div>
            @endif

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

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('login') }}
                </button>
            </div>

            @if(config('mail.enabled'))
                <div class="login-form-link">
                    <a href="{{ route('auth.password.request') }}">{{ __('forgot_password') }}</a>
                </div>
            @endif

            @if(config('auth.registration_enabled'))
                <div class="separator">
                    <a href="{{ route('auth.register') }}" class="secondary-button">
                        {{ __('register') }}
                    </a>
                </div>
            @endif
        </form>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add any login-specific JavaScript here
    const inputs = document.querySelectorAll('input[type="text"], input[type="password"], input[type="email"]');
    
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
});
</script>
@endpush