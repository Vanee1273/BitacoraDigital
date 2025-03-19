<!-- <h1>{{ $Alumno[0]->Nombre }}</h1> -->
@extends('App')
@section('TITULO','Generar Incidencia')
@section('CONTENIDO')
<link rel="stylesheet" href="{{ asset('styles/GenerarIncidencia.css') }}">
<section class="body container mt-4 p-4">
  <!-- Centrar el encabezado (h1) -->
  <h1 class="mb-4 text-center">Nueva Incidencia</h1>

  <form action="{{route('clientes.create')}}" method="POST">
    <!-- Campo Motivo -->
    <div class="mb-3">
      <label for="motivo" class="form-label">Motivo:</label>
      <input type="text" class="form-control" id="motivo" name="motivo" required>
    </div>

    <!-- Campo Descripción -->
    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripción:</label>
      <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
    </div>

    <!-- Campo Estatus (con Combo) -->
    <div class="mb-3">
      <label for="estatus" class="form-label">Estatus:</label>
      <select class="form-select" id="estatus" name="estatus" required style="padding:.375rem .75rem;">
        <option value="activo">Activo</option>
        <option value="inactivo">Inactivo</option>
      </select>
    </div>

    <!-- Campo Fecha y Hora de Creación -->
    <div class="mb-3">
      <label for="fechaHora" class="form-label">Fecha y Hora de Creación:</label>
      <input type="text" class="form-control" id="fechaHora" name="fechaHora" value="" readonly>
    </div>

    <!-- Campo ID del Alumno (oculto) -->
    <input type="hidden" id="IDALUMNO" name="IDALUMNO" value="1"> <!-- Ejemplo, deberías asignarlo dinámicamente -->

    <!-- Campo ID del Maestro (oculto) -->
    <input type="hidden" id="IDMAESTRO" name="IDMAESTRO" value="1"> <!-- Ejemplo, deberías asignarlo dinámicamente -->

    <!-- Centrar el botón -->
    <div class="d-flex justify-content-center mt-3">
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
  </form>
</section>

<!-- Agregar Bootstrap JS y dependencias de Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybP3qH6VV9f4g+f2jlMj6GA9xRZXQQih35jMZKFcXUSFc6mA5" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0u7mFLSKZftLxeWck3KJ22ppY0D0EY9YzqKMOoIhEXb6x6n9" crossorigin="anonymous"></script>

<!-- Script para asignar fecha y hora de creación -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const fechaHoraInput = document.getElementById('fechaHora');
    const fecha = new Date();
    const fechaHora = `${fecha.toLocaleDateString()} ${fecha.toLocaleTimeString()}`;
    fechaHoraInput.value = fechaHora;
  });
</script>

@endsection