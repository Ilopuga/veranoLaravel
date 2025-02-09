<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Solicitudes extends Model
{
    use HasFactory;

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'dni', 
        'nombre', 
        'email', 
        'telefono', 
        'actividad_id', 
        'user_id',
    ];

    // Relación con Actividades
    public function actividad()
    {
        return $this->belongsTo(Actividades::class);  // Relación con la tabla Actividades
    }

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);  // Relación con la tabla Users
    }
}
