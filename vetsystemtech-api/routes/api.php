<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Users\AuthUsersController;
use App\Http\Controllers\Auth\Tutors\AuthTutorsController;
use App\Http\Controllers\Auth\Veterinarians\AuthVeterinariansController;

Route::group(['prefix' => 'user'], function () {
    Route::post('login', [AuthUsersController::class, 'login']);
    Route::group(['middleware' => 'auth.jwt:api'], function () {
        Route::get('me', [AuthUsersController::class, 'me']);
        Route::post('logout', [AuthUsersController::class, 'logout']);
    });
});

Route::group(['prefix' => 'tutor'], function () {
    Route::post('login', [AuthTutorsController::class, 'login']);
    Route::group(['middleware' => 'auth.jwt:tutor'], function () {
        Route::get('me', [AuthTutorsController::class, 'me']);
        Route::post('logout', [AuthTutorsController::class, 'logout']);
    });
});

Route::group(['prefix' => 'veterinarian'], function () {
    Route::post('login', [AuthVeterinariansController::class, 'login']);
    Route::group(['middleware' => 'auth.jwt:veterinarian'], function () {
        Route::get('me', [AuthVeterinariansController::class, 'me']);
        Route::post('logout', [AuthVeterinariansController::class, 'logout']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
