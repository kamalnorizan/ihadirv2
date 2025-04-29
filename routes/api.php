<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PassportAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [PassportAuthController::class, 'login']);
Route::post('/register', [PassportAuthController::class, 'register']);
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [PassportAuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
