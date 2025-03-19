<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('TITULO')</title>
  <link rel="stylesheet" href="{{ asset('styles/normalize.css') }}">
</head>

<body>
  @include('Componentes.Menu')
  @yield('CONTENIDO')
</body>

</html>