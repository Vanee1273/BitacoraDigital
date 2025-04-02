<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnos;

class AlumnosController extends Controller
{
  // Vista para mostrar el formulario de creación de alumnos
  public function create()
  {
    return view('layoutsalumnos.createalumnos');
  }

  // Método para almacenar los datos del alumno
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'Nombre' => 'required|string|max:255',
      'Apellidos' => 'required|string|max:255',
      'Grado' => 'required|string|max:50',
      'Grupo' => 'required|string|max:10',
      'Status' => 'required|string|in:Activo,Inactivo',
      // Validación para asegurar que el par Nombre y Apellidos sea único
      'Nombre' => 'required|string|max:255|unique:alumnos,Nombre,NULL,id,Apellidos,' . $request->Apellidos,
      'Apellidos' => 'required|string|max:255|unique:alumnos,Apellidos,NULL,id,Nombre,' . $request->Nombre,
    ]);


    try {
      // Crear alumno
      Alumnos::create($validatedData);

      return redirect()->route('alumnos.index')->with('success', 'Alumno creado correctamente.');
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => 'Hubo un problema al crear el alumno. Inténtalo nuevamente.'])->withInput();
    }
  }

  // Método para dar de baja un alumno
  public function darDeBaja($id)
  {
    try {
      $alumno = Alumnos::findOrFail($id);
      $alumno->Status = 'Inactivo';
      $alumno->save();
      return redirect()->route('alumnos.index')->with('success', 'Alumno dado de baja.');
    } catch (\Exception $e) {
      // En caso de error, redirigir con mensaje de error
      return redirect()->route('alumnos.index')->withErrors(['error' => 'Hubo un problema al dar de baja al alumno.']);
    }
  }
  // Método para dar de alta un alumno
  public function darDeAlta($id)
  {
    try {
      $alumno = Alumnos::findOrFail($id);
      $alumno->Status = 'Activo';  // Cambiar el estado a 'Activo'
      $alumno->save();
      return redirect()->route('alumnos.index')->with('success', 'Alumno dado de alta.');
    } catch (\Exception $e) {
      // En caso de error, redirigir con mensaje de error
      return redirect()->route('alumnos.index')->withErrors(['error' => 'Hubo un problema al dar de alta al alumno.']);
    }
  }

  public function index(Request $request)
  {
      // Obtener los valores de filtro
      $grado = $request->input('grado');
      $grupo = $request->input('grupo');
  
      // Consulta base
      $query = Alumnos::query();
  
      // Aplicar filtros si se proporcionan
      if (!empty($grado)) {
          $query->where('Grado', $grado);
      }
      if (!empty($grupo)) {
          $query->where('Grupo', $grupo);
      }
  
      // Obtener los alumnos filtrados con paginación
      $alumnos = $query->paginate(10);
  
      // Obtener el nombre del usuario autenticado
      $name = auth()->user()->name ?? 'Invitado';
  
      // Retornar la vista con los datos
      return view('layoutsalumnos.indexalumnos', compact('name', 'alumnos'));
  }
  
}
