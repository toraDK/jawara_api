<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HouseController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
Route::get('/houses/options', [HouseController::class, 'options']);

Route::middleware('jwt.auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
