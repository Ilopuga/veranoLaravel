<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitudController;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth:sanctum')->get('/solicitudes', [SolicitudController::class, 'index']);
Route::middleware('auth:sanctum')->post('/solicitudes', [SolicitudController::class, 'store']);

