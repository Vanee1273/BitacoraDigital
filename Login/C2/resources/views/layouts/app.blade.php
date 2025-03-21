<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a la fuente Outfit de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
    <!-- Estilos para aplicar la fuente Outfit a todo el documento -->
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body>
    <!-- Menú de navegación -->
    @if (!isset($showNavbar) || $showNavbar)
        <nav class="navbar bg-body-tertiary px-3">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Sistema de Bitácora</span>
                <div>
                    <a href="{{ route('login') }}" class="btn {{ Route::is('login') || Route::is('/') ? 'btn-primary' : 'btn-outline-primary' }}">Usuario</a>
                    <a href="{{ route('admin.login') }}" class="btn {{ Route::is('admin.login') ? 'btn-primary' : 'btn-outline-primary' }}">Administrador</a>
                </div>
            </div>
        </nav>
    @endif

    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>