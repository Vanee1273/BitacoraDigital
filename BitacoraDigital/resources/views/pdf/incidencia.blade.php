<!DOCTYPE html>
<html>
<head>
    <title>Ficha de Incidencia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4; /* Un fondo gris claro */
        }
        .ficha {
            border: 1px solid #ddd; /* Borde más suave */
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            margin: 20px auto;
            background-color: white; /* Fondo blanco para la ficha */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra sutil */
        }
        .ficha h1 {
            color: #4a90e2; /* Un azul agradable */
            text-align: center;
            margin-bottom: 20px;
        }
        .ficha p {
            margin: 10px 0;
            border-bottom: 1px dashed #e1e1e1; /* Borde punteado más claro */
            padding-bottom: 5px;
            color: #333; /* Texto más oscuro */
        }
        .ficha strong {
            font-weight: bold;
            color: #555; /* Texto un poco más oscuro para los títulos */
        }
        .status {
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            font-size: 0.9em; /* Tamaño de fuente un poco más pequeño */
        }
        .status.leido {
            background-color: #28a745; /* Verde */
        }
        .status.no-leido {
            background-color: #ffc107; /* Amarillo */
            color: #333; /* Texto oscuro para mejor contraste */
        }
        .status.otro {
            background-color: #6c757d; /* Gris */
        }
    </style>
</head>
<body>
    <div class="ficha">
        <h1>Ficha de Incidencia</h1>

        <p><strong>Motivo:</strong> {{ $incidencia->Motivos }}</p>
        <p><strong>Descripción:</strong> {{ $incidencia->Descripción }}</p>
        <p><strong>Status:</strong> 
            <span class="status {{ [
                'Leído' => 'leido',
                'No Leído' => 'no-leido',
            ][$incidencia->Status] ?? 'otro' }}">
                {{ $incidencia->Status }}
            </span>
        </p>
        <p><strong>Alumno:</strong> {{ $incidencia->alumno->Nombre ?? 'No asignado' }}</p>
        <p><strong>Profesor:</strong> {{ $incidencia->maestro->Nombre ?? 'No asignado' }}</p>
    </div>
</body>
</html>