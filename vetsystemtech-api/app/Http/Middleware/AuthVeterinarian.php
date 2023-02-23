<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthVeterinarian
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('veterinarian')->check()) {
            return response()->json(['error' => 'Não autorizado para não veterinários.'], 401);
        }

        return $next($request);
    }
}
