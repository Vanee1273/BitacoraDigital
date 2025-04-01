@extends('layouts.app')

@section('title', 'Restablecer Contraseña Administrativa')

@section('content')
<link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-center">
          <h3 class="p-2 pt-3">Restablecer Contraseña Administrativa</h3>
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('admin.password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group mb-1">
              <label for="correo" class="col-form-label text-md-right">Correo Administrativo</label>
              <input id="correo" type="email" class="mt-2 form-control @error('correo') is-invalid @enderror" name="correo" value="{{ $request->email ?? old('correo') }}" required autocomplete="email" autofocus>
              @error('correo')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group mt-2">
              <label for="password" class="col-form-label text-md-right">Nueva Contraseña</label>
              <input id="password" type="password" class="mt-2 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group mt-2">
              <label for="password-confirm" class="col-form-label text-md-right">Confirmar Contraseña</label>
              <input id="password-confirm" type="password" class="mt-2 form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="form-group text-center mt-3">
              <button type="submit" class="btn btn-primary">
                Restablecer Contraseña
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection