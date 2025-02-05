<?php

namespace App\Http\Controllers;

use App\Models\Solicitudes;  // Asegúrate de que esta línea esté presente, y esté apuntando al modelo, no al controlador
use App\Models\Actividades;  // Asegúrate de que esta línea esté presente, y esté apuntando al modelo, no al controlador
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitudes::with('actividad')->get();
        return response()->json($solicitudes);
    }
}
