@extends('layouts.app')

@section('content')
<div class="content">
    <section class="container">
        <header>
            <div class="logo-image" title="Wallos - Subscription Tracker">
                @include('partials.logo')
            </div>
            <p>{{ __('auth.register.title') }}</p>
        </header>
        
        <div class="login-subtitle">{{ __('auth.register.subtitle') ?? 'Create your account to get started' }}</div>
        
        <form method="POST" action="{{ route('auth.register') }}">
            @csrf

            <div class="form-group">
                <label for="username">{{ __('username') }}:</label>
                <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus oninput="validateField(this)">
                @error('username')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">{{ __('email') }}:</label>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" oninput="validateField(this)">
                @error('email')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('password') }}:</label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" oninput="validateField(this)">
                @error('password')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('auth.register.confirm_password') }}:</label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" oninput="validateField(this)">
                <div id="password-match-error" class="error-message" style="display:none">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Passwords do not match</span>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="currency">{{ __('auth.register.main_currency') }}:</label>
                    <select id="currency" name="currency" required>
                        @foreach(config('currencies') as $currency)
                            <option value="{{ $currency['code'] }}" {{ old('currency') == $currency['code'] ? 'selected' : '' }}>
                                {{ $currency['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="language">{{ __('language') }}:</label>
                    <select id="language" name="language" onchange="changeLanguage(this.value)">
                        @foreach(config('languages') as $code => $language)
                            <option value="{{ $code }}" {{ app()->getLocale() == $code ? 'selected' : '' }}>
                                {{ $language['name'] }}
                            </option>
                        @endforeach
                    </select>
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
                    {{ __('auth.register.create_account') }}
                </button>
            </div>
        </form>

        @if(config('app.allow_database_restore') && $userCount == 0)
            <div class="separator">
                <button type="button" class="secondary-button" onclick="document.getElementById('restoreDBFile').click()">
                    {{ __('restore_database') }}
                </button>
                <input type="file" id="restoreDBFile" style="display: none;" accept=".zip">
            </div>
        @endif
        
        <div class="login-form-link">
            <p>Already have an account? <a href="{{ route('auth.login') }}">Sign in</a></p>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation specific to this view
    function validateField(field) {
        const errorDiv = field.nextElementSibling;
        
        if (field.checkValidity()) {
            field.classList.remove('is-invalid');
            if (errorDiv && errorDiv.classList.contains('error-message')) {
                errorDiv.style.display = 'none';
            }
        } else {
            field.classList.add('is-invalid');
            if (errorDiv && errorDiv.classList.contains('error-message')) {
                errorDiv.style.display = 'flex';
            }
        }

        // Special handling for password matching
        if (field.id === 'password' || field.id === 'password-confirm') {
            const password = document.getElementById('password');
            const confirm = document.getElementById('password-confirm');
            const matchError = document.getElementById('password-match-error');
            
            if (password.value && confirm.value && password.value !== confirm.value) {
                matchError.style.display = 'flex';
                confirm.classList.add('is-invalid');
            } else {
                matchError.style.display = 'none';
                confirm.classList.remove('is-invalid');
            }
        }
    }

    // Add event listeners
    document.querySelectorAll('input[required], select[required]').forEach(field => {
        field.addEventListener('input', function() {
            validateField(this);
        });
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = this.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            validateField(field);
            if (!field.checkValidity()) {
                isValid = false;
            }
        });

        if (!isValid) {
            e.preventDefault();
        }
    });
    
    // Add focus effects
    const inputs = document.querySelectorAll('input[type="text"], input[type="password"], input[type="email"], select');
    
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