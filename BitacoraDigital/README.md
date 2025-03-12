# 📌 **Bitácora Digital**  
*Sistema para el control y seguimiento de reportes escolares en una escuela primaria.*  

## 📖 Propósito  
Este proyecto tiene como propósito principal gestionar y documentar de manera precisa los reportes generados para los alumnos de una escuela primaria, permitiendo un seguimiento claro y conciso de su desempeño y situación académica.  

## 📋 Requisitos  
- 📶 Conexión a internet (WiFi)  
- 📱 Dispositivo móvil o de escritorio  

## 🚀 Generación del Proyecto  

### 📌 Modelos  
```sh
php artisan make:model Alumnos
php artisan make:model Maestros
php artisan make:model Reportes
php artisan make:model UserAdmin
```
#### 📚 Alumnos
```sh
php artisan make:migration alumnos
```
```php
Schema::create('Alumnos', function (Blueprint $table) {
    $table->id();
    $table->string('Nombre');
    $table->string('Apellidos');
    $table->string('Grado');
    $table->string('Grupo');
    $table->enum('Status', ['Activo', 'Inactivo'])->nullable();
    $table->timestamps();
});
```
#### 🎓 Maestros

```sh
php artisan make:migration maestros
```
```php
Schema::create('Maestros', function (Blueprint $table) {
    $table->id();
    $table->string('Nombre');
    $table->string('Apellidos');
    $table->string('Usuario');
    $table->string('Password');
    $table->string('Telefono');
    $table->string('Correo');
    $table->enum('Status', ['Activo', 'Inactivo'])->nullable();
    $table->timestamps();
});
```
#### 📝 Reportes
```sh
php artisan make:migration reportes
```
```php
Schema::create('Reportes', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('FKIDMaestro');
    $table->unsignedBigInteger('FKIDAlumno');
    $table->string('Motivos');
    $table->text('Descripción');
    $table->enum('Status', ['Leído', 'No Leído'])->nullable();
    $table->timestamps();
    
    $table->foreign('FKIDMaestro')->references('id')->on('Maestros')->onDelete('cascade');
    $table->foreign('FKIDAlumno')->references('id')->on('Alumnos')->onDelete('cascade');
});
```
#### 🔑 Usuario Admin
```sh
php artisan make:migration users
```
```php
Schema::create('UserAdmin', function (Blueprint $table) {
    $table->id();
    $table->string('Nombre');
    $table->string('Apellidos');
    $table->string('Usuario');
    $table->string('Password');
});
```
## 🛠️ Tecnologías Utilizadas  
- **Framework:** Laravel  
- **Base de datos:** MySQL  

## 🎁 Expresiones de Gratitud  
- 📢 Comparte este proyecto con otros  
- 🍺 Invita una cerveza o ☕ un café a alguien del equipo  
- 🤓 Da las gracias públicamente  

# 🛠️ **Generación de Modelos y Migraciones**  
Para la generación de modelos y migraciones utilizamos los siguientes comandos.  
