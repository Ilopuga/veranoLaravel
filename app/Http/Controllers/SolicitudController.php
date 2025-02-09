<?php

namespace App\Http\Controllers;

use App\Models\Solicitudes;
use Illuminate\Http\Request;
use App\Models\Actividades;  // Asegúrate de importar el modelo Actividades

class SolicitudController extends Controller
{
    // Método para agregar nuevas solicitudes
    public function add(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'dni' => 'required|string|max:255',  // DNI es obligatorio
            'nombre' => 'required|string|max:255',  // Nombre es obligatorio
            'email' => 'required|email|max:255',  // Email es obligatorio y debe tener formato válido
            'telefono' => 'required|string|max:20',  // Teléfono es obligatorio
            'actividad_id' => 'required|exists:actividades,id',  // Actividad debe existir en la tabla actividades
        ]);

        // Creación de la nueva solicitud
        $solicitud = Solicitudes::create([
            'dni' => $validated['dni'],
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'telefono' => $validated['telefono'],
            'actividad_id' => $validated['actividad_id'],
            'user_id' => auth()->id(), // Asocia la solicitud al usuario autenticado
        ]);

        // Retorno de la nueva solicitud con código de estado 201
        return response()->json($solicitud, 201);
    }

    // Función para obtener las solicitudes del usuario logueado
    public function index()
    {
        // Solo devolver solicitudes del usuario autenticado
        return response()->json(Solicitudes::where('user_id', auth()->id())->get());
    }

    // Función para eliminar una solicitud
    public function delete($id)
    {
        // Buscar la solicitud por su ID y asegurar que sea del usuario logueado
        $solicitud = Solicitudes::where('user_id', auth()->id()) // Solo permite eliminar solicitudes del usuario autenticado
            ->findOrFail($id);

        // Eliminar la solicitud
        $solicitud->delete();

        // Retornar mensaje de éxito
        return response()->json(['message' => 'Solicitud eliminada correctamente']);
    }
}
