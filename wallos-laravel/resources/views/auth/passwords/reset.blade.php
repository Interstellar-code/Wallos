@extends('layouts.app')

@section('content')
<div class="content">
    <section class="container">
        <header>
            <div class="logo-image" title="Wallos - Subscription Tracker">
                @include('partials.logo')
            </div>
            <p>{{ __('reset_password') }}</p>
        </header>
        
        <div class="login-subtitle">{{ __('reset.subtitle') ?? 'Enter your new password below' }}</div>
        
        <form method="POST" action="{{ route('auth.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">{{ __('email') }}:</label>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('password') }}:</label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('confirm_password') }}:</label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                <div id="password-match-error" class="error-message" style="display:none">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Passwords do not match</span>
                </div>
            </div>

            @if($errors->any())
                <ul class="error-box">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa-solid fa-triangle-exclamation"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('reset_password') }}
                </button>
            </div>
        </form>

        <div class="login-form-link">
            <p>Remember your password? <a href="{{ route('auth.login') }}">Sign in</a></p>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add password matching validation
    const password = document.getElementById('password');
    const confirm = document.getElementById('password-confirm');
    const matchError = document.getElementById('password-match-error');
    
    function validatePasswordMatch() {
        if (password.value && confirm.value && password.value !== confirm.value) {
            matchError.style.display = 'flex';
            confirm.classList.add('is-invalid');
        } else {
            matchError.style.display = 'none';
            confirm.classList.remove('is-invalid');
        }
    }
    
    password.addEventListener('input', validatePasswordMatch);
    confirm.addEventListener('input', validatePasswordMatch);
    
    // Add form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        if (password.value !== confirm.value) {
            e.preventDefault();
            validatePasswordMatch();
        }
    });
    
    // Add focus effects
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