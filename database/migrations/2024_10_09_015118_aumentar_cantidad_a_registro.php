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
        Schema::table('registro_venta', function (Blueprint $table) {
            $table->integer('cantidad')->nullable(); // Agregar la columna 'cantidad', puedes cambiar nullable() según necesites
        });
    }

    public function down()
    {
        Schema::table('registro_venta', function (Blueprint $table) {
            $table->dropColumn('cantidad'); // Eliminar la columna 'cantidad' al revertir la migración
        });
    }
};
