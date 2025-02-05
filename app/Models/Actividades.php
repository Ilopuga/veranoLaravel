<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
     /**
     * Relación con la tabla solicitudes
     * Explicación: una actividad tiene muchas solicitudes
     * una solicitud pertenece a una actividad
     */
    public function solicitudes()
    {
        return $this->hasMany(Solicitudes::class);
    }
}