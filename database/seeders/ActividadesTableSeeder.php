<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActividadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('actividades')->insert([
            'nombre' => 'Circo en la naturaleza',
            'tema' => 'Arte',
            'plazas' => 30,
            'descripcion' => 'Aprende las técnicas de clown y circo en un entorno natural incomparable.',
        ]);
        
        DB::table('actividades')->insert([
            'nombre' => 'Aquasport',
            'tema' => 'Acuático',
            'plazas' => 50,
            'descripcion' => 'Práctica deportes acuáticos en las playas de interior de Extremadura y pasa el mejor verano posible.',
        ]);
        
        DB::table('actividades')->insert([
            'nombre' => 'Ruinas de la antigua Roma',
            'tema' => 'Arqueología',
            'plazas' => 45,
            'descripcion' => 'Vuelve a la antigua Roma y descubre los secretos de la civilización más grande de la historia.',
        ]);
    }
}

