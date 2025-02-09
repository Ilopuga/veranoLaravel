<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SolicitudController;

// Rutas protegidas por autenticación (solo accesibles para usuarios logueados)
Route::middleware(['auth:sanctum'])->group(function () {
    // Obtener todas las solicitudes (solo usuarios autenticados)
    Route::middleware('api')->get('/solicitudes', [SolicitudController::class, 'index']);
    
    // Crear una solicitud (solo usuarios autenticados)
    Route::middleware('api')->post('/solicitudes', [SolicitudController::class, 'add']);
    
    // Eliminar una solicitud (solo usuarios autenticados)
    Route::middleware('api')->delete('/solicitudes/{id}', [SolicitudController::class, 'delete']);
});

// Rutas de autenticación
Route::middleware(['auth:sanctum'])->group(function () {
    // Obtener información del usuario autenticado
    Route::get('/user', [AuthController::class, 'user']);
    
    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Rutas públicas para login y registro
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->post('/solicitudes', [SolicitudController::class, 'add']);

// Ruta para obtener las solicitudes solo si el usuario está autenticado
Route::middleware('auth:sanctum')->get('/solicitudes', [SolicitudController::class, 'index']);

// Ruta para agregar una solicitud solo si el usuario está autenticado
Route::middleware('auth:sanctum')->post('/solicitudes', [SolicitudController::class, 'store']);

