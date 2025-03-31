@component('mail::message')
# Restablecimiento de Contraseña Administrativa

Has recibido este correo porque solicitaste restablecer tu contraseña de administrador.

@component('mail::button', ['url' => url('/admin/password/reset/'.$token)])
Restablecer Contraseña
@endcomponent

Este enlace expirará en 60 minutos. Si no solicitaste este restablecimiento, ignora este mensaje.

**Seguridad:** Nunca compartas este enlace con nadie.
@endcomponent