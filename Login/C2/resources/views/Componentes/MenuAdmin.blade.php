<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/barra.css') }}">

<body>
<div class="d-flex">
    <!-- Botón para toggle del sidebar -->
    <button class="sidebar-toggle" id="toggleSidebar">
      <i class="bi bi-chevron-left"></i>
    </button>

    <!-- Sidebar -->
    <nav class="sidebar border-end" id="sidebar">
      <div class="sidebar-header">
        <h5 class="sidebar-title">
          <i class="bi bi-bootstrap fs-4 me-2"></i> Mi bitácora Digital
        </h5>
         <!-- <div class="admin-info">
          <i class="bi bi-person-circle fs-4"></i>
        </div> -->
      </div>
      
      <ul class="nav flex-column">
        <li class="nav-item">
<<<<<<< HEAD
          <a class="nav-link" href="{{route('admin.welcome')}}">
=======
          <a class="nav-link" href="{{ route('welcome') }}">
>>>>>>> 850145fcbc1d761c66ae5fde10c59afea634fcd2
            <i class="bi bi-house-door"></i> Inicio
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="{{ route('incidencias.index') }}">
            <i class="bi bi-plus-lg"></i> Incidencias
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="bi bi-people"></i> Grados y Grupos
          </a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('alumnos.index') }}">
            <i class="bi bi-person"></i> Alumnos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('maestros.index') }}">
            <i class="bi bi-person"></i> Maestros
          </a>
        </li>
      </ul>
      
      <ul class="nav flex-column account">
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="bi bi-person-gear"></i> Mi cuenta
          </a>
        </li>
        <li class="nav-item">
          <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link btn-logout">
              <i class="bi bi-box-arrow-right"></i> Cerrar sesión
            </button>
          </form>
        </li>
      </ul>
    </nav>

    <!-- Contenido principal -->
    <main class="p-3 flex-grow-1" id="mainContent">
      <div class="container-fluid">
        
        @yield('content')
      </div>
    </main>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="{{ asset('js/scripts.js') }}?v={{ time() }}"></script>

</body>