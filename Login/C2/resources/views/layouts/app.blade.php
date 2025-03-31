<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/inicial.css') }}">
  <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
</head>

<body>
  <!-- Menú de navegación -->
  @if (!isset($showNavbar) || $showNavbar)
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">Sistema de Bitácora</span>
      <div class="navbar-nav ml-auto">
        <a href="{{ route('login') }}" class="nav-link {{ Route::is('login') || Route::is('/') ? 'active' : '' }}">Usuario</a>
        <a href="{{ route('admin.login') }}" class="nav-link {{ Route::is('admin.login') ? 'active' : '' }}">Administrador</a>
      </div>
    </div>
  </nav>
  @endif

  <div class="container">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>