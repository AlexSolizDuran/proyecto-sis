<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            create trigger impuesto_cal
            before insert
            on lote_mercaderia
            for each row
            BEGIN
	            set New.impuestos = New.precio_compra * (New.impuestos/100);
            END
        ");

        DB::statement("
            create trigger SumarCalzadosCantidad
            after insert
            on registro_lote
            for each row
            begin
                 update calzado
                set cantidad_pares = cantidad_pares + new.cantidad
                where cod = new.cod_calzado;
            end
        ");
        DB::statement("
        create trigger RestarCalzadosCantidad
        before delete
        on lote_mercaderia  
        for each row
        begin
            declare cantRegistroLote int;
            declare codigoCalzado int;
         declare finCursor boolean default false;
    
            declare reg cursor for
            select cod_calzado, cantidad from registro_lote
            where cod_lote = old.cod;
    
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET finCursor = TRUE;
            -- Abrir el cursor
            OPEN reg;

            -- Bucle para recorrer todas las filas
            leer_fila: LOOP
            -- Leer una fila y almacenarla en las variables
            FETCH reg INTO codigoCalzado, cantRegistroLote;
        
            -- Condición de salida del bucle si no hay más filas
            IF finCursor THEN
            LEAVE leer_fila;
            END IF;

            -- Operación que deseas realizar con cada fila
            UPDATE calzado
            SET cantidad_pares = cantidad_pares - cantRegistroLote
            WHERE cod = codigoCalzado;
        
            END LOOP leer_fila;

            -- Cerrar el cursor
            CLOSE reg;
        end
        ");
        DB::statement("
        create trigger precio
        before insert
        on registro_lote
        for each row
        begin
	    declare cant int;
        declare imp, prec, precl real;
        select cantidad_total_pares, impuestos, precio_compra, precio_logistica into
        cant, imp, prec, precl
        from lote_mercaderia
        where cod = new.cod_lote;
    
	        set new.precio_compra = (imp + prec + precl) / cant;
        end
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TRIGGER IF EXISTS impuesto_cal");
        DB::statement("DROP TRIGGER IF EXISTS SumarCalzadosCantidad");
        DB::statement("DROP TRIGGER IF EXISTS RestarCalzadosCantidad");
        DB::statement("DROP TRIGGER IF EXISTS precio");
    }
};
