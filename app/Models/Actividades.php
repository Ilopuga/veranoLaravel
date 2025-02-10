<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actividades extends Model
{
    use HasFactory;
    //HasFactory es para poder para crear registros de prueba, luego

    // Definir la relación con Solicitudes
    // Una actividad puede tener muchas solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitudes::class);
    }

    // fillable es para definir los campos que se pueden modificar
    protected $fillable = ['nombre', 'tema', 'plazas', 'descripcion'];
}
