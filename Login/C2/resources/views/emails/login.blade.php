@extends('layouts.app')
@section('title', 'Iniciar Sesión Usuarios')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center p-3 pt-4">Iniciar sesion Usuario</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf

                        <div class="form-group mb-1">
                            <label for="email">{{ __('Correo') }}</label>
                            <input id="email" type="email" class="mt-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-5">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="mt-2 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group text-center mt-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Iniciar Sesión') }}
                            </button>

                            <a class="mt-3 btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Reestablecer contraseña') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection