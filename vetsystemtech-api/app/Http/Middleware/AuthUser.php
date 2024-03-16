<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Required\Interfaces\VariableStandard;
use App\Messages\MessageUser;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthUser implements VariableStandard
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard(self::API)->check()) {
            return response()->json([self::ERROR => MessageUser::USR008], 401);
        }

        return $next($request);
    }
}
