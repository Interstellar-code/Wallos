@extends('layouts.app')

@section('content')
<div class="content">
    <section class="container">
        <header>
            <div class="logo-image" title="Wallos - Subscription Tracker">
                @include('partials.logo')
            </div>
            <p>{{ __('create_account') }}</p>
        </header>
        
        <form method="POST" action="{{ route('register') }}">
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
                <label for="email">{{ __('email') }}:</label>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('password') }}:</label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('confirm_password') }}:</label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <label for="currency">{{ __('main_currency') }}:</label>
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

            @if($errors->any())
                <ul class="error-box">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa-solid fa-triangle-exclamation"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('register') }}
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
    </section>
</div>
@endsection