@extends('layouts.app')

@section('content')
<div class="content">
    <section class="container">
        <header>
            <div class="logo-image" title="Wallos - Subscription Tracker">
                @include('partials.logo')
            </div>
            <p>{{ __('forgot_password') }}</p>
        </header>
        
        <div class="login-subtitle">{{ __('password.reset.subtitle') ?? 'Enter your email to receive a password reset link' }}</div>
        
        <form method="POST" action="{{ url('/password/email') }}">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('email') }}:</label>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            @if(session('status'))
                <div class="success-box">
                    <li><i class="fa-solid fa-check"></i>{{ session('status') }}</li>
                </div>
            @endif

            @if($errors->any())
                <ul class="error-box">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa-solid fa-triangle-exclamation"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('send_reset_link') }}
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