<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña</title>
</head>
<body>
    <h1>Restablecer contraseña</h1>
    <p>Hola,</p>
    <p>Recibiste este correo porque solicitaste un restablecimiento de contraseña para tu cuenta.</p>
    <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
    <a href="{{ url('/password/reset', $token) }}">Restablecer contraseña</a>
    <p>Si no solicitaste este restablecimiento, ignora este correo.</p>
    <p>Gracias,</p>
    <p>El equipo de soporte</p>
</body>
</html>