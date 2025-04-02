@extends('Componentes.MenuAdmin')
@section('content')
<div class="container mt-4">
  <h2 class="mb-4 text-center text-primary">📌 Incidencias No Leídas</h2>

  @if(session('success'))
  <div id="success-message" data-success="{{ session('success') }}" class="d-none"></div>
  @endif

  <div class="card shadow-lg p-4">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th class="text-center"> ID</th>
            <th> Motivo</th>
            <th> Descripción</th>
            <th> Alumno</th>
            <th class="text-center"> Estado</th>
            <th class="text-center"> Acción</th>
          </tr>
        </thead>
        <tbody>
          @forelse($incidencias as $incidencia)
          <tr class="border-bottom">
            <td class="text-center"><strong>{{ $incidencia->id }}</strong></td>
            <td>{{ $incidencia->Motivos }}</td>
            <td>{{ $incidencia->Descripción }}</td>
            <td>{{ $incidencia->alumno->Nombre ?? 'No asignado' }}</td>
            <td class="text-center">
              <span class="badge bg-danger">{{ $incidencia->Status }}</span>
            </td>
            <td class="text-center">
              <form action="{{ route('reporte.leido', $incidencia->id) }}" method="POST" id="form-{{ $incidencia->id }}">
                @csrf
                <button type="submit" class="btn btn-success">📌 Marcar como Leído</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center text-muted py-3">📭 No hay incidencias no leídas.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal de éxito -->
<div class="modal fade" id="modalSuccess" tabindex="-1" aria-labelledby="modalSuccessLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSuccessLabel">✅ Incidencia Marcada Como Leída</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        La incidencia ha sido marcada como leída con éxito.
      </div>
    </div>
  </div>
</div>

@endsection

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var successMessage = document.getElementById('success-message');
    if (successMessage) {
      var successText = successMessage.getAttribute('data-success');
      if (successText) {
        var myModal = new bootstrap.Modal(document.getElementById('modalSuccess'));
        myModal.show();

        // Después de 2 segundos, cerramos el modal
        setTimeout(function() {
          myModal.hide();
        }, 2000);
      }
    }
  });
</script>