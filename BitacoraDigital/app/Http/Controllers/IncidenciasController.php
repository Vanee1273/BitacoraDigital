<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use App\Models\Reportes;
use Illuminate\Http\Request;

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

        $alumnos = Alumnos::all();
        $estados = Reportes::distinct()->pluck('Status')->filter();

        return view('incidencias.index', compact('incidencias', 'alumnos', 'estados', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('incidencias.create');
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
        $data['FKIDMaestro'] = 1; // Asigna el número fijo (ejemplo: 1)

        Reportes::create($data);
        return redirect()->route('incidencias.index')->with('success', 'Incidencia creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
