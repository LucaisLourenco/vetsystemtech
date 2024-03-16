<?php

namespace App\Http\Controllers\Auth\Veterinarian;

use App\Http\Controllers\Auth\Veterinarian\Interface\VariableVeterinarian;
use App\Http\Controllers\Controller;
use App\Messages\MessageVeterinarian;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class VeterinariansController extends Controller implements VariableVeterinarian
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only(self::USERNAME, self::PASSWORD);

        try {
            if (!$token = auth(self::VETERINARIAN)->attempt($credentials)) {
                return response()->json([self::ERROR => MessageVeterinarian::VTR001], 401);
            }
        } catch (JWTException $e) {
            return response()->json([self::ERROR => MessageVeterinarian::VTR002], 500);
        }

        return response()->json($token);
    }

    public function me(): JsonResponse
    {
        try {
            $veterinarian = auth(self::VETERINARIAN)->user();
        } catch (JWTException $e) {
            return response()->json([self::ERROR => MessageVeterinarian::VTR003], 500);
        }

        return response()->json($veterinarian);
    }

    public function logout(): JsonResponse
    {
        try {
            auth(self::VETERINARIAN)->logout();
        } catch (JWTException $e) {
            return response()->json([self::ERROR => MessageVeterinarian::VTR004], 500);
        }

        return response()->json([self::MESSAGE => MessageVeterinarian::VTR005]);
    }
}
