<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Str::random(60);

            // Guardar el token en la tabla password_reset_tokens
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                ['token' => $token, 'created_at' => now()]
            );

            Mail::to($user->email)->send(new PasswordResetMail($token));

            return back()->with('status', 'Se ha enviado un enlace de restablecimiento de contraseña a tu correo electrónico.');
        }

        return back()->withErrors(['email' => 'No se encontró un usuario con ese correo electrónico.']);
    }

    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Buscar el token en la tabla password_reset_tokens
        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if ($tokenData) {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                // Actualizar la contraseña del usuario
                $user->update([
                    'password' => Hash::make($request->password),
                ]);

                // Eliminar el token de la tabla password_reset_tokens
                DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->delete();

                return redirect('/')->with('status', 'Tu contraseña ha sido restablecida.');
            }
        }

        return back()->withErrors(['email' => 'El token no es válido.']);
    }
}