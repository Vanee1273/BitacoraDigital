<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AdminForgotPasswordController;
use App\Http\Controllers\IncidenciasController;
use App\Http\Controllers\AlumnosController;

// Ruta principal
Route::get('/', function () {
  return view('inicio');
})->name('/');

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('/Incidencias/Nueva', [IncidenciasController::class, 'CREAR'])->name('CREAR');

// Rutas para restablecimiento de contraseña
Route::get('/reset', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

// Ruta para el formulario de inicio de sesión de administradores
Route::get('/admin/login', function () {
  return view('emails.loginAdmin');
})->name('admin.login');

// Rutas de administrador
Route::prefix('admin')->group(function() {
  Route::get('/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
  Route::post('/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');
  Route::get('/welcome', [AuthController::class, 'adminWelcome'])->name('admin.welcome')->middleware('auth:admin');
  Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Solicitud de restablecimiento
    Route::get('/password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])
         ->name('admin.password.request');
         
    Route::post('/password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])
         ->name('admin.password.email');
    
    // Formulario de nueva contraseña
    Route::get('/password/reset/{token}', [AdminForgotPasswordController::class, 'showResetForm'])
         ->name('admin.password.reset');
    
    // Actualización de contraseña
    Route::post('/password/reset', [AdminForgotPasswordController::class, 'reset'])
         ->name('admin.password.update');
});

// Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//Rutas para Reportes y control maestros
Route::get('/Incidencias', [IncidenciasController::class, 'index'])->name('incidencias.index');

Route::get('/incidencias/create', [IncidenciasController::class, 'create'])->name('incidencias.create');

Route::post('/incidencias/store', [IncidenciasController::class, 'store'])->name('incidencias.store');

Route::delete('/incidencias/{id}', [IncidenciasController::class, 'destroy'])->name('incidencias.destroy');
Route::put('/incidencias/{id}', [IncidenciasController::class, 'update'])->name('incidencias.update');

Route::get('/incidencias/{id}/pdf', [IncidenciasController::class, 'exportPdf'])->name('incidencias.pdf');

Route::get('/incidencias/no-leidas', [IncidenciasController::class, 'noLeidas'])->name('welcome');

Route::get('/incidencias/{id}', [IncidenciasController::class, 'show'])->name('incidencias.show');

//Rutas para administrar alumnos

Route::get('alumnos', [AlumnosController::class, 'index'])->name('alumnos.index');
Route::get('alumnos/create', [AlumnosController::class, 'create'])->name('alumnos.create');
Route::post('alumnos', [AlumnosController::class, 'store'])->name('alumnos.store');
Route::post('alumnos/{id}/dar-de-baja', [AlumnosController::class, 'darDeBaja'])->name('alumnos.darDeBaja');
// Ruta para dar de alta al alumno
Route::post('alumnos/dar-de-alta/{id}', [AlumnosController::class, 'darDeAlta'])->name('alumnos.darDeAlta');
