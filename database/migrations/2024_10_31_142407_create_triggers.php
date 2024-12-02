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
	            set New.impuestos = New.costo_compra * (New.impuestos/100);
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
        select cantidad_total_pares, impuestos, costo_compra, costo_logistica into
        cant, imp, prec, precl
        from lote_mercaderia
        where cod = new.cod_lote;
	        set new.costo_unitario = (imp + prec + precl) / cant;

        UPDATE calzado
        SET costo_unitario = NEW.costo_unitario
        WHERE cod = NEW.cod_calzado;
        end
        ");

        DB::statement("
        create TRIGGER actualizar_monto_y_cantidad 
        AFTER INSERT
        ON registro_venta
        FOR EACH ROW
        BEGIN
            -- Actualizar el monto_total sumando el precio de venta del registro
            declare sumaT, cant int;
            declare desT decimal(5,2);
            set sumaT = New.cantidad * New.precio_venta;
            set desT = New.cantidad * New.descuento;
            set cant = (select sum(cantidad) from registro_venta where nro_venta = New.nro_venta);
            
            UPDATE nota_venta
            SET monto_total = monto_total + sumaT,
            cantidad = cant,
            descuento_total = descuento_total + desT
            WHERE nro = NEW.nro_venta;
        END");

        DB::statement("
        create trigger DescontarAlVender
        after insert
        on registro_venta
        for each row
        begin
            declare cant, a int;
            set cant = New.cantidad;
            set a = (select cantidad_pares from calzado where cod = New.cod_calzado);
            update calzado
            set cantidad_pares = a - cant
            where cod = New.cod_calzado;
        end");

        DB::statement("
        CREATE TRIGGER actualizar_costoPP_after_insert
        AFTER INSERT ON registro_lote
        FOR EACH ROW
        BEGIN
            DECLARE total_costo DECIMAL(10,2);
            DECLARE total_cantidad INT;
            
            -- Calcular la suma total del costo ponderado y la cantidad total
            SELECT SUM(r.cantidad * r.costo_unitario), SUM(r.cantidad)
            INTO total_costo, total_cantidad
            FROM registro_lote r
            WHERE r.cod_calzado = NEW.cod_calzado;

            -- Calcular el costoPP (Precio Promedio Ponderado)
            IF total_cantidad > 0 THEN
                UPDATE calzado
                SET costoPP = total_costo / total_cantidad
                WHERE cod = NEW.cod_calzado;
            END IF;
        END");

        DB::statement("
            CREATE TRIGGER aplicarDescuento
            BEFORE INSERT
            ON registro_venta
            FOR EACH ROW
            BEGIN
                DECLARE nroLote INT;
                DECLARE fechaVenta DATE;
                DECLARE fechaCompra DATE;
                DECLARE descuento decimal(5,2);
                DECLARE dia INT;
                
                -- Obtener la fecha de la venta
                SET fechaVenta = (SELECT fecha FROM nota_venta WHERE nro = NEW.nro_venta);
                
                -- Obtener la fecha de compra del calzado
                SET nroLote = (SELECT cod_lote 
                            FROM registro_lote 
                            WHERE cod_calzado = NEW.cod_calzado 
                            LIMIT 1);
                
                SET fechaCompra = (SELECT fecha_compra 
                                FROM lote_mercaderia 
                                WHERE cod = nroLote);
                
                -- Calcular la diferencia de días entre la compra y la venta
                SET dia = DATEDIFF(fechaVenta, fechaCompra);
                
                -- Obtener el descuento basado en el calzado
                SET descuento = (SELECT precio_venta - costo_unitario 
                                FROM calzado 
                                WHERE cod = NEW.cod_calzado);
                
                -- Aplicar el descuento si corresponde
                IF dia >= 300 THEN
                    SET NEW.descuento = descuento;
                ELSE
                    SET NEW.descuento = 0; -- Sin descuento si no cumple la condición
                END IF;
            END
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
        DB::statement("DROP TRIGGER IF EXISTS actualizar_monto_y_cantidad");
        DB::statement("DROP TRIGGER IF EXISTS DescontarAlVender");
        DB::statement("DROP TRIGGER IF EXISTS actualizar_costoPP_after_insert");
        DB::statement("DROP TRIGGER IF EXISTS aplicarDescuento");

    }
};
