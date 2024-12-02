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
        DB::statement('DROP PROCEDURE IF EXISTS CantidadVendidaEntreFechas');
        DB::statement('
            CREATE PROCEDURE CantidadVendidaEntreFechas(IN fechaIni DATE, IN fechaFin DATE)
            BEGIN
                SELECT 
                    DATE_FORMAT(nota_venta.fecha, "%y-%m-%d") AS mes, 
                    rv.cod_calzado, 
                    rv.cantidad, 
                    rv.precio_venta,
                    rv.descuento
                FROM 
                    nota_venta
                JOIN 
                    registro_venta rv 
                ON 
                    rv.nro_venta = nota_venta.nro
                WHERE 
                    nota_venta.fecha >= fechaIni 
                    AND nota_venta.fecha <= fechaFin;
            END
        ');
        DB::statement('DROP PROCEDURE IF EXISTS ReporteGananciaTotal');

        // Procedimiento 2: ReporteGananciaTotal
        DB::statement('
            CREATE PROCEDURE ReporteGananciaTotal(IN fechaInicial DATE, IN fechaFinal DATE)
            BEGIN
                SELECT 
                    DATE_FORMAT(nv.fecha, "%y-%m-%d") AS mes, 
                    rv.cod_calzado, 
                    rv.cantidad, 
                    rv.precio_venta,
                    rv.descuento, 
                    c.costoPP
                FROM 
                    nota_venta nv
                JOIN 
                    registro_venta rv ON nv.nro = rv.nro_venta
                JOIN 
                    calzado c ON rv.cod_calzado = c.cod
                WHERE 
                    nv.fecha >= fechaInicial 
                    AND nv.fecha <= fechaFinal;
            END
        ');
        DB::statement('DROP PROCEDURE IF EXISTS TierVendidoMarcaModeloEntreFechas');

        // Procedimiento 3: TierVendidoMarcaModeloEntreFechas
        DB::statement('
            CREATE PROCEDURE TierVendidoMarcaModeloEntreFechas(IN fechaInicial DATE, IN fechaFinal DATE)
            BEGIN
                SELECT 
                    COUNT(ma.nombre) AS cantidad, 
                    ma.nombre AS marca, 
                    mo.nombre AS modelo
                FROM 
                    nota_venta nv
                JOIN 
                    registro_venta rv ON nv.nro = rv.nro_venta
                JOIN 
                    calzado ca ON rv.cod_calzado = ca.cod
                JOIN 
                    modelo mo ON ca.cod_modelo = mo.cod
                JOIN 
                    marca ma ON mo.cod_marca = ma.cod
                WHERE 
                    nv.fecha >= fechaInicial 
                    AND nv.fecha <= fechaFinal
                GROUP BY 
                    ma.nombre, mo.nombre;
            END
        ');

        DB::statement('DROP PROCEDURE IF EXISTS CantidadColorVendidoEntre');

        // Procedimiento 4: CantidadColorVendidoEntre
        DB::statement('
            create procedure CantidadColorVendidoEntre(fechaInicial date, fechaFinal date)
            begin
            select count(color.nombre) as cantidad, color.nombre, color.cod
            from color
            join color_calzado on cod_color = color.cod
            join calzado on color_calzado.cod_calzado = calzado.cod
            join registro_venta on registro_venta.cod_calzado = calzado.cod
            join nota_venta on nota_venta.nro = registro_venta.nro_venta
            where nota_venta.fecha>=fechaInicial and nota_venta.fecha<=fechaFinal
            group by color.cod, color.nombre;

            end
        ');

        DB::statement('DROP PROCEDURE IF EXISTS CantidadtallasVendidoEntre');
        
        // Procedimiento 5: CantidadtallasVendidoEntre
        DB::statement('
            create procedure CantidadtallasVendidoEntre(fechaInicial date, fechaFinal date)
            begin
            select count(talla.cod) as cantidad, talla.cod, talla.numero
            from talla
            join calzado on talla.cod = calzado.cod_talla
            join registro_venta on registro_venta.cod_calzado = calzado.cod
            join nota_venta on nota_venta.nro = registro_venta.nro_venta
            where nota_venta.fecha>=fechaInicial and nota_venta.fecha<=fechaFinal
            group by talla.cod,talla.numero;
            end
        ');

        DB::statement('DROP PROCEDURE IF EXISTS CantidadGeneroVendido');
        
        // Procedimiento 6: CantidadtallasVendidoEntre
        DB::statement('
            create procedure CantidadGeneroVendido(gen char, tallaini int, tallafin int)
            begin
            select count(registro_venta.cod) as cantidad , talla.numero
            from registro_venta,calzado
            join talla on talla.cod = calzado.cod_talla
            where registro_venta.cod=calzado.cod and calzado.genero = gen COLLATE utf8mb4_unicode_ci
            group by  talla.numero
            having talla.numero >= tallaini and talla.numero <= tallafin;
            end
        ');

        DB::statement('DROP PROCEDURE IF EXISTS TotalInvercion');
        
        // Procedimiento 7: TotalInvercion
        DB::statement('
            create procedure TotalInvercion(fechaInicial date, fechaFinal date) 
            begin
                select calzado.costoPP , sum(registro_lote.cantidad) as cantidad, calzado.cod, marca.nombre as marca , modelo.nombre as modelo
                from calzado
                join registro_lote on calzado.cod = registro_lote.cod_calzado
                join modelo on modelo.cod = calzado.cod_modelo
                join marca on marca.cod = modelo.cod_marca
                join lote_mercaderia on lote_mercaderia.cod = registro_lote.cod_lote
                where lote_mercaderia.fecha_compra>=fechaInicial and lote_mercaderia.fecha_compra<=fechaFinal
                group by calzado.costoPP , calzado.cod, marca.nombre, modelo.nombre;
            end
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP PROCEDURE IF EXISTS CantidadVendidaEntreFechas');
        DB::statement('DROP PROCEDURE IF EXISTS ReporteGananciaTotal');
        DB::statement('DROP PROCEDURE IF EXISTS TierVendidoMarcaModeloEntreFechas');
        DB::statement('DROP PROCEDURE IF EXISTS CantidadColorVendidoEntre');
        DB::statement('DROP PROCEDURE IF EXISTS CantidadtallasVendidoEntre');
        DB::statement('DROP PROCEDURE IF EXISTS CantidadGeneroVendido');
        DB::statement('DROP PROCEDURE IF EXISTS TotalInvercion');

    }
};
