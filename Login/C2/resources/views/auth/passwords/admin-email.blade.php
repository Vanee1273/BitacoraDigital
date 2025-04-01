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
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf

            <div class="form-group mb-1">
              <label for="correo" class="col-form-label text-md-right">Correo Administrativo</label>

              <div>
                <input id="correo" type="email" class="mt-2 form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required>

                @error('correo')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group text-center mt-3">
              <button type="submit" class="btn btn-primary">
                {{ __('Enviar Enlace') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection