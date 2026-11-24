<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Mostrar el formulario de login
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    // Validar las credenciales
   public function iniciarSesion(Request $request)
{
    $credenciales = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credenciales)) {
        $request->session()->regenerate();

        $usuario = Auth::user();

        // Si es empleado, entra directamente
        if ($usuario->rol === 'empleado') {
            return redirect('/home');
        }

        // Si es administrador, generamos su código
        if ($usuario->rol === 'admin') {

            // Código aleatorio de 6 dígitos
            $codigo = str_pad(
                (string) random_int(0, 999999),
                6,
                '0',
                STR_PAD_LEFT
            );

            // Guardamos el código protegido y su vencimiento
            $request->session()->put([
                'admin_codigo_hash' => Hash::make($codigo),
                'admin_codigo_expira' => now()->addMinutes(5)->timestamp,
                'admin_verificado' => false
            ]);

            // Enviamos el código al correo del administrador
            Mail::raw(
                "Tu código de verificación es: {$codigo}. Tiene una vigencia de 5 minutos.",
                function ($message) use ($usuario) {
                    $message->to($usuario->email)
                            ->subject('Código de verificación');
                }
            );

            return redirect()->route('verificacion');
        }
    }

    return back()->withErrors([
        'email' => 'Correo o contraseña incorrectos.'
    ])->onlyInput('email');

    
}
public function verificarCodigo(Request $request)
{
    $request->validate([
        'codigo' => 'required|digits:6'
    ]);

    $codigoHash = $request->session()->get('admin_codigo_hash');
    $expiracion = $request->session()->get('admin_codigo_expira');

    // Comprobar que exista una verificación pendiente
    if (!$codigoHash || !$expiracion) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withErrors([
                'email' => 'No existe una verificación pendiente. Inicia sesión nuevamente.'
            ]);
    }

    // Comprobar vencimiento
    if (now()->timestamp >= $expiracion) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withErrors([
                'email' => 'El código ha expirado. Inicia sesión nuevamente.'
            ]);
    }

    // Comprobar el código
    if (!Hash::check($request->codigo, $codigoHash)) {
        return back()->withErrors([
            'codigo' => 'El código de verificación es incorrecto.'
        ]);
    }

    // Autorizar al administrador
    $request->session()->put('admin_verificado', true);

    // Eliminar el código utilizado
    $request->session()->forget([
        'admin_codigo_hash',
        'admin_codigo_expira'
    ]);

    return redirect()->route('home');
}

// Cerrar sesión
public function cerrarSesion(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login');
}
}
