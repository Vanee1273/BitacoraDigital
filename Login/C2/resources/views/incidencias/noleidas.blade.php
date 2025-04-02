@extends('layout.index')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4 text-center text-primary">📌 Incidencias No Leídas</h2>

  @if(session('success'))
  <div class="alert alert-success text-center">✅ {{ session('success') }}</div>
  @endif

  <div class="card shadow-lg p-4">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th class="text-center">🔢 ID</th>
            <th>📝 Motivo</th>
            <th>🔍 Descripción</th>
            <th>🎓 Alumno</th>
            <th class="text-center">⚠️ Estado</th>
          </tr>
        </thead>
        <tbody>
          @forelse($incidencias as $incidencia)
          <tr class="border-bottom">
            <td class="text-center"><strong>{{ $incidencia->id }}</strong></td>
            <td>{{ $incidencia->Motivos }}</td>
            <td>{{ $incidencia->Descripción }}</td>
            <td>{{ $incidencia->alumno->nombre ?? 'No asignado' }}</td>
            <td class="text-center">
              <span class="badge bg-danger">{{ $incidencia->Status }}</span>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center text-muted py-3">📭 No hay incidencias no leídas.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection