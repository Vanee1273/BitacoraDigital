<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Bitácora</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/principal.css') }}" rel="stylesheet">
</head>

<body>
  <h1 class="title">Sistema de Bitácora</h1>
  <a href="{{ route('login') }}" class="btn btn-custom">Iniciar sesión Usuario</a>
  <a href="{{ route('admin.login') }}" class="btn btn-custom">Iniciar sesión Administrador</a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>