<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdvancedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        // Permite el paso si es admin O advanced
        if($user != null && ($user->rol == 'admin' || $user->rol == 'advanced')) {
            return $next($request);
        }
        return redirect()->route('main.index')->withErrors(['error' => 'No tienes permiso para acceder a esta sección.']);
    }
}