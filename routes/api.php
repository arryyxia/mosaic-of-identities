<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenjualController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
});

Route::group(['prefix' => 'penjual'], function () {
    Route::get('/', [PenjualController::class, 'index']);
    Route::get('/{id}', [PenjualController::class, 'show']);
});

Route::group(['prefix' => 'backend'], function () {
    Route::post('/penjual', [PenjualController::class, 'store']);
    Route::put('/penjual/{id}', [PenjualController::class, 'update']);
    Route::delete('/penjual/{id}', [PenjualController::class, 'destroy']);
})->middleware('auth:sanctum');
// Controller imports