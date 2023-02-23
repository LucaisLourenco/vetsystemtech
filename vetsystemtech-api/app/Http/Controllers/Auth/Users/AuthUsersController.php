<?php

namespace App\Http\Controllers\Auth\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthUsersController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas.'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível criar o token.'], 500);
        }

        return response()->json(compact('token'));
    }

    public function me()
    {
        try {
            $user = auth('api')->user();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível obter as informações do usuário.'], 500);
        }

        return response()->json(compact('user'));
    }

    public function logout()
    {
        try {
            auth('api')->logout();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível sair.'], 500);
        }

        return response()->json(['message' => 'Usuário desconectado com sucesso.']);
    }
}
