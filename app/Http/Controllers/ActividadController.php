<?php

namespace App\Http\Controllers;

use App\Models\Actividades;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    /**
     * Método para obtener todas las actividades
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Devuelve todas las actividades en formato JSON
        return response()->json(Actividades::all());
    }
}
