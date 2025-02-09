<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('solicitudes', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable(); // Establece la relación con el usuario
        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // Añadir la clave foránea
    });
}

public function down()
{
    Schema::table('solicitudes', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}

};
