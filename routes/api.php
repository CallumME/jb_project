<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeatherController;


// API Routes
Route::middleware('auth:sanctum')->group(function () {
    // User routes
    Route::resource('users', UserController::class)->except(['create', 'edit', 'destroy', 'update', 'index']);

    // Post routes
    Route::resource('posts', PostController::class)->except(['create', 'edit']);

    Route::get('/weather', [WeatherController::class, 'showWeather']);

});


// Public API Routes
Route::post('/login', [AuthController::class, 'login'])->name('login');
;
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/heartbeat', function () {
    return response()->json([
        'message' => 'This is a public route',
    ]);
});