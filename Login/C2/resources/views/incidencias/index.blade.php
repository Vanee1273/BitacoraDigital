@extends('layout.index')

@section('content')
<!-- Contenedor principal con un padding superior para separar los elementos del borde superior -->
<div class="container py-4" style="padding-top: 3.5rem !important;">
  <h1 class="mb-4">📋 Gestión de Incidencias</h1>

  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <!-- Sección de búsqueda y botón para crear una nueva incidencia -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('incidencias.index') }}" method="GET" class="me-2 w-50">
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" name="search" class="form-control" placeholder=" Buscar incidencias..." value="{{ $searchTerm ?? '' }}">
            <button type="submit" class="btn btn-outline-secondary">Buscar</button>
          </div>
        </form>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createIncidentModal">
          ➕ Nueva Incidencia
        </button>
      </div>

      <!-- Tabla de incidencias -->
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th> Motivo</th>
              <th> Descripción</th>
              <th> Status</th>
              <th> Acción</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($incidencias as $incidencia)
            <tr>
              <td>{{ $incidencia->Motivos }}</td>
              <td>{{ $incidencia->Descripción }}</td>
              <td>
                <span class="badge {{ [
                                        'Leído' => 'bg-success',
                                        'No Leído' => 'bg-warning',
                                    ][$incidencia->Status] ?? 'bg-secondary' }}">
                  {{ $incidencia->Status }}
                </span>
              </td>
              <td>
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewIncidentModal{{ $incidencia->id }}">
                    <i class="bi bi-eye"></i>
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editIncidentModal{{ $incidencia->id }}">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteIncidentModal{{ $incidencia->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
            <!-- Modal para ver incidencia -->
            <div class="modal fade" id="viewIncidentModal{{ $incidencia->id }}" tabindex="-1" aria-labelledby="viewIncidentModalLabel{{ $incidencia->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">🔎 Detalles de la Incidencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p><strong>Alumno:</strong> {{ $incidencia->alumno->Nombre }}</p>
                    <p><strong>Motivo:</strong> {{ $incidencia->Motivos }}</p>
                    <p><strong>Descripción:</strong> {{ $incidencia->Descripción }}</p>
                    <p><strong>Status:</strong> <span class="badge {{ [
                                        'Leído' => 'bg-success',
                                        'No Leído' => 'bg-warning',
                                    ][$incidencia->Status] ?? 'bg-secondary' }}">
                        {{ $incidencia->Status }}
                      </span></p>
                  </div>
                  <a href="{{ route('incidencias.pdf', $incidencia->id) }}" class="btn btn-primary w-100">📄 Exportar a PDF</a>
                </div>
              </div>
            </div>

            <!-- Modal para editar incidencia -->
            <div class="modal fade" id="editIncidentModal{{ $incidencia->id }}" tabindex="-1" aria-labelledby="editIncidentModalLabel{{ $incidencia->id }}"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header bg-light">
                    <h5 class="modal-title">Editar Incidencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="{{ route('incidencias.update', $incidencia->id) }}">
                      @csrf
                      @method('PUT')
                      <div class="mb-3">
                        <p><strong>Alumno:</strong> {{ $incidencia->alumno->Nombre }}</p>
                      </div>
                      <div class="mb-3">
                        <p><label class="form-label">Motivo</label></p>
                        <input type="text" class="form-control" name="Motivos" value="{{ $incidencia->Motivos }}" required>
                      </div>
                      <div class="mb-3">
                        <p><label class="form-label">Descripción</label></p>
                        <textarea class="form-control" name="Descripción" rows="3" required>{{ $incidencia->Descripción }}</textarea>
                      </div>
                      <button type="submit" class="btn btn-success">Actualizar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal para eliminar incidencia -->
            <div class="modal fade" id="deleteIncidentModal{{ $incidencia->id }}" tabindex="-1" aria-labelledby="deleteIncidentModalLabel{{ $incidencia->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header bg-light">
                    <h5 class="modal-title">⚠️ Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar esta incidencia?</p>
                    <p><strong>Alumno:</strong> {{ $incidencia->alumno->Nombre }}</p>
                    <p><strong>Motivo:</strong> {{ $incidencia->Motivos }}</p>
                    <p><strong>Descripción:</strong> {{ $incidencia->Descripción }}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="{{ route('incidencias.destroy', $incidencia->id) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">🗑️ Eliminar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Paginación -->
      <nav class="mt-3">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled"><a class="page-link" href="#">◀️ Anterior</a></li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">Siguiente ▶️</a></li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- Modal para guardar una nueva incidencia -->
<div class="modal fade" id="createIncidentModal" tabindex="-1" aria-labelledby="createIncidentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title">➕ Nueva Incidencia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="save-form" method="POST" action="{{ route('incidencias.store') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label"> Motivo</label>
            <input type="text" class="form-control" required name="Motivos">
          </div>
          <div class="mb-3">
            <label class="form-label"> Descripción</label>
            <textarea class="form-control" rows="3" required name="Descripción"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label"> Alumno</label>
            <select class="form-select" name="FKIDAlumno" required>
              <option value="">Selecciona un alumno</option>
              @foreach($alumnos as $alumno)
              <option value="{{ $alumno->id }}">{{ $alumno->Nombre }}</option>
              @endforeach
            </select>
          </div>
          <button type="submit" form="save-form" class="btn btn-success">💾 Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection