<?php

namespace App\Http\Controllers;

use App\Models\Solicitudes;  // Asegúrate de que el nombre del modelo esté correctamente importadoasd
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    /**
     * Mostrar la lista de todas las solicitudes.
     */
    public function index()
    {
        // Aquí se obtiene la lista de solicitudes
        $solicitudes = Solicitudes::all();  // Recupera todas las solicitudes
        return response()->json($solicitudes);  // Devuelve las solicitudes en formato JSON
    }

    /**
     * Agregar una nueva solicitud.
     */
    public function add(Request $request)
    {
        // Validación de los datos enviados
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',  // El campo nombre es obligatorio y debe ser una cadena
            'descripcion' => 'nullable|string',  // El campo descripcion es opcional
        ]);

        // Creación de una nueva solicitud
        $solicitud = Solicitudes::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'] ?? null,  // Si no se proporciona, se coloca null
        ]);

        // Retorna la nueva solicitud con código de estado 201 (Creado)
        return response()->json($solicitud, 201);
    }

    /**
     * Eliminar una solicitud por su ID.
     */
    public function delete($id)
    {
        // Busca la solicitud por su ID, si no se encuentra lanza un error 404
        $solicitud = Solicitudes::findOrFail($id);

        // Elimina la solicitud
        $solicitud->delete();

        // Devuelve un mensaje confirmando que la solicitud fue eliminada
        return response()->json(['message' => 'Solicitud eliminada correctamente']);
    }
}
