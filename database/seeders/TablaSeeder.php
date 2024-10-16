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
    }
}
