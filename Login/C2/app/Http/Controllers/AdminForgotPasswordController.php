<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminPasswordResetMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.admin-email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['correo' => 'required|email']);

        $admin = Admin::where('correo', $request->correo)->first();

        if ($admin) {
            $token = Str::random(60);

            // Guardar el token en la tabla password_reset_tokens
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $admin->correo],
                ['token' => $token, 'created_at' => now()]
            );

            Mail::to($admin->correo)->send(new AdminPasswordResetMail($token));
            
            return back()->with('status', 'Se ha enviado un enlace de restablecimiento a tu correo.');
        }

        return back()->withErrors(['correo' => 'No se encontró un administrador con este correo.']);
    }

    public function showResetForm($token)
    {
        return view('auth.passwords.admin-reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'correo' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->correo)
            ->where('token', $request->token)
            ->first();

        if ($tokenData) {
            $admin = Admin::where('correo', $request->correo)->first();

            if ($admin) {
                $admin->update([
                    'password' => Hash::make($request->password),
                ]);

                DB::table('password_reset_tokens')
                    ->where('email', $request->correo)
                    ->delete();

                return redirect('/admin/login')->with('status', 'Contraseña actualizada correctamente.');
            }
        }

        return back()->withErrors(['correo' => 'Token inválido o expirado.']);
    }
}