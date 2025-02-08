<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

Route::middleware('api')->get('/solicitudes', [ApiController::class, 'index']);
Route::middleware('api')->post('/solicitudes', [ApiController::class, 'add']);
Route::middleware('api')->delete('/solicitudes/{id}', [ApiController::class, 'delete']);

//Rutas de autenticación
Route::middleware(['auth:sanctum'])->group(function () {
    //Obtener información del usuario autenticado
    Route::get('/user', [AuthController::class, 'user']);
    //Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout']);
});

//2 vistas más post y get para que cuando estemos en Vue no tengamos problemas
// Le damos nombre a las rutas para poder usarlas en el front
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);