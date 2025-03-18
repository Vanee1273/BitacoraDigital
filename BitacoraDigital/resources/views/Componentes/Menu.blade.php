<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="{{ asset('styles/Barra.css') }}">

<body>
  <div class="d-flex">
    <!-- Botón fuera del sidebar para que siempre sea visible -->
    <button class="sidebar-toggle" id="toggleSidebar">
      <i class="bi bi-chevron-left"></i>
    </button>

    <nav class="sidebar border-end" id="sidebar">
      <h5 class="sidebar-title">
        <i class="bi bi-bootstrap fs-4 me-2"></i> Mi bitácora Digital
      </h5>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="bi bi-house-door"></i> Home</a>
        </li>
        <li class="nav-item">
        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-plus-lg"></i> Crear incidencia</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-file-earmark-pdf"></i> Generar Reporte</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-people"></i> Grados y Grupos</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-person"></i> Alumnos</a></li>
        </li>
      </ul>
      <ul class="nav flex-column account">
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="bi bi-person-gear"></i> Account</a>
        </li>
      </ul>
    </nav>

    <main class="p-3 flex-grow-1" id="mainContent">
      @yield('content')
    </main>
  </div>

  <script src="{{ asset('js/scripts.js') }}?v={{ time() }}"></script>

</body>