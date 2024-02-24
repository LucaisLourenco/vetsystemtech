<?php

namespace App\Http\Controllers\Auth\Usuario;

use App\Http\Controllers\Auth\Usuario\Interface\VariableAuthUser;
use App\Http\Controllers\Controller;
use App\Messages\MensagemUsuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthUsersController extends Controller implements VariableAuthUser
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only(self::USERNAME, self::PASSWORD);

        try {
            if (!$token = auth(self::API)->attempt($credentials)) {
                return response()->json([self::ERROR => MensagemUsuario::USR001], 401);
            }
        } catch (JWTException $e) {
            return response()->json([self::ERROR => MensagemUsuario::USR002], 500);
        }

        return response()->json($token);
    }

    public function me(): JsonResponse
    {
        try {
            $user = auth(self::API)->user();
        } catch (JWTException $e) {
            return response()->json([self::ERROR => MensagemUsuario::USR003], 500);
        }

        return response()->json($user);
    }

    public function logout(): JsonResponse
    {
        try {
            auth(self::API)->logout();
        } catch (JWTException $e) {
            return response()->json([self::ERROR => MensagemUsuario::USR004], 500);
        }

        return response()->json([self::MESSAGE => MensagemUsuario::USR005]);
    }
}
