<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


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

    public function showAdminLoginForm()
    {
        return view('emails.loginAdmin');
    }
    
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $admin = Admin::where('correo', $request->email)->first();
    
        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.welcome');
        }
    
        return back()->withErrors([
            'email' => 'Credenciales incorrectas o no tiene permisos de administrador',
        ]);
    }
    
    public function adminWelcome()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
    
        $admin = Auth::guard('admin')->user();
        
        // Redirige a MenuAdmin.blade.php con los datos del admin
        return view('Componentes.MenuAdmin', [
            'admin' => $admin,
            'name' => $admin->nombre,
        ]);
    }
    
    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            return redirect()->route('admin.login');
        }
    
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }

}