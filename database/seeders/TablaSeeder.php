<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  

class TablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Talla
        $tallas = range(16, 50);
        foreach ($tallas as $numero) {
            DB::table('talla')->insert([
                'numero' => $numero,
            ]);
        }
        //color
        $colores = [
            ['nombre' => 'Rojo', 'codigo_color' => '#FF0000'],
            ['nombre' => 'Verde', 'codigo_color' => '#00FF00'],
            ['nombre' => 'Azul', 'codigo_color' => '#0000FF'],
            ['nombre' => 'Amarillo', 'codigo_color' => '#FFFF00'],
            ['nombre' => 'Cian', 'codigo_color' => '#00FFFF'],
            ['nombre' => 'Magenta', 'codigo_color' => '#FF00FF'],
            ['nombre' => 'Negro', 'codigo_color' => '#000000'],
            ['nombre' => 'Blanco', 'codigo_color' => '#FFFFFF'],
            ['nombre' => 'Gris', 'codigo_color' => '#808080'],
            ['nombre' => 'Naranja', 'codigo_color' => '#FFA500'],
            ['nombre' => 'Lima', 'codigo_color' => '#00FF00'],
            ['nombre' => 'Oliva', 'codigo_color' => '#808000'],
            ['nombre' => 'Rosa', 'codigo_color' => '#FFC0CB'],
            ['nombre' => 'Púrpura', 'codigo_color' => '#800080'],
            ['nombre' => 'Marrón', 'codigo_color' => '#A52A2A'],
            ['nombre' => 'Cenizo', 'codigo_color' => '#808080'],
        ];
        DB::table('color')->insert($colores);
        //marca
        $marcas = [
            'Nike',
            'Adidas',
            'Puma',
            'Reebok',
            'New Balance',
            'Vans',
            'Under Armour',
            'Skechers',
        ];
        foreach ($marcas as $nombre) {
            DB::table('marca')->insert([
                'nombre' => $nombre,
            ]);
        }
        //modelos
        $modelos = [
            ['nombre' => 'Air Max', 'marca' => 'Nike'],
            ['nombre' => 'Air Force 1', 'marca' => 'Nike'],
            ['nombre' => 'SB Dunk', 'marca' => 'Nike'],
            ['nombre' => 'Superstar', 'marca' => 'Adidas'],
            ['nombre' => 'Gazelle', 'marca' => 'Adidas'],
            ['nombre' => 'Campus', 'marca' => 'Adidas'],
            ['nombre' => 'Roma', 'marca' => 'Puma'],
            ['nombre' => 'Suede', 'marca' => 'Puma'],
            ['nombre' => 'Clyde', 'marca' => 'Puma'],
            ['nombre' => 'Nano', 'marca' => 'Reebok'],
            ['nombre' => 'Legacy', 'marca' => 'Reebok'],
            ['nombre' => 'Classic Leather', 'marca' => 'Reebok'],
            ['nombre' => 'Fresh Foam', 'marca' => 'New Balance'],
            ['nombre' => '997', 'marca' => 'New Balance'],
            ['nombre' => '1500', 'marca' => 'New Balance'],
            ['nombre' => 'Authentic', 'marca' => 'Vans'],
            ['nombre' => 'Old Skool', 'marca' => 'Vans'],
            ['nombre' => 'Era', 'marca' => 'Vans'],
            ['nombre' => 'Project Rock', 'marca' => 'Under Armour'],
            ['nombre' => 'UA Spawn', 'marca' => 'Under Armour'],
            ['nombre' => 'Charged Bandit', 'marca' => 'Under Armour'],
            ['nombre' => 'Energy', 'marca' => 'Skechers'],
            ['nombre' => 'Memory Foam', 'marca' => 'Skechers'],
            ['nombre' => 'D\'Lites', 'marca' => 'Skechers'],
        ];

        // Insertar cada modelo en la tabla 'modelo'
        foreach ($modelos as $modelo) {
            // Obtener el 'cod' de la marca correspondiente
            $codMarca = DB::table('marca')->where('nombre', $modelo['marca'])->value('cod');

            if ($codMarca) {
                DB::table('modelo')->insert([
                    'nombre' => $modelo['nombre'],
                    'cod_marca' => $codMarca,
                ]);
            }
        }
        //material
        $materiales = [
            ['cod' => 111, 'nombre' => 'Cuero'],
            ['cod' => 222, 'nombre' => 'Cuero Sintetico'],
            ['cod' => 444, 'nombre' => 'Poliester'],
        ];

        // Insertar cada material en la tabla 'material'
        foreach ($materiales as $material) {
            DB::table('material')->insert($material);
        }
        //pais
        $paises = [
            ['cod' => 'P0Pu', 'nombre' => 'Perú', 'horma' => 'c'],
            ['cod' => 'P0Br', 'nombre' => 'Brasil', 'horma' => 'g'],
            ['cod' => 'P0Ch', 'nombre' => 'Chile', 'horma' => 'c'],
        ];

        // Insertar cada país en la tabla 'pais'
        foreach ($paises as $pais) {
            DB::table('pais')->insert($pais);
        }

        $lote_mercaderia = [
            ['cantidad_total_pares' => 120, 'impuestos' => 30, 'costo_compra' => 7692, 'fecha_compra' => '2024-01-21' , 'costo_logistica' => 600, 'cod_marca' => 1],
            ['cantidad_total_pares' => 120, 'impuestos' => 30, 'costo_compra' => 11064, 'fecha_compra' => '2024-03-13' , 'costo_logistica' => 700, 'cod_marca' => 5],
            ['cantidad_total_pares' => 60, 'impuestos' => 30, 'costo_compra' => 7735, 'fecha_compra' => '2024-04-01' , 'costo_logistica' => 400, 'cod_marca' => 2],
        ];
        
        foreach ($lote_mercaderia as $inventario){
            DB::table('lote_mercaderia')->insert($inventario);
        }

        //compra prov
        $compraPrv = [
            ['cod_lote' => 1,'cod_pais' => 'P0Pu','NIT' => 6947187013,'nombre' => 'F. R. import'],
            ['cod_lote' => 2,'cod_pais' => 'P0Br','NIT' => 4985780017,'nombre' => 'JS_ABYSH'],
            ['cod_lote' => 3,'cod_pais' => 'P0Ch','NIT' => 3455323187,'nombre' => 'CH - import']
        ];

        foreach ($compraPrv as $comPv){
            DB::table('compra_prov')->insert($comPv);
        }

        //calzado
        $calzados = [
            ['genero' => 'm','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 3,'cod_talla' =>16,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 3,'cod_talla' =>17,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 3,'cod_talla' =>18,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 3,'cod_talla' =>19,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 3,'cod_talla' =>20,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 3,'cod_talla' =>21,'cod_material' =>222],
            ['genero' => 'f','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 3,'cod_talla' =>16,'cod_material' =>222],
            ['genero' => 'f','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 3,'cod_talla' =>17,'cod_material' =>222],
            ['genero' => 'f','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 3,'cod_talla' =>18,'cod_material' =>222],
            ['genero' => 'f','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 3,'cod_talla' =>19,'cod_material' =>222],
            ['genero' => 'f','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 3,'cod_talla' =>20,'cod_material' =>222],
            ['genero' => 'f','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 3,'cod_talla' =>21,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>22,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>23,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>24,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>25,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>26,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>27,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>27,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>22,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>23,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>24,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>25,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>26,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 1,'cod_talla' =>27,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 200 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 13,'cod_talla' =>21,'cod_material' =>444],
            ['genero' => 'm','precio_venta' => 200 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 13,'cod_talla' =>22,'cod_material' =>444],
            ['genero' => 'm','precio_venta' => 200 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 13,'cod_talla' =>23,'cod_material' =>444],
            ['genero' => 'm','precio_venta' => 200 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 13,'cod_talla' =>24,'cod_material' =>444],
            ['genero' => 'm','precio_venta' => 200 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 13,'cod_talla' =>25,'cod_material' =>444],
            ['genero' => 'm','precio_venta' => 200 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 13,'cod_talla' =>26,'cod_material' =>444],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 5,'cod_talla' =>15,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 5,'cod_talla' =>16,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 5,'cod_talla' =>17,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 5,'cod_talla' =>18,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 5,'cod_talla' =>19,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 5,'cod_talla' =>20,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 4,'cod_talla' =>15,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 4,'cod_talla' =>16,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 4,'cod_talla' =>17,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 4,'cod_talla' =>18,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 4,'cod_talla' =>19,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 4,'cod_talla' =>20,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 260 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 6,'cod_talla' =>21,'cod_material' =>444],
            ['genero' => 'u','precio_venta' => 260 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 6,'cod_talla' =>22,'cod_material' =>444],
            ['genero' => 'u','precio_venta' => 260 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 6,'cod_talla' =>23,'cod_material' =>444],
            ['genero' => 'u','precio_venta' => 260 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 6,'cod_talla' =>24,'cod_material' =>444],
            ['genero' => 'u','precio_venta' => 260 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 6,'cod_talla' =>25,'cod_material' =>444],
            ['genero' => 'u','precio_venta' => 260 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => null,'cod_modelo' => 6,'cod_talla' =>26,'cod_material' =>444],
        ];

        foreach ($calzados as $calzado){
            DB::table('calzado')->insert($calzado);
        }

        //registro_lote
        $registro_lote = [
            ['cod_calzado' => 1,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 2,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 3,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 4,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 5,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 6,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 7,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 8,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 9,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 10,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 11,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 12,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 13,'cod_lote' => 1,'cantidad' => 8,'costo_unitario' => 0],
            ['cod_calzado' => 14,'cod_lote' => 1,'cantidad' => 8,'costo_unitario' => 0],
            ['cod_calzado' => 15,'cod_lote' => 1,'cantidad' => 8,'costo_unitario' => 0],
            ['cod_calzado' => 16,'cod_lote' => 1,'cantidad' => 8,'costo_unitario' => 0],
            ['cod_calzado' => 17,'cod_lote' => 1,'cantidad' => 8,'costo_unitario' => 0],
            ['cod_calzado' => 18,'cod_lote' => 1,'cantidad' => 8,'costo_unitario' => 0],
            ['cod_calzado' => 19,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 20,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 21,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 22,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 23,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 24,'cod_lote' => 1,'cantidad' => 4,'costo_unitario' => 0],
            ['cod_calzado' => 25,'cod_lote' => 2,'cantidad' => 20,'costo_unitario' => 0],
            ['cod_calzado' => 26,'cod_lote' => 2,'cantidad' => 20,'costo_unitario' => 0],
            ['cod_calzado' => 27,'cod_lote' => 2,'cantidad' => 20,'costo_unitario' => 0],
            ['cod_calzado' => 28,'cod_lote' => 2,'cantidad' => 20,'costo_unitario' => 0],
            ['cod_calzado' => 29,'cod_lote' => 2,'cantidad' => 20,'costo_unitario' => 0],
            ['cod_calzado' => 30,'cod_lote' => 2,'cantidad' => 20,'costo_unitario' => 0],
            ['cod_calzado' => 31,'cod_lote' => 3,'cantidad' => 2,'costo_unitario' => 0],
            ['cod_calzado' => 32,'cod_lote' => 3,'cantidad' => 2,'costo_unitario' => 0],
            ['cod_calzado' => 33,'cod_lote' => 3,'cantidad' => 2,'costo_unitario' => 0],
            ['cod_calzado' => 34,'cod_lote' => 3,'cantidad' => 2,'costo_unitario' => 0],
            ['cod_calzado' => 35,'cod_lote' => 3,'cantidad' => 2,'costo_unitario' => 0],
            ['cod_calzado' => 36,'cod_lote' => 3,'cantidad' => 2,'costo_unitario' => 0],
            ['cod_calzado' => 37,'cod_lote' => 3,'cantidad' => 2,'costo_unitario' => 0],
            ['cod_calzado' => 38,'cod_lote' => 3,'cantidad' => 2,'costo_unitario' => 0],
            ['cod_calzado' => 39,'cod_lote' => 3,'cantidad' => 2,'costo_unitario' => 0],
            ['cod_calzado' => 40,'cod_lote' => 3,'cantidad' => 2,'costo_unitario' => 0],
            ['cod_calzado' => 41,'cod_lote' => 3,'cantidad' => 2,'costo_unitario' => 0],
            ['cod_calzado' => 42,'cod_lote' => 3,'cantidad' => 2,'costo_unitario' => 0],
            ['cod_calzado' => 43,'cod_lote' => 3,'cantidad' => 6,'costo_unitario' => 0],
            ['cod_calzado' => 44,'cod_lote' => 3,'cantidad' => 6,'costo_unitario' => 0],
            ['cod_calzado' => 45,'cod_lote' => 3,'cantidad' => 6,'costo_unitario' => 0],
            ['cod_calzado' => 46,'cod_lote' => 3,'cantidad' => 6,'costo_unitario' => 0],
            ['cod_calzado' => 47,'cod_lote' => 3,'cantidad' => 6,'costo_unitario' => 0],
            ['cod_calzado' => 48,'cod_lote' => 3,'cantidad' => 6,'costo_unitario' => 0],
        ];

        foreach ($registro_lote as $registro){
            DB::table('registro_lote')->insert($registro);
        }

    }
}
