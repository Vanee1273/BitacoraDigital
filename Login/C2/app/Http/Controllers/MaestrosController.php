<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maestros;
use Illuminate\Support\Facades\Hash;

class MaestrosController extends Controller
{
    // Mostrar lista de maestros
    public function index()
    {
        $maestros = Maestros::all();
        $name = auth()->user()->name ?? 'Invitado'; // Obtener el nombre del usuario autenticado
        return view('maestros.index', compact('maestros', 'name')); // Pasar $name a la vista
    }
    

    // Mostrar formulario para agregar maestro
    public function create()
    {
        return view('maestros.create');
    }

    // Guardar nuevo maestro en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'Usuario' => 'required|string|unique:maestros,Usuario',
            'password' => 'required|string|min:6',
            'Telefono' => 'nullable|string|max:15',
            'Correo' => 'required|email',
            'Status' => 'required|boolean'
        ]);

        Maestros::create([
            'Nombre' => $request->Nombre,
            'Apellidos' => $request->Apellidos,
            'Usuario' => $request->Usuario,
            'password' => Hash::make($request->password), // Encriptar la contraseña
            'Telefono' => $request->Telefono,
            'Correo' => $request->Correo,
            'Status' => $request->Status
        ]);

        return redirect()->route('maestros.index')->with('success', 'Maestro agregado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $maestro = Maestros::findOrFail($id);
        return view('maestros.edit', compact('maestro'));
    }

    // Actualizar datos del maestro
    public function update(Request $request, $id)
    {
        $maestro = Maestros::findOrFail($id);

        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'Usuario' => 'required|string|unique:maestros,Usuario,' . $id,
            'password' => 'nullable|string|min:6',
            'Telefono' => 'nullable|string|max:15',
            'Correo' => 'required|email' . $id,
            'Status' => 'required|boolean'
        ]);

        $data = $request->only(['Nombre', 'Apellidos', 'Usuario', 'Telefono', 'Correo', 'Status']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $maestro->update($data);

        return redirect()->route('maestros.index')->with('success', 'Maestro actualizado correctamente.');
    }

    // Eliminar maestro
    public function destroy($id)
    {
        Maestros::findOrFail($id)->delete();
        return redirect()->route('maestros.index')->with('success', 'Maestro eliminado correctamente.');
    }
}
