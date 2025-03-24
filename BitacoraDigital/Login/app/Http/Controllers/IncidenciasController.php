<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class IncidenciasController extends Controller
{
  function CREAR()
  {
    $ID = 1;
    $results = DB::select('SELECT * FROM alumnos WHERE id = ?', [$ID]);
    return view('Vistas.GenerarIncidencia', ['Alumno' => $results]);
  }
}
