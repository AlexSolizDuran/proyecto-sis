<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nota_venta = [
            [ 'fecha'=> '2024-05-15','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 56789012,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-05-15','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 12345678,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-05-15','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 34567890,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-05-17','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 24876543,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-05-17','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 50219876,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-05-17','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 60987654,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-05-19','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 83123456,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-05-19','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 98765432,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-05-19','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 50219876,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-06-01','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 12345685,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-06-01','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 23456744,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-06-01','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 34567833,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-06-02','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 45678495,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-06-02','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 56789054,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-06-02','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 67859015,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-06-03','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 78940129,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-06-03','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 89201231,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-06-03','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 90122343,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-06-04','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 10236456,'cod_admin'=> 'ad-1'],
            [ 'fecha'=> '2024-07-01','monto_total' => 0, 'cantidad' => 0,'estado' => 0,'ci_cliente' => 97794614,'cod_admin'=> 'ad-1'],           
        ];

        foreach ($nota_venta as $nota){
            DB::table('nota_venta')->insert($nota);
        }
        
        
        $registro_venta = [
            ['precio_venta' => 150, 'cod_calzado' => 40, 'nro_venta' => 1, 'cantidad' => 1],
            ['precio_venta' => 120, 'cod_calzado' => 12, 'nro_venta' => 1, 'cantidad' => 1],
            ['precio_venta' => 135, 'cod_calzado' => 1, 'nro_venta' => 1, 'cantidad' => 1],
            ['precio_venta' => 140, 'cod_calzado' => 20, 'nro_venta' => 2, 'cantidad' => 1],
            ['precio_venta' => 150, 'cod_calzado' => 43, 'nro_venta' => 3, 'cantidad' => 1],
            ['precio_venta' => 120, 'cod_calzado' => 34, 'nro_venta' => 3, 'cantidad' => 1],
            ['precio_venta' => 160, 'cod_calzado' => 35, 'nro_venta' => 4, 'cantidad' => 1],
            ['precio_venta' => 130, 'cod_calzado' => 1, 'nro_venta' => 5, 'cantidad' => 1],
            ['precio_venta' => 140, 'cod_calzado' => 2, 'nro_venta' => 6, 'cantidad' => 1],
            ['precio_venta' => 135, 'cod_calzado' => 15, 'nro_venta' => 6, 'cantidad' => 1],
            ['precio_venta' => 150, 'cod_calzado' => 23, 'nro_venta' => 6, 'cantidad' => 1],
            ['precio_venta' => 160, 'cod_calzado' => 34, 'nro_venta' => 7, 'cantidad' => 1],
            ['precio_venta' => 155, 'cod_calzado' => 48, 'nro_venta' => 8, 'cantidad' => 1],
            ['precio_venta' => 160, 'cod_calzado' => 48, 'nro_venta' => 9, 'cantidad' => 1],
            ['precio_venta' => 150, 'cod_calzado' => 10, 'nro_venta' => 10, 'cantidad' => 1],
            ['precio_venta' => 121, 'cod_calzado' => 21, 'nro_venta' => 10, 'cantidad' => 1],
            ['precio_venta' => 135, 'cod_calzado' => 32, 'nro_venta' => 10, 'cantidad' => 1],
            ['precio_venta' => 140, 'cod_calzado' => 13, 'nro_venta' => 11, 'cantidad' => 1],
            ['precio_venta' => 150, 'cod_calzado' => 44, 'nro_venta' => 11, 'cantidad' => 1],
            ['precio_venta' => 120, 'cod_calzado' => 45, 'nro_venta' => 11, 'cantidad' => 1],
            ['precio_venta' => 135, 'cod_calzado' => 16, 'nro_venta' => 12, 'cantidad' => 1],
            ['precio_venta' => 140, 'cod_calzado' => 17, 'nro_venta' => 12, 'cantidad' => 1],
            ['precio_venta' => 150, 'cod_calzado' => 18, 'nro_venta' => 12, 'cantidad' => 1],
            ['precio_venta' => 160, 'cod_calzado' => 21, 'nro_venta' => 13, 'cantidad' => 1],
            ['precio_venta' => 155, 'cod_calzado' => 20, 'nro_venta' => 13, 'cantidad' => 1],
            ['precio_venta' => 160, 'cod_calzado' => 21, 'nro_venta' => 13, 'cantidad' => 1],
            ['precio_venta' => 150, 'cod_calzado' => 22, 'nro_venta' => 14, 'cantidad' => 1],
            ['precio_venta' => 120, 'cod_calzado' => 33, 'nro_venta' => 14, 'cantidad' => 1],
            ['precio_venta' => 135, 'cod_calzado' => 24, 'nro_venta' => 14, 'cantidad' => 1],
            ['precio_venta' => 140, 'cod_calzado' => 45, 'nro_venta' => 15, 'cantidad' => 1],
            ['precio_venta' => 150, 'cod_calzado' => 26, 'nro_venta' => 15, 'cantidad' => 1],
            ['precio_venta' => 120, 'cod_calzado' => 37, 'nro_venta' => 15, 'cantidad' => 1],
            ['precio_venta' => 135, 'cod_calzado' => 28, 'nro_venta' => 16, 'cantidad' => 1],
            ['precio_venta' => 140, 'cod_calzado' => 39, 'nro_venta' => 16, 'cantidad' => 1],
            ['precio_venta' => 150, 'cod_calzado' => 30, 'nro_venta' => 16, 'cantidad' => 1],
            ['precio_venta' => 160, 'cod_calzado' => 11, 'nro_venta' => 17, 'cantidad' => 1],
            ['precio_venta' => 155, 'cod_calzado' => 32, 'nro_venta' => 17, 'cantidad' => 1],
            ['precio_venta' => 160, 'cod_calzado' => 23, 'nro_venta' => 17, 'cantidad' => 1],
            ['precio_venta' => 120, 'cod_calzado' => 35, 'nro_venta' => 18, 'cantidad' => 1],
            ['precio_venta' => 135, 'cod_calzado' => 36, 'nro_venta' => 18, 'cantidad' => 1],
            ['precio_venta' => 140, 'cod_calzado' => 17, 'nro_venta' => 19, 'cantidad' => 1],
            ['precio_venta' => 150, 'cod_calzado' => 38, 'nro_venta' => 19, 'cantidad' => 1],
            ['precio_venta' => 120, 'cod_calzado' => 19, 'nro_venta' => 19, 'cantidad' => 1],
            ['precio_venta' => 135, 'cod_calzado' => 20, 'nro_venta' => 20, 'cantidad' => 1],
        ];
        
        
        
        
        foreach ($registro_venta as $reg_venta){
            DB::table('registro_venta')->insert($reg_venta);
        }

    }
}
