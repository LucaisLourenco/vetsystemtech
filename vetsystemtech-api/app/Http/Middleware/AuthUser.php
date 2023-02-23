<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthUser
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('api')->check()) {
            return response()->json(['error' => 'Não autorizado para não usuários.'], 401);
        }

        return $next($request);
    }
}
