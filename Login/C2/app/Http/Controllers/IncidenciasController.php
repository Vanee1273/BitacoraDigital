<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumnos;
use App\Models\Reportes;
use Barryvdh\DomPDF\Facade\Pdf;

class IncidenciasController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $searchTerm = $request->input('search');

    if ($searchTerm) {
      $incidencias = Reportes::where('Motivos', 'LIKE', "%$searchTerm%")->get();
    } else {
      $incidencias = Reportes::all();
    }

    // Filtramos los alumnos activos (suponiendo que el campo en la base de datos se llama "activo")
    $alumnos = Alumnos::where('Status', 'Activo')->get();
    $estados = Reportes::distinct()->pluck('Status')->filter();

    return view('incidencias.index', compact('incidencias', 'alumnos', 'estados', 'searchTerm'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    // Filtramos los alumnos activos para mostrar en el formulario de creación
    $alumnos = Alumnos::where('Status', 'Activo')->get();
    return view('incidencias.create', compact('alumnos'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'Motivos' => 'required',
      'Descripción' => 'required',
      'FKIDAlumno' => 'required|exists:Alumnos,id', // Asegura que el alumno exista
    ]);

    $data = $request->all();
    $data['Status'] = 'No Leído';
    $data['FKIDMaestro'] = 1; // Asigna el número fijo (ejemplo: 1)
    Reportes::create($data);
    return redirect()->route('incidencias.index')->with('success', 'Incidencia creada con éxito');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $incidencia = Reportes::with('alumno')->findOrFail($id);
    return view('incidencias.show', compact('incidencia'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id) {}

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'Motivos' => 'required',
      'Descripción' => 'required',
    ]);

    $incidencia = Reportes::findOrFail($id);
    $incidencia->update($request->all());

    return redirect()->route('incidencias.index')->with('success', 'Incidencia actualizada con éxito');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $incidencia = Reportes::findOrFail($id);
    $incidencia->delete();

    return redirect()->route('incidencias.index')->with('success', 'Incidencia eliminada.');
  }

  public function exportPdf($id)
  {
    $incidencia = Reportes::with(['alumno', 'maestro'])->findOrFail($id); // Cargar relaciones
    $pdf = Pdf::loadView('pdf.incidencia', compact('incidencia'));
    return $pdf->download('incidencia_' . $incidencia->id . '.pdf');
  }

  public function noLeidas()
  {
    $incidencias = Reportes::where('Status', 'No Leído')->get();
    return view('incidencias.noLeidas', compact('incidencias'));
  }
}
