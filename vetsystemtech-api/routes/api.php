<?php

use App\Http\Controllers\Auth\Tutor\TutorsController;
use App\Http\Controllers\Auth\User\UsersController;
use App\Http\Controllers\Auth\Veterinarian\VeterinariansController;
use App\Http\Controllers\Tutor\TutorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [UsersController::class, 'login']);
Route::group(['middleware' => 'authUser.jwt:api'], function () {
    Route::get('me', [UsersController::class, 'me']);
    Route::post('logout', [UsersController::class, 'logout']);
    Route::post('createTutor', [TutorController::class, 'store']);
    Route::delete('deleteTutor', [TutorController::class, 'destroy']);
    Route::delete('tutors', [TutorController::class, 'index']);
});

Route::group(['prefix' => 'tutor'], function () {
    Route::post('login', [TutorsController::class, 'login']);
    Route::group(['middleware' => 'auth.jwt:tutor'], function () {
        Route::get('me', [TutorsController::class, 'me']);
        Route::post('logout', [TutorsController::class, 'logout']);
    });
});

Route::group(['prefix' => 'veterinarian'], function () {
    Route::post('login', [VeterinariansController::class, 'login']);
    Route::group(['middleware' => 'auth.jwt:veterinarian'], function () {
        Route::get('me', [VeterinariansController::class, 'me']);
        Route::post('logout', [VeterinariansController::class, 'logout']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
