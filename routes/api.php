<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\ActividadController;

// Rutas protegidas por autenticación (solo con login)
Route::middleware(['auth:sanctum'])->group(function () {
    // Obtener todas las solicitudes
    Route::get('/solicitudes', [SolicitudController::class, 'index']);
    
    // Obtener una solicitud específica por ID
    Route::get('/solicitudes/{id}', [SolicitudController::class, 'show']);  

    // Crear una solicitud 
    Route::post('/solicitudes', [SolicitudController::class, 'add']);
    
    // Eliminar una solicitud 
    Route::delete('/solicitudes/{id}', [SolicitudController::class, 'delete']);

    // Actualizar una solicitud 
    Route::put('/solicitudes/{id}', [SolicitudController::class, 'update']);

    // Rutas de autenticación
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Rutas públicas para login y registro
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

// Ruta para obtener todas las actividades (pública)
Route::get('/actividades', [ActividadController::class, 'index']);
