<?php

use App\Http\Controllers\IncidenciasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('Vistas.Inicio');
});

Route::get('/Incidencias/Nueva', [IncidenciasController::class, 'CREAR'])->name('CREAR');
