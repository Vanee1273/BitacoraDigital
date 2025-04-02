@extends('Componentes.menuAdmin')

@section('content')
<div class="container">
    <h1 class="mb-4">Agregar Nuevo Maestro</h1>
    
    <form action="{{ route('maestros.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Nombre" class="form-label">Nombre:</label>
            <input type="text" name="Nombre" id="Nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Apellidos" class="form-label">Apellidos:</label>
            <input type="text" name="Apellidos" id="Apellidos" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Usuario" class="form-label">Usuario:</label>
            <input type="text" name="Usuario" id="Usuario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Telefono" class="form-label">Teléfono:</label>
            <input type="text" name="Telefono" id="Telefono" class="form-control">
        </div>

        <div class="mb-3">
            <label for="Correo" class="form-label">Correo Electrónico:</label>
            <input type="email" name="Correo" id="Correo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Status" class="form-label">Estado:</label>
            <select name="Status" id="Status" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar Maestro</button>
        <a href="{{ route('maestros.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
