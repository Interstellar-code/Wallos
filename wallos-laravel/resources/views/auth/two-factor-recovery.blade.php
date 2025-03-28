@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Two-Factor Recovery Codes') }}</div>

                <div class="card-body">
                    <div class="alert alert-warning">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to access your account if you lose your two-factor authentication device.') }}
                    </div>

                    <div class="row mb-4">
                        @foreach ($codes as $code)
                            <div class="col-md-6 mb-2">
                                <code>{{ $code }}</code>
                            </div>
                        @endforeach
                    </div>

                    <form method="POST" action="{{ route('2fa.generate') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            {{ __('Generate New Codes') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection