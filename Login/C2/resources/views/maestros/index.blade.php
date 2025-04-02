@extends('Componentes.menuAdmin')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Maestros</h1>
    <a href="{{ route('maestros.create') }}" class="btn btn-primary mb-3">Agregar Maestro</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maestros as $maestro)
            <tr>
                <td>{{ $maestro->Nombre }}</td>
                <td>{{ $maestro->Apellidos }}</td>
                <td>{{ $maestro->Usuario }}</td>
                <td>{{ $maestro->Correo }}</td>
                <td>{{ $maestro->Telefono }}</td>
                <td>{{ $maestro->Status ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <a href="{{ route('maestros.edit', $maestro->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('maestros.destroy', $maestro->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
