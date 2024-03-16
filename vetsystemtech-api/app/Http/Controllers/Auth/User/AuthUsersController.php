<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Auth\Requests\RequestLogin;
use App\Http\Controllers\Auth\User\Interface\VariableAuthUser;
use App\Http\Controllers\Controller;
use App\Messages\MessageUser;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthUsersController extends Controller implements VariableAuthUser
{
    public function login(RequestLogin $request): JsonResponse
    {
        $credentials = $request->only(self::USERNAME, self::PASSWORD);

        try {
            if (!$token = auth(self::API)->attempt($credentials)) {
                return response()->json([self::ERROR => MessageUser::USR001], 401);
            }
        } catch (JWTException $e) {
            return response()->json([self::ERROR => MessageUser::USR002], 500);
        }

        return response()->json($token);
    }

    public function me(): JsonResponse
    {
        try {
            $user = auth(self::API)->user();
        } catch (JWTException $e) {
            return response()->json([self::ERROR => MessageUser::USR003], 500);
        }

        return response()->json($user);
    }

    public function logout(): JsonResponse
    {
        try {
            auth(self::API)->logout();
        } catch (JWTException $e) {
            return response()->json([self::ERROR => MessageUser::USR004], 500);
        }

        return response()->json([self::MESSAGE => MessageUser::USR005]);
    }
}
