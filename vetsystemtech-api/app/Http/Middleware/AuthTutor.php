<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthTutor
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('tutor')->check()) {
            return response()->json(['error' => 'Não autorizado para não tutores.'], 401);
        }

        return $next($request);
    }
}
