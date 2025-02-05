<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::middleware('api')->get('/solicitudes', [ApiController::class, 'index']);
Route::middleware('api')->post('/solicitudes', [ApiController::class, 'add']);

