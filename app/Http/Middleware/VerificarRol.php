<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarRol
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Comprobar que exista una sesión iniciada
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Obtener el usuario autenticado
        $usuario = auth()->user();

        // Comprobar si su rol está permitido
        if (!in_array($usuario->rol, $roles)) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}