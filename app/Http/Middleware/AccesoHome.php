<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccesoHome
{
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = auth()->user();

        // El empleado puede entrar directamente
        if ($usuario->rol === 'empleado') {
            return $next($request);
        }

        // El administrador necesita verificar su código
        if (
            $usuario->rol === 'admin' &&
            session('admin_verificado') === true
        ) {
            return $next($request);
        }

        // Si el administrador no está verificado,
        // lo enviamos a la pantalla de verificación
        return redirect()->route('verificacion');
    }
}