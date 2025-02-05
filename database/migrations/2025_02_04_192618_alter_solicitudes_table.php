<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /** Creamos una nueva columna en la tabla--> unSignedBigInteger('actividad_id')
         * le ponemos que permita valores null--> nullable()
         * e indicamos que es clave foránea--> foreign('actividad_id')
         * configuramos para que si se borra la actividad no se borre la solicitud--> onDelete('set null')
        */
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->unSignedBigInteger('actividad_id')->nullable();
            $table->foreign('actividad_id')->references('id')->on('actividades')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};