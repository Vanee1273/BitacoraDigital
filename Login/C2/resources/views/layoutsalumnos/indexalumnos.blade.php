@extends('Componentes.menuAdmin')
@section('content')
<link href="{{ asset('css/alumnos.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

@if (session('success') || $errors->any())
<div class="modal fade" id="modalMessages" tabindex="-1" aria-labelledby="modalLabelMessages" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabelMessages">
          @if(session('success')) ✅ Éxito @else ❌ Error @endif
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if (session('success'))
        {{ session('success') }}
        @endif
        @if ($errors->any())
        <ul>
          @foreach ($errors->all() as $error)
          <li>❗ {{ $error }}</li>
          @endforeach
        </ul>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endif

<div class="container">
  <h3 class="text-center mb-5">📚 Lista de Alumnos</h3>
  <div class="row mb-4">
    <div class="col-md-6">
      <form method="GET" action="{{ route('alumnos.index') }}">
        <div class="d-flex">
          <select class="form-select me-2" name="grado" id="grado">
            <option value="">🎓 Seleccionar Grado</option>
            @foreach (["1", "2", "3", "4", "5", "6"] as $grado)
            <option value="{{ $grado }}" {{ request()->grado == $grado ? 'selected' : '' }}>{{ $grado }}</option>
            @endforeach
          </select>
          <select class="form-select" name="grupo" id="grupo">
            <option value="">🔤 Seleccionar Grupo</option>
            @foreach (["A", "B", "C"] as $grupo)
            <option value="{{ $grupo }}" {{ request()->grupo == $grupo ? 'selected' : '' }}>{{ $grupo }}</option>
            @endforeach
          </select>
          <button type="submit" class="btn btn-primary ms-2">🔍 Filtrar</button>
        </div>
      </form>
    </div>
    <div class="col-md-6 text-end">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearAlumno">➕ Agregar Alumno</button>
    </div>
  </div>
  @if ($alumnos->isEmpty())
  <div class="alert alert-warning text-center mt-3">⚠️ No se encontraron alumnos con los filtros seleccionados.</div>
  @else
  <ul class="list-group">
    @foreach ($alumnos as $alumno)
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <div>
        <h5 class="mb-1">{{ $alumno->Nombre }} {{ $alumno->Apellidos }}</h5>
        <p class="mb-1"><strong>🆔 Número de Control:</strong> {{ $alumno->id }}</p>
        <p class="mb-1"><strong>🎓 Grado:</strong> {{ $alumno->Grado }} <strong>🔤 Grupo:</strong> {{ $alumno->Grupo }}</p>
        <p class="mb-1"><strong>⚙️ Estado:</strong>
          <span class="badge {{ $alumno->Status === 'Activo' ? 'bg-success' : 'bg-danger' }}">{{ $alumno->Status }}</span>
        </p>
      </div>

      @if ($alumno->Status === 'Activo')
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDarDeBaja{{ $alumno->id }}">🚫 Dar de Baja</button>
      @else
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDarDeAlta{{ $alumno->id }}">🔼 Dar de Alta</button>
      @endif
    </li>
    @endforeach
  </ul>

  <div class="d-flex justify-content-center mt-4">
    {{ $alumnos->withQueryString()->links() }}
  </div>
  @endif
</div>

<!-- Modal de Creación de Alumno -->
<div class="modal fade" id="modalCrearAlumno" tabindex="-1" aria-labelledby="modalLabelCrearAlumno" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabelCrearAlumno">➕ Crear Alumno</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('alumnos.store') }}">
          @csrf
          <div class="form-group mb-3">
            <label for="Nombre" class="form-label">🔤 Nombre</label>
            <input type="text" name="Nombre" id="Nombre" class="form-control" placeholder="Nombre" required>
          </div>

          <div class="form-group mb-3">
            <label for="Apellidos" class="form-label">🧑‍🤝‍🧑 Apellidos</label>
            <input type="text" name="Apellidos" id="Apellidos" class="form-control" placeholder="Apellidos" required>
          </div>

          <!-- Campo Grado -->
          <div class="form-group mb-3">
            <label for="Grado" class="form-label">🎓 Grado</label>
            <select name="Grado" id="Grado" class="form-select" required>
              <option value="1">Primero</option>
              <option value="2">Segundo</option>
              <option value="3">Tercero</option>
              <option value="4">Cuarto</option>
              <option value="5">Quinto</option>
              <option value="6">Sexto</option>
            </select>
          </div>

          <!-- Campo Grupo -->
          <div class="form-group mb-3">
            <label for="Grupo" class="form-label">🔤 Grupo</label>
            <select name="Grupo" id="Grupo" class="form-select" required>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
            </select>
          </div>

          <!-- Campo Estado -->
          <div class="form-group mb-3">
            <label for="Status" class="form-label">⚙️ Estado</label>
            <select name="Status" id="Status" class="form-select" required>
              <option value="Activo">Activo</option>
              <option value="Inactivo">Inactivo</option>
            </select>
          </div>

          <button type="submit" class="btn btn-success w-100">Registrar Alumno</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Dar de Baja -->
@foreach ($alumnos as $alumno)
<div class="modal fade" id="modalDarDeBaja{{ $alumno->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">🚫 Confirmación de Baja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas dar de baja a <strong>{{ $alumno->Nombre }} {{ $alumno->Apellidos }}</strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form method="POST" action="{{ route('alumnos.darDeBaja', $alumno->id) }}">
          @csrf
          <button type="submit" class="btn btn-danger">Confirmar Baja</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Dar de Alta -->
<div class="modal fade" id="modalDarDeAlta{{ $alumno->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">🔼 Confirmación de Alta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas dar de alta a <strong>{{ $alumno->Nombre }} {{ $alumno->Apellidos }}</strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form method="POST" action="{{ route('alumnos.darDeAlta', $alumno->id) }}">
          @csrf
          <button type="submit" class="btn btn-success">Confirmar Alta</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("modalMessages");
    if (modal) {
      var modalInstance = new bootstrap.Modal(modal);
      modalInstance.show();
    }
  });
</script>
@endsection