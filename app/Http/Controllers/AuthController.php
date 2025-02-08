<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Método para registrar un usuario
    public function register(Request $request)
    {
        //Validamos los datos
        $request= $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            
        ]);

        //Crear un nuevo usuario
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => hash::make($request['password']),
            //El hash::make() es para encriptar la contraseña
        ]);

        //Generar un token para el usuario y poder trabajar luego con el
        $token = $user->createToken('authToken')->plainTextToken;
        //Retornamos el token
        return response()->json(['message' => 'Usuario registrado correctamente', 'token' => $token], 200);

    }

    //Método para loguear un usuario
    public function login(Request $request){
        //recibe los datos del usuario
        $credentials = $request->only('email', 'password');
        //comprobamos si los datos son correctos
        if (Auth::attempt($credentials)) {
            $user= Auth::user();
            //Generar el token<
            $token = $user->createToken('authToken')->plainTextToken;
            //Retornamos el token
            return response()->json(['message' => 'Usuario logueado correctamente', 'token' => $token], 200);
        }else{
            return response()->json(['message' => 'Usuario o contraseña incorrectos'], 401);
        }

    }

    //Función para devolver los datos del usuario logueado
    public function user(Request $request){
        $user = $request->user();
        if($user){
            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
            ]);
        }else{
            return response()->json(['message' => 'No se ha encontrado el usuario'], 404);
        }
    }

    //Función para cerrar sesión
    public function logout(Request $request){
        Auth::logout();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}