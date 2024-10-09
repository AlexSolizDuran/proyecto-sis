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
        Schema::table('users', function (Blueprint $table) {
            // Añadir la columna cod como llave foránea
            $table->string('cod', 5)->nullable(); // Ajusta el tamaño según sea necesario

            // Definir la llave foránea apuntando a la tabla administrador
            $table->foreign('cod')
                  ->references('cod')
                  ->on('administrador')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar la llave foránea
            $table->dropForeign(['cod']);
            
            // Eliminar la columna cod
            $table->dropColumn('cod');
        });
    }
};
