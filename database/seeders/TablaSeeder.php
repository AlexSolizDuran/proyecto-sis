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
            ['genero' => 'm','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/ccGCLD18BlURkC6YxywXM94jOddW2WGxvUaM6dxR.jpg','cod_modelo' => 3,'cod_talla' =>16,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/vVbBP2HvRZVGNpdRZuVm0KNebIXwUbds0ckgdZ9u.jpg','cod_modelo' => 3,'cod_talla' =>17,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/BHhtcTuL62kc9BYg9U9Fe6je1dMsk2bSZPGFTcnW.jpg','cod_modelo' => 3,'cod_talla' =>18,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/18HFFwAQuBDpjqmP5L59WxORPp5BsF0Bhv04mgVd.jpg','cod_modelo' => 3,'cod_talla' =>19,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/vhtahAe55fcgbsLIjH6Nb3u6CgvnKoJWJnzYLVM2.jpg','cod_modelo' => 3,'cod_talla' =>20,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/7qN4ba1ge2Q19tW0XE2DNpzxPyNY6CTeFrezNqma.jpg','cod_modelo' => 3,'cod_talla' =>21,'cod_material' =>222],

            ['genero' => 'f','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/9BW3dJwYg6lNdjoDFWMFquUL4eTeK5nHxNmzIfht.jpg','cod_modelo' => 3,'cod_talla' =>16,'cod_material' =>222],
            ['genero' => 'f','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/PkBk87a13nxkv75FM9OFvVVD18klYwm80CmlgyxJ.jpg','cod_modelo' => 3,'cod_talla' =>17,'cod_material' =>222],
            ['genero' => 'f','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/xBZJkkipIMiekATQK4MleF0O3kFj55OSN0ssayhh.jpg','cod_modelo' => 3,'cod_talla' =>18,'cod_material' =>222],
            ['genero' => 'f','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/zOYMM8tagvzvPaIvglcgRxdfQHHsIflbFhuIvggV.jpg','cod_modelo' => 3,'cod_talla' =>19,'cod_material' =>222],
            ['genero' => 'f','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/ynrFytXCGWzZqGD4BYAPMBpJDtfBobINOkDG7LI6.jpg','cod_modelo' => 3,'cod_talla' =>20,'cod_material' =>222],
            ['genero' => 'f','precio_venta' => 150 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/zGQgtaPp79vaUb5FHL6YLd33Cxz86ShO1s73yxX2.jpg','cod_modelo' => 3,'cod_talla' =>21,'cod_material' =>222],

            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/a0kGyKs8q0iyvbp4mOyYHaFLqB2mGYhJnEZccMKL.jpg','cod_modelo' => 1,'cod_talla' =>22,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/bZQvy4lzIKznUtkoJqxWgWPy94Fr3vPbe80S4u44.jpg','cod_modelo' => 1,'cod_talla' =>23,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/OiiVEII9wkeJFrm34d0RnDHD0h9XElrHdMGGzN9H.jpg','cod_modelo' => 1,'cod_talla' =>24,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/G7NKa4jMj5COCfbp3TdV7o6oyIaAAHlKDfzhzg3X.jpg','cod_modelo' => 1,'cod_talla' =>25,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/O6K8QU40jsNEIlugVtWX7f0XjY6GN7ZReNRqjYOo.jpg','cod_modelo' => 1,'cod_talla' =>26,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/yyfc4DOzgqKq4vcEjeydD2gpBIDI3lfmW8FxUAfE.jpg','cod_modelo' => 1,'cod_talla' =>27,'cod_material' =>222],

            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/4cHtoeN9FeR9aYVKTtajM5ts3eXhEVXQR8cuXIgn.jpg','cod_modelo' => 1,'cod_talla' =>27,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/DzUIT4MbcRTponP8lDn36UHDFmxOoVIODv5LCK36.jpg','cod_modelo' => 1,'cod_talla' =>22,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/Zr2tu5zxVpWKNJvFENloEpLfk8nOLucIveNk8v2E.jpg','cod_modelo' => 1,'cod_talla' =>23,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/DTZPHxXyIM7a94uL6L1ycqy514CMFKu5CRBr65Ba.jpg','cod_modelo' => 1,'cod_talla' =>24,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/cbwhYDogJI89judQPow3DDzHtPSIoRHIrD3ezuyH.jpg','cod_modelo' => 1,'cod_talla' =>25,'cod_material' =>222],
            ['genero' => 'm','precio_venta' => 170 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/YkqKuZ0ddvIf04OgstDDdvdkzCRIiHGet9TG1ZbM.jpg','cod_modelo' => 1,'cod_talla' =>26,'cod_material' =>222],

            ['genero' => 'm','precio_venta' => 200 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/66QmTzG11MBgYg9JMLczRbu5j4MILwpiC1YBBEq1.jpg','cod_modelo' => 13,'cod_talla' =>21,'cod_material' =>444],
            ['genero' => 'm','precio_venta' => 200 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/45qeeLzQtzqKAXRatL5sZvfxbb29daYKUJV4ZNal.jpg','cod_modelo' => 13,'cod_talla' =>22,'cod_material' =>444],
            ['genero' => 'm','precio_venta' => 200 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/kYD3KtqVfxMGBreC2CmEIEDQiQ4IGx32a0i3fAvS.jpg','cod_modelo' => 13,'cod_talla' =>23,'cod_material' =>444],
            ['genero' => 'm','precio_venta' => 200 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/YccNdmUquPJb6ftoBWqffVD3axUvq0yekByGKd3H.jpg','cod_modelo' => 13,'cod_talla' =>24,'cod_material' =>444],
            ['genero' => 'm','precio_venta' => 200 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/EtEf8Y6xkRpwtUmb6jXicpyAkHSBmo10XsD3ZnMY.jpg','cod_modelo' => 13,'cod_talla' =>25,'cod_material' =>444],
            ['genero' => 'm','precio_venta' => 200 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/xeprtMaruKs6Ts9gbzLzFtc8gDJtNk9gRnxr1cJn.jpg','cod_modelo' => 13,'cod_talla' =>26,'cod_material' =>444],

            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/t8FQcUeijfZhEWdw01zzXjkDJF7ECwucj2PK7vs8.jpg','cod_modelo' => 5,'cod_talla' =>15,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/KQvdLKvEtrZfwBcpZKP1RwFjns7AfskPrf2sHHZx.jpg','cod_modelo' => 5,'cod_talla' =>16,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/iyLPbPZ9495MzOvD4FOJiVJoLXK72FSHvjnaLT90.jpg','cod_modelo' => 5,'cod_talla' =>17,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/2klke6bDLBLdaiSLHLgxbDd4oCEBSBOOjltbZ290.jpg','cod_modelo' => 5,'cod_talla' =>18,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/utAznHrl3WP30fDPwMszu7nAPJOXLMpscICimI39.jpg','cod_modelo' => 5,'cod_talla' =>19,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/adcl1gxeBqudKDkxng8Q4I14Jp1YebCog81VdpF2.jpg','cod_modelo' => 5,'cod_talla' =>20,'cod_material' =>222],

            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/7LrrWOdBQV6bBLnp7hs79ubWznlFolitNCVggjUz.jpg','cod_modelo' => 4,'cod_talla' =>15,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/YZrFxBOBvmrfQk4a0jRIvW25qfCkqfwlSqSwTtZN.jpg','cod_modelo' => 4,'cod_talla' =>16,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/vQpKKFpGSt1v2NwfWUH4Wzdbv5FrnPOINKy3BWDl.jpg','cod_modelo' => 4,'cod_talla' =>17,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/C5oHj1zUiuPxXBEBxbg3UyLWGa0m1Kwq0BG4amX1.jpg','cod_modelo' => 4,'cod_talla' =>18,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/NIEhcDB1059K4G57ALsn9Tp0w78VRap99hLZ9qQj.jpg','cod_modelo' => 4,'cod_talla' =>19,'cod_material' =>222],
            ['genero' => 'u','precio_venta' => 250 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/AXyG6prQ47czLuD9jyLfDbivifFs1YomyqycldNx.jpg','cod_modelo' => 4,'cod_talla' =>20,'cod_material' =>222],

            ['genero' => 'u','precio_venta' => 260 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/DchAM8yGZAznrrpzTztYRopx1nuiVRT4yRzDybF5.jpg','cod_modelo' => 6,'cod_talla' =>21,'cod_material' =>444],
            ['genero' => 'u','precio_venta' => 260 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/DsiOossTxdveH9oila2LOesOntqpecncPKQ48fSU.jpg','cod_modelo' => 6,'cod_talla' =>22,'cod_material' =>444],
            ['genero' => 'u','precio_venta' => 260 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/Ko4S6YueQQ1NINFTM5zfICTlJmtkrOVtozyU1ONo.jpg','cod_modelo' => 6,'cod_talla' =>23,'cod_material' =>444],
            ['genero' => 'u','precio_venta' => 260 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/DpQz1jsyr43UVnwPDL7OmgaXWoWx1Spv54x6LIFC.jpg','cod_modelo' => 6,'cod_talla' =>24,'cod_material' =>444],
            ['genero' => 'u','precio_venta' => 260 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/HVhMhHaLP4kDI4yLAb1ij3ZNTWwD3htL8IG0fazo.jpg','cod_modelo' => 6,'cod_talla' =>25,'cod_material' =>444],
            ['genero' => 'u','precio_venta' => 260 ,'cantidad_pares' => 0,'costoPP' => 0,'imagen' => 'images/calzados/8Mfz27PPOXopAfvmDQ4YSiEr2Sn4NrTEKQlPz10I.jpg','cod_modelo' => 6,'cod_talla' =>26,'cod_material' =>444],
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
