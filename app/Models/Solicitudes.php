<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    public function actividad()
    {
        return $this->belongsTo(Actividades::class);
    }
}