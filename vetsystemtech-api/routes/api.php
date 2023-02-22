<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Users\AuthUsersController;
use App\Http\Controllers\Auth\Tutors\AuthTutorsController;
use App\Http\Controllers\Auth\Veterinarians\AuthVeterinariansController;

Route::group(['prefix' => 'user'], function () {
    Route::post('login', [AuthUsersController::class, 'login']);
    Route::group(['middleware' => 'auth:user'], function () {
        Route::get('me', [AuthUsersController::class, 'me']);
        Route::post('logout', [AuthUsersController::class, 'logout']);
    });
});

Route::group(['prefix' => 'tutor'], function () {
    Route::post('login', [AuthUTutorsController::class, 'login']);
    Route::group(['middleware' => 'auth:tutor'], function () {
        Route::get('me', [AuthUTutorsController::class, 'me']);
        Route::post('logout', [AuthUTutorsController::class, 'logout']);
    });
});

Route::group(['prefix' => 'veterinarian'], function () {
    Route::post('login', [AuthVeterinariansController::class, 'login']);
    Route::group(['middleware' => 'auth:veterinarian'], function () {
        Route::get('me', [AuthVeterinariansController::class, 'me']);
        Route::post('logout', [AuthVeterinariansController::class, 'logout']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
