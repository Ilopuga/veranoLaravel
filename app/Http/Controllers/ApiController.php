<?php

namespace App\Http\Controllers;

use App\Models\Solicitudes;  
use App\Models\Actividades;  
use Illuminate\Http\Request;

class ApiController extends Controller{

    
    //Función para leer
    public function index()
    {
        $solicitudes = Solicitudes::with('actividad')->get();
        return response()->json($solicitudes);
    }

    // Función para add nueva solicitud a través de API
    public function add(Request $request){
       try {
        request ()->validate([
            'dni' => 'required|string',
            'nombre' => 'required|string',
            'email' => 'required|string',
            'telefono' => 'required|integer',
            'actividad_id' => 'required|integer',

        ]);
        //Rescatar los datos y almacenarlos en la base de datos
        $solicitudes = new Solicitudes();
        $solicitudes->dni = $request->input('dni');
        $solicitudes->nombre = $request->input('nombre');
        $solicitudes->email = $request->input('email');
        $solicitudes->telefono = $request->input('telefono');
        $solicitudes->actividad_id = $request->input('actividad_id');
        //Con Eloquent se puede guardar los datos en la base de datos
        $solicitudes->save();
        //Devolver la respuesta añadida
        return response()->json($solicitudes, 201);

        } catch (\Exception $e) {
        return response()->json(['error' => 'Error'], 500);
        }
    }

    // Función para eliminar solicitud a través de API por ID
    public function delete($id){
        $solicitudes = Solicitudes::find($id);
        if(!$solicitudes){
            return response()->json(['error' => 'No existe la solicitud'], 404);
        }else {
            $solicitudes->delete();
        }
        return response()->json(['success' => 'Solicitud eliminada'], 200);

    }

}
