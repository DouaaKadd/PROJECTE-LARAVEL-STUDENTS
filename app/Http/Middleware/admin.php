<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifico si el usuario está autenticado y si es admin
        $user = Auth::user();
        if ($user && $user->email === 'admin@admin.cat') {
            // si el usuario es admin , puede continuar
            return $next($request);
        }

        //si  No es admin, aborto con error 403 (Prohibido) y le digo que no esta autorizado
        abort(403, 'Acceso no autorizado');
    }
}
