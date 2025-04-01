@extends('layouts.app')

@section('title', 'Restablecer Contraseña')

@section('content')
<link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-center">
          <h3 class="p-2 pt-3">{{ __('Restablecer contraseña') }}</h3>
        </div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group mb-1">
              <label for="email" class="col-form-label">{{ __('Email') }}</label>
              <input id="email" type="email" class="mt-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group text-center mt-2">
              <button type="submit" class="btn btn-primary">
                {{ __('Enviar link de restablecimiento de contraseña') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection