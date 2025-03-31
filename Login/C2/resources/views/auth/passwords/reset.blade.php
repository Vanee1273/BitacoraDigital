@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center p-3 pt-4">{{ __('Restablecer contraseña') }}</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Token oculto -->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mb-1">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" type="email" class="mt-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="mt-2 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="mt-2 form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group text-center mt-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Restablecer contraseña') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection