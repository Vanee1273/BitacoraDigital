@extends('layouts.app')
@section('title', 'Iniciar Sesión Usuarios')
@section('content')
<div class="container d-flex justify-content-center align-items-center" >
  <div class="card shadow-sm" style="border-radius: 12px; max-width: 400px; width: 100%; background: rgba(255, 255, 255, 0.95);">
    <div class="card-header text-center" style="border-bottom: none; padding-top: 2rem;">
      <h3 class="mb-3" style="font-weight: 600; color: #176298;">Iniciar sesión</h3>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <div class="form-group mb-3">
          <label for="email" class="form-label">Correo electrónico</label>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border-radius: 10px;">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group mb-4">
          <label for="password" class="form-label">Contraseña</label>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="border-radius: 10px;">
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group text-center mt-4">
          <button type="submit" class="btn btn-primary w-100 py-2" style="border-radius: 25px; font-weight: 600; background-color: #176298; border: none; color: white;">
            {{ __('Iniciar Sesión') }}
          </button>
        </div>

        <div class="form-group text-center mt-3">
          <a href="{{ route('password.request') }}" class="text-info" style="text-decoration: none; font-weight: 500; transition: 0.3s ease-in-out; font-size: 1rem;">
            {{ __('¿Olvidaste tu contraseña?') }}
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .text-info {
    font-weight: 500;
  }

  .text-info:hover {
    text-decoration: underline;
    color: #176298;
    background-color: rgba(0, 0, 0, 0.1);
    padding: 0 5px;
    border-radius: 5px;
  }
</style>

@endsection