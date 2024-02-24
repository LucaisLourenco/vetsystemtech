<?php

namespace App\Http\Controllers\Auth\Cliente;

use App\Http\Controllers\Auth\Cliente\Interface\VariableAuthTutor;
use App\Http\Controllers\Controller;
use App\Messages\MensagemCliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthTutorsController extends Controller implements VariableAuthTutor
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only(self::USERNAME, self::PASSWORD);

        try {
            if (!$token = auth(self::TUTOR)->attempt($credentials)) {
                return response()->json([self::ERROR => MensagemCliente::CLT001], 401);
            }
        } catch (JWTException $e) {
            return response()->json([self::ERROR => MensagemCliente::CLT002], 500);
        }

        return response()->json($token);
    }

    public function me(): JsonResponse
    {
        try {
            $tutor = auth(self::TUTOR)->user();
        } catch (JWTException $e) {
            return response()->json([self::ERROR => MensagemCliente::CLT003], 500);
        }

        return response()->json($tutor);
    }

    public function logout(): JsonResponse
    {
        try {
            auth(self::TUTOR)->logout();
        } catch (JWTException $e) {
            return response()->json([self::ERROR => MensagemCliente::CLT004], 500);
        }

        return response()->json([self::MESSAGE => MensagemCliente::CLT005]);
    }
}
