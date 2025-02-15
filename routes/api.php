<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\ActividadController;

// Rutas protegidas por autenticación (solo accesibles para usuarios logueados)
Route::middleware(['auth:sanctum'])->group(function () {
    // Obtener todas las solicitudes (solo usuarios autenticados)
    Route::get('/solicitudes', [SolicitudController::class, 'index']);
    
    // Obtener una solicitud específica por ID (solo usuarios autenticados)
    Route::get('/solicitudes/{id}', [SolicitudController::class, 'show']);  // Esta es la ruta que falta

    // Crear una solicitud (solo usuarios autenticados)
    Route::post('/solicitudes', [SolicitudController::class, 'add']);
    
    // Eliminar una solicitud (solo usuarios autenticados)
    Route::delete('/solicitudes/{id}', [SolicitudController::class, 'delete']);

    // Actualizar una solicitud (solo usuarios autenticados)
    Route::put('/solicitudes/{id}', [SolicitudController::class, 'update']);
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
Route::middleware('auth:sanctum')->post('/solicitudes', [SolicitudController::class, 'add']);


// Rutas de la API para obtener las actividades
Route::middleware('auth:sanctum')->get('/actividades', [ActividadController::class, 'index']);
