<?php

namespace App\Http\Controllers\Auth\Tutors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\MyApp;

class AuthTutorsController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (!$token = auth('tutor')->attempt($credentials)) {
                return response()->json(['error' => MyApp::ERROR_CREDENCIAIS], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => MyApp::ERROR_GERAR_TOKEN], 500);
        }

        return response()->json(compact('token'));
    }

    public function me()
    {
        try {
            $tutor = auth('tutor')->user();
        } catch (JWTException $e) {
            return response()->json(['error' => MyApp::ERROR_GERAR_CONFIG_USER], 500);
        }

        return response()->json(compact('tutor'));
    }

    public function logout()
    {
        try {
            auth('tutor')->logout();
        } catch (JWTException $e) {
            return response()->json(['error' => MyApp::ERROR_LOGOFF], 500);
        }

        return response()->json(['message' => MyApp::SUCCESS_LOGOFF_CLIENTE]);
    }
}
