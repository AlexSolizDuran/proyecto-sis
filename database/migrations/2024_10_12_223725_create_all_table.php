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
        Schema::create('administrador', function (Blueprint $table) {
            $table->string('cod',5)->primary();
            $table->integer('ci_persona');
            $table->foreign('ci_persona')
                  ->references('ci')
                  ->on('persona')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::create('cliente', function (Blueprint $table) {
            $table->integer('ci_persona')->primary();
            $table->foreign('ci_persona')
                  ->references('ci')
                  ->on('persona')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::create('nota_venta', function (Blueprint $table) {
            $table->increments('nro');  // Crea un campo auto-incremental 'nro' como clave primaria
            $table->date('fecha');  // Campo 'fecha' de tipo DATE
            $table->integer('monto_total');  // Campo 'monto_total' de tipo INT
            $table->integer('cantidad');  // Campo 'cantidad' de tipo INT
            $table->tinyInteger('estado')->default(1);
            $table->integer('descuento_total')->default(0);// Estado de la venta 1 cancelado, 2 por cancelar
            $table->integer('ci_cliente');  // Llave foránea a la tabla 'cliente'
            $table->string('cod_admin', 5);  // Llave foránea a la tabla 'administrador'

            // Definimos las llaves foráneas con restricciones en cascada
            $table->foreign('ci_cliente')
                  ->references('ci_persona')
                  ->on('cliente')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('cod_admin')
                  ->references('cod')
                  ->on('administrador')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::create('pais', function (Blueprint $table) {
            $table->string('cod', 5)->primary(); // Campo 'cod' como clave primaria
            $table->string('nombre', 15);  // Campo 'nombre' de tipo VARCHAR(15), NOT NULL por defecto
            $table->char('horma')->nullable();  // Campo 'horma' de tipo CHAR, puede ser NULL
        });
        Schema::create('marca', function (Blueprint $table) {
            $table->increments('cod');  // Campo 'cod' como clave primaria auto-incremental
            $table->string('nombre', 20);  // Campo 'nombre' de tipo VARCHAR con un máximo de 20 caracteres
        }); 
        Schema::create('modelo', function (Blueprint $table) {
            $table->increments('cod'); // Campo 'cod' como clave primaria auto-incremental
            $table->string('nombre', 20);  // Campo 'nombre' de tipo VARCHAR con un máximo de 20 caracteres
            $table->integer('cod_marca')->unsigned();  // Campo 'cod_marca' para la llave foránea

            // Definimos la llave foránea con restricciones en cascada
            $table->foreign('cod_marca')
                  ->references('cod')
                  ->on('marca')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::create('lote_mercaderia', function (Blueprint $table) {
            $table->increments('cod');  // Campo 'cod' como clave primaria
            $table->integer('cantidad_total_pares');  // Cantidad total de pares
            $table->double('impuestos'); // Campo 'impuestos' de tipo REAL
            $table->double('costo_compra');  // Precio de compra
            $table->date('fecha_compra');  // Fecha de compra
            $table->double('costo_logistica');  // Precio de logística
            $table->integer('cod_marca')->unsigned();  // Llave foránea a la tabla 'marca'

            // Definimos la llave foránea con restricciones en cascada
            $table->foreign('cod_marca')
                  ->references('cod')
                  ->on('marca')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::create('color', function (Blueprint $table) {
            $table->increments('cod');  // Campo 'cod' como clave primaria auto-incremental
            $table->string('nombre', 20)->nullable();  // Campo 'nombre' de tipo VARCHAR con un máximo de 20 caracteres
            $table->string('codigo_color', 20)->nullable();  // Campo 'codigo_color' de tipo VARCHAR con un máximo de 20 caracteres
        });
        Schema::create('material', function (Blueprint $table) {
            $table->increments('cod');  // Campo 'cod' como clave primaria
            $table->string('nombre', 20)->nullable();  // Campo 'nombre' de tipo VARCHAR con un máximo de 20 caracteres
        });
        Schema::create('talla', function (Blueprint $table) {
            $table->increments('cod');  // Campo 'cod' como clave primaria auto-incremental
            $table->smallInteger('numero');  // Campo 'numero' de tipo SMALLINT
        });
        Schema::create('calzado', function (Blueprint $table) {
            $table->increments('cod');  // Clave primaria auto-incremental
            $table->char('genero');  // Campo 'genero' de tipo CHAR
            $table->decimal('precio_venta', 5, 2)->nullable();  // Campo 'precio_unidad' de tipo DECIMAL
            $table->integer('cantidad_pares');  // Campo 'cantidad_pares' de tipo INT
            $table->decimal('costoPP');// costo promedio ponderado
            $table->decimal('costo_unitario')->default(0); 
            $table->string('imagen')->nullable();  // Añadimos el campo para la imagen
            $table->integer('cod_modelo')->unsigned()->nullable();  // Llave foránea a la tabla 'modelo'
            $table->integer('cod_talla')->unsigned()->nullable();  // Llave foránea a la tabla 'talla'
            $table->integer('cod_material')->unsigned()->nullable();  // Llave foránea a la tabla 'material'

            // Definición de las llaves foráneas
            $table->foreign('cod_modelo')
                  ->references('cod')
                  ->on('modelo')
                  ->onUpdate('cascade')
                  ->onDelete('set null');  // Cambiado a set null
                  
            $table->foreign('cod_talla')
                  ->references('cod')
                  ->on('talla')
                  ->onUpdate('cascade')
                  ->onDelete('set null');  // Cambiado a set null
                  
            $table->foreign('cod_material')
                  ->references('cod')
                  ->on('material')
                  ->onUpdate('cascade')
                  ->onDelete('set null');  // Cambiado a set null
        });
        Schema::create('registro_lote', function (Blueprint $table) {
            $table->integer('cod_calzado')->unsigned();  // Llave foránea a la tabla 'calzado'
            $table->integer('cod_lote')->unsigned();     // Llave foránea a la tabla 'lote_mercaderia'
            $table->integer('cantidad');                  // Cantidad asociada con el lote
            $table->decimal('costo_unitario');
            // Definir la clave primaria compuesta
            $table->primary(['cod_calzado', 'cod_lote']);

            // Definición de las llaves foráneas
            $table->foreign('cod_calzado')
                  ->references('cod')
                  ->on('calzado')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('cod_lote')
                  ->references('cod')
                  ->on('lote_mercaderia')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::create('color_calzado', function (Blueprint $table) {
            $table->integer('cod_calzado')->unsigned();  // Llave foránea a la tabla 'calzado'
            $table->integer('cod_color')->unsigned();     // Llave foránea a la tabla 'color'

            // Definición de las llaves foráneas
            $table->foreign('cod_calzado')
                  ->references('cod')
                  ->on('calzado')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('cod_color')
                  ->references('cod')
                  ->on('color')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            // Definir la clave primaria compuesta
            $table->primary(['cod_calzado', 'cod_color']);
        });
        Schema::create('registro_venta', function (Blueprint $table) {
            $table->increments('cod');  // Crea un campo auto-incremental 'cod' como clave primaria
            $table->integer('precio_venta');  // Campo 'precio_venta' de tipo INT
            $table->integer('cod_calzado')->unsigned()->nullable();  // Llave foránea a la tabla 'calzado'
            $table->integer('cantidad');
            $table->integer('descuento')->default(0);
            $table->integer('nro_venta')->unsigned();    // Llave foránea a la tabla 'nota_venta'

            // Definición de las llaves foráneas
            $table->foreign('cod_calzado')
                  ->references('cod')
                  ->on('calzado')
                  ->onUpdate('cascade')
                  ->onDelete('set null');

            $table->foreign('nro_venta')
                  ->references('nro')
                  ->on('nota_venta')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::create('compra_prov', function (Blueprint $table) {
            $table->integer('cod_lote')->unsigned();  // Llave foránea a la tabla 'lote_mercaderia'
            $table->string('cod_pais', 5);  // Llave foránea a la tabla 'pais'
            $table->bigInteger('NIT');  // Número de identificación tributaria (NIT)
            $table->string('nombre', 20)->nullable();  // Nombre del proveedor, puede ser nulo

            // Definición de las llaves foráneas
            $table->foreign('cod_lote')
                  ->references('cod')
                  ->on('lote_mercaderia')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('cod_pais')
                  ->references('cod')
                  ->on('pais')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            // Clave primaria compuesta
            $table->primary(['cod_lote', 'cod_pais']);
        });

        Schema::create('bitacora', function (Blueprint $table) {
            $table->id();
            $table->String('ip'); // Dirección IP
            $table->string('accion'); // Descripción de la acción
            $table->date('fecha'); // Fecha de la acción
            $table->time('hora'); // Hora de la acción
            $table->integer('ci')->nullable();

            $table->foreign('ci')
                  ->references('ci_persona')
                  ->on('cliente')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_calzado');         // Elimina la tabla 'color_calzado'
        Schema::dropIfExists('registro_venta');        // Elimina la tabla 'registro_venta'
        Schema::dropIfExists('registro_lote');         // Elimina la tabla 'registro_lote'
        Schema::dropIfExists('calzado');                // Elimina la tabla 'calzado'
        Schema::dropIfExists('lote_mercaderia');       // Elimina la tabla 'lote_mercaderia'
        Schema::dropIfExists('modelo');                 // Elimina la tabla 'modelo'
        Schema::dropIfExists('marca');                  // Elimina la tabla 'marca'
        Schema::dropIfExists('talla');                  // Elimina la tabla 'talla'
        Schema::dropIfExists('material');               // Elimina la tabla 'material'
        Schema::dropIfExists('pais');                   // Elimina la tabla 'pais'
        Schema::dropIfExists('compra_prov');            // Elimina la tabla 'compra_prov'
        Schema::dropIfExists('nota_venta');             // Elimina la tabla 'nota_venta'
        Schema::dropIfExists('cliente');                // Elimina la tabla 'cliente'
        Schema::dropIfExists('administrador');          // Elimina la tabla 'administrador'
        Schema::dropIfExists('bitacora');               // Elimina la tabla 'bitacora'

    }
};
