@extends('layouts.app')

@section('content')
<div class="content">
    <section class="container">
        <header>
            <div class="logo-image" title="Wallos - Subscription Tracker">
                @include('partials.logo')
            </div>
            <p>{{ __('Two-Factor Recovery Codes') }}</p>
        </header>
        
        <div class="login-subtitle">{{ __('2fa.recovery.subtitle') ?? 'Store these recovery codes in a secure location' }}</div>
        
        <div class="alert-box warning-box">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <p>{{ __('Store these recovery codes in a secure password manager. They can be used to access your account if you lose your two-factor authentication device.') }}</p>
        </div>
        
        <div class="recovery-codes">
            @foreach ($codes as $code)
                <div class="recovery-code">{{ $code }}</div>
            @endforeach
        </div>

        <form method="POST" action="{{ route('auth.2fa.generate') }}" class="mt-4">
            @csrf
            <div class="form-group">
                <button type="submit" class="btn btn-danger">
                    {{ __('Generate New Codes') }}
                </button>
            </div>
        </form>

        <div class="login-form-link">
            <a href="{{ route('dashboard') }}">{{ __('Return to Dashboard') }}</a>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Copy to clipboard functionality
    const codes = document.querySelectorAll('.recovery-code');
    codes.forEach(code => {
        code.addEventListener('click', function() {
            const text = this.textContent;
            navigator.clipboard.writeText(text).then(() => {
                // Show a brief "copied" indicator
                const originalText = this.textContent;
                this.textContent = 'Copied!';
                setTimeout(() => {
                    this.textContent = originalText;
                }, 1000);
            });
        });
    });
});
</script>

<style>
.alert-box {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    align-items: flex-start;
}

.alert-box i {
    margin-right: 10px;
    font-size: 18px;
    margin-top: 2px;
}

.warning-box {
    background-color: rgba(255, 193, 7, 0.2);
    border: 1px solid #ffc107;
    color: #856404;
}

.recovery-codes {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    margin-bottom: 20px;
}

.recovery-code {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 10px;
    font-family: monospace;
    font-size: 14px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.recovery-code:hover {
    background-color: #e9ecef;
    transform: translateY(-2px);
}

.dark-theme .recovery-code {
    background-color: #343a40;
    border-color: #495057;
    color: #e9ecef;
}

.dark-theme .recovery-code:hover {
    background-color: #495057;
}

.btn-danger {
    background-color: #dc3545;
    color: white;
}

.btn-danger:hover {
    background-color: #c82333;
}
</style>
@endpush