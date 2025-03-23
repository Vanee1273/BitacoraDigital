<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidenciasController;

Route::get('/', [IncidenciasController::class, 'index'])->name('incidencias.index');

Route::get('/incidencias/create', [IncidenciasController::class, 'create'])->name('incidencias.create');

Route::post('/incidencias/store', [IncidenciasController::class, 'store'])->name('incidencias.store');
Route::delete('/incidencias/{id}', [IncidenciasController::class, 'destroy'])->name('incidencias.destroy');
Route::put('/incidencias/{id}', [IncidenciasController::class, 'update'])->name('incidencias.update');
