<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inder&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Menú de navegación -->
    @if (!isset($showNavbar) || $showNavbar)
        <nav class="navbar bg-body-tertiary">
            <form class="container-fluid justify-content-start gap-3">
                <a href="{{ route('login') }}" class="btn {{ Route::is('login') || Route::is('/') ? 'btn-primary' : 'btn-outline-primary' }}">Usuario</a>
                
                <a href="{{ route('admin.login') }}" class="btn {{ Route::is('admin.login') ? 'btn-primary' : 'btn-outline-primary' }}">Administrador</a>
            </form>
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