<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Mostrar el formulario de inicio de sesión para usuarios normales
    public function showLoginForm()
    {
        return view('emails.login'); // Cambia 'auth.login' por 'emails.login'
    }

    // Procesar el inicio de sesión para usuarios normales
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            return redirect()->route('welcome')->with('email', $request->email);
        }

        // Autenticación fallida
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    // Mostrar la vista de bienvenida para usuarios normales
    public function welcome()
    {
        if (!session('email')) {
            return redirect()->route('login');
        }

        // Obtener el usuario autenticado
        $user = User::where('email', session('email'))->first();

        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Usuario no encontrado.']);
        }

        // Pasar el nombre y la contraseña real a la vista
        return view('emails.inicio', [
            'name' => $user->name,
            'password' => $user->password, // Pasamos la contraseña real
        ]);
    }

    // Mostrar el formulario de inicio de sesión para administradores
    public function showAdminLoginForm()
    {
        return view('emails.loginAdmin');
    }

// Procesar el inicio de sesión para administradores
public function adminLogin(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Buscar al administrador en la tabla "admins"
    $admin = \App\Models\Admin::where('correo', $request->email)->first();

    // Verificar si el administrador existe y si la contraseña es correcta
    if ($admin && \Illuminate\Support\Facades\Hash::check($request->password, $admin->password)) {
        // Autenticación exitosa
        Auth::guard('admin')->login($admin); // Iniciar sesión como administrador
        return redirect()->route('admin.welcome')->with('email', $request->email);
    }

    // Autenticación fallida
    return back()->withErrors([
        'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros o no tienes permisos de administrador.',
    ]);
}

// Mostrar la vista de bienvenida para administradores
public function adminWelcome()
{
    if (!Auth::guard('admin')->check()) {
        return redirect()->route('admin.login');
    }

    // Obtener el administrador autenticado
    $admin = Auth::guard('admin')->user();

    // Pasar el nombre y la contraseña real a la vista
    return view('emails.inicioAdmin', [
        'name' => $admin->nombre,
        'password' => $admin->password, // Pasamos la contraseña real
    ]);
}

// Cerrar sesión
public function logout(Request $request)
{
    if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
    } else {
        Auth::logout();
    }

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}
}