<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\IncidenciasController;

// Ruta principal
Route::get('/', function () {
    return view('inicio');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Ruta de bienvenida después del login
Route::get('/welcome', function () {
    return view('Componentes/Menu');
  })->name('welcome');
  
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

// Rutas para administradores
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');
Route::get('/admin/welcome', [AuthController::class, 'adminWelcome'])->name('admin.welcome');

// Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//Rutas para Reportes y control maestros
Route::get('/Incidencias', [IncidenciasController::class, 'index'])->name('incidencias.index');

Route::get('/incidencias/create', [IncidenciasController::class, 'create'])->name('incidencias.create');

Route::post('/incidencias/store', [IncidenciasController::class, 'store'])->name('incidencias.store');
Route::delete('/incidencias/{id}', [IncidenciasController::class, 'destroy'])->name('incidencias.destroy');
Route::put('/incidencias/{id}', [IncidenciasController::class, 'update'])->name('incidencias.update');

Route::get('/incidencias/{id}/pdf', [IncidenciasController::class, 'exportPdf'])->name('incidencias.pdf');