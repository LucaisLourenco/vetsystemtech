<?php

namespace App\Http\Controllers\Auth\Tutors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTutorsController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (!$token = auth('tutor')->attempt($credentials)) {
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
            $tutor = auth('tutor')->user();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível obter as informações do usuário.'], 500);
        }

        return response()->json(compact('tutor'));
    }

    public function logout()
    {
        try {
            auth('tutor')->logout();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível sair.'], 500);
        }

        return response()->json(['message' => 'Veterinário desconectado com sucesso.']);
    }
}
