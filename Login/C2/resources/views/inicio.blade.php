<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Bitácora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid full-height">
        <div class="row full-height center-content">
            <div class="col-12 text-center">
                <h1 class="title">Sistema de Bitácora</h1>
                <div class="d-flex flex-column align-items-center">
                    <a href="{{ route('login') }}" class="btn btn-outline-info btn-custom">Iniciar sesión Usuario</a>
                    <a href="{{ route('admin.login') }}" class="btn btn-outline-info btn-custom">Iniciar sesión Administrador</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>