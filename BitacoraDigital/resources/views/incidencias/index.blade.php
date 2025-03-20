@extends('layout.index')
@section('content')


    <!-- Contenedor principal -->
    <div class="container py-4">
        <h1 class="mb-5">Gestión de Incidencias</h1>
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form action="{{ route('incidencias.index') }}" method="GET" class="me-2">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Buscar incidencias..."
                                value="{{ $searchTerm ?? '' }}">
                            <button type="submit" class="btn btn-outline-secondary">Buscar</button>
                        </div>
                    </form>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createIncidentModal">
                        <i class="bi bi-plus-circle me-1"></i> Nueva Incidencia
                    </button>
                </div>

                <!-- Tabla de incidencias -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Motivo</th>
                                <th>Descripción</th>
                                <th>Status</th>
                                <th>Acción</th>
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
                                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                                    data-bs-target="#viewIncidentModal{{ $incidencia->id }}">
                                                                    <i class="bi bi-eye"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                                                                    data-bs-target="#editIncidentModal{{ $incidencia->id }}">
                                                                    <i class="bi bi-pencil"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteIncidentModal{{ $incidencia->id }}">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>




                <!-- Paginación -->
                <nav>
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal para guardar una nueva incidencia -->
    <div class="modal fade" id="createIncidentModal" tabindex="-1" aria-labelledby="createIncidentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">Nueva Incidencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="save-form" method="POST" action="{{ route('incidencias.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Motivo</label>
                            <input type="text" class="form-control" required name="Motivos">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" rows="3" required name="Descripción"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alumno</label>
                            <select class="form-select" name="FKIDAlumno" required>
                                <option value="">Selecciona un alumno</option>
                                @foreach($alumnos as $alumno)
                                    <option value="{{ $alumno->id }}">{{ $alumno->Nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" form="save-form" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modales para ver, editar y eliminar incidencias -->
    <div id="incidentModals">
        <!-- Modal para ver incidencia -->
        <div class="modal fade" id="viewIncidentModal1" tabindex="-1" aria-labelledby="viewIncidentModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalles de la Incidencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Motivo:</strong> Computadora no funciona en Aula 101</p>
                        <p><strong>Descripción:</strong> La computadora del aula 101 no enciende.</p>
                        <p><strong>Status:</strong> <span class="badge bg-success">Leído</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para editar incidencia -->
        <div class="modal fade" id="editIncidentModal1" tabindex="-1" aria-labelledby="editIncidentModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title">Editar Incidencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Motivo</label>
                                <input type="text" class="form-control" value="Computadora no funciona en Aula 101"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" rows="3"
                                    required>La computadora del aula 101 no enciende.</textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para eliminar incidencia -->
        <div class="modal fade" id="deleteIncidentModal1" tabindex="-1" aria-labelledby="deleteIncidentModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title">Confirmar Eliminación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de que deseas eliminar esta incidencia?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection