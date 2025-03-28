@extends('layouts.app')

@section('content')
<div class="content">
    <section class="container">
        <header>
            <div class="logo-image" title="Wallos - Subscription Tracker">
                @include('partials.logo')
            </div>
            <p>{{ __('Two-Factor Authentication') }}</p>
        </header>
        
        <div class="login-subtitle">{{ __('2fa.subtitle') ?? 'Enter the authentication code from your authenticator app' }}</div>
        
        <form method="POST" action="{{ route('auth.2fa.verify') }}">
            @csrf

            <div class="form-group">
                <label for="code">{{ __('Authentication Code') }}:</label>
                <input id="code" type="text" class="@error('code') is-invalid @enderror" name="code" required autocomplete="one-time-code" autofocus>
                @error('code')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
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
                    {{ __('Verify') }}
                </button>
            </div>
        </form>

        <div class="login-form-link">
            <a href="{{ route('auth.2fa.recovery') }}">{{ __('Use a recovery code instead') }}</a>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto focus on the code input
    document.getElementById('code').focus();
    
    // Add focus effects
    const inputs = document.querySelectorAll('input[type="text"]');
    
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