<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function inicio(){
        return view('admin.reportes.inicio');
    }

    public function ventafecha(Request $request){
        $fechaInicio = $request->fecha_inicio1;
        $fechaFin = $request->fecha_fin1;
        
        // Ejecutar la consulta para obtener los resultados de ventas
        $resultados = DB::select('CALL CantidadVendidaEntreFechas(?, ?)', [$fechaInicio, $fechaFin]);
    
        // Calcular las sumas de los precios y descuentos
        $totalPrecio = array_sum(array_map(function($venta) {
            return $venta->precio_venta * $venta->cantidad;
        }, $resultados));
        
        $totalDescuento = array_sum(array_map(function($venta) {
            return $venta->descuento * $venta->cantidad;
        }, $resultados));
    
        // Pasar los resultados y los totales a la vista
        $pdf = Pdf::loadView('admin.reportes.pdf.ventafecha', [
            'resultados' => $resultados,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'totalPrecio' => $totalPrecio,
            'totalDescuento' => $totalDescuento,
        ]);
    
        // Devolver el PDF como flujo
        return $pdf->stream('reporte_ventas.pdf');
    }

    public function gananciafecha(Request $request){
        $fechaInicio = $request->fecha_inicio2;
        $fechaFin = $request->fecha_fin2;
        
        
        // Ejecutar la consulta para obtener los resultados de ventas
        $resultados = DB::select('CALL ReporteGananciaTotal(?, ?)', [$fechaInicio, $fechaFin]);
    
        // Calcular las sumas de los precios y descuentos
        $totalPrecio = array_sum(array_map(function($venta) {
            return $venta->precio_venta * $venta->cantidad;
        }, $resultados));
        
        $totalDescuento = array_sum(array_map(function($venta) {
            return $venta->descuento * $venta->cantidad;
        }, $resultados));
        
        $totalCostoPP = array_sum(array_map(function($venta) {
            return $venta->costoPP * $venta->cantidad;
        }, $resultados));
    
        // Pasar los resultados y los totales a la vista
        $pdf = Pdf::loadView('admin.reportes.pdf.gananciafecha', [
            'resultados' => $resultados,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'totalPrecio' => $totalPrecio,
            'totalDescuento' => $totalDescuento,
            'totalCostoPP' => $totalCostoPP,
        ]);
    
        // Devolver el PDF como flujo
        return $pdf->stream('reporte_ganancia.pdf');
    }
    public function marcafecha(Request $request){
        $fechaInicio = $request->fecha_inicio3;
        $fechaFin = $request->fecha_fin3;
    
        // Ejecutar la consulta para obtener los resultados de ventas
        $resultados = DB::select('CALL TierVendidoMarcaModeloEntreFechas(?, ?)', [$fechaInicio, $fechaFin]);
    
        $coleccion = collect($resultados);

        // Agrupar por marca y sumar las cantidades
        $agrupadosPorMarca = $coleccion->groupBy('marca')->map(function ($items, $marca) {
            return [
                'marca' => $marca,
                'total_cantidad' => $items->sum('cantidad'),
            ];
        })->values()->toArray(); // Convertir a array si es necesario
        // Pasar los resultados y los totales a la vista
        $pdf = Pdf::loadView('admin.reportes.pdf.marcafecha', [
            'resultados' => $resultados,
            'agrupadosPorMarca' => $agrupadosPorMarca, // Resultados agrupados y sumados
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,

        ]);
    
        // Devolver el PDF como flujo
        return $pdf->stream('reporte_marca.pdf');
    }

    public function colorfecha(Request $request){
        $fechaInicio = $request->fecha_inicio4;
        $fechaFin = $request->fecha_fin4;
        
        
        // Ejecutar la consulta para obtener los resultados de ventas
        $resultados = DB::select('CALL CantidadColorVendidoEntre(?, ?)', [$fechaInicio, $fechaFin]);
    
    
        // Pasar los resultados y los totales a la vista
        $pdf = Pdf::loadView('admin.reportes.pdf.colorfecha', [
            'resultados' => $resultados,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,

        ]);
    
        // Devolver el PDF como flujo
        return $pdf->stream('reporte_color.pdf');
    }
    
    public function tallafecha(Request $request){
        $fechaInicio = $request->fecha_inicio5;
        $fechaFin = $request->fecha_fin5;
        
        
        // Ejecutar la consulta para obtener los resultados de ventas
        $resultados = DB::select('CALL CantidadtallasVendidoEntre(?, ?)', [$fechaInicio, $fechaFin]);
    
    
        // Pasar los resultados y los totales a la vista
        $pdf = Pdf::loadView('admin.reportes.pdf.tallafecha', [
            'resultados' => $resultados,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,

        ]);
    
        // Devolver el PDF como flujo
        return $pdf->stream('reporte_talla.pdf');
    }
    public function generovendido(Request $request){

        $edad = $request->edad;
        $tallaInicio = $request->tallaini;
        $tallaFin = $request->tallafin;

        $masculino = DB::select('CALL CantidadGeneroVendido(?, ?, ?)', ['m',$tallaInicio, $tallaFin]);
        $femenino = DB::select('CALL CantidadGeneroVendido(?, ?, ?)', ['f',$tallaInicio, $tallaFin]);
        $unisex = DB::select('CALL CantidadGeneroVendido(?, ?, ?)', ['u',$tallaInicio, $tallaFin]);

        $totalm = array_sum(array_map(function($m) {
            return $m->cantidad;
        }, $masculino));
        $totalf = array_sum(array_map(function($m) {
            return $m->cantidad;
        }, $femenino));
        $totalu = array_sum(array_map(function($m) {
            return $m->cantidad;
        }, $unisex));
    
        $pdf = Pdf::loadView('admin.reportes.pdf.generovendido', [
            'masculino' => $masculino,
            'femenino' => $femenino,
            'unisex' => $unisex,
            'totalm' => $totalm, 
            'totalf' => $totalf,
            'totalu' => $totalu,
            'edad' => $edad,
        ]);
    
        // Devolver el PDF como flujo
        return $pdf->stream('reporte_talla.pdf');
    }

    public function invertidofecha(Request $request){
        $fechaInicio = $request->fecha_inicio7;
        $fechaFin = $request->fecha_fin7;
        
        // Ejecutar la consulta para obtener los resultados invertidos
        $resultados = DB::select('CALL TotalInvercion(?, ?)', [$fechaInicio, $fechaFin]);
    
        // Calcular las sumas de los precios y descuentos
        $totalinvertido = array_sum(array_map(function($compra) {
            return $compra->costoPP * $compra->cantidad;
        }, $resultados));
        
        
    
        // Pasar los resultados y los totales a la vista
        $pdf = Pdf::loadView('admin.reportes.pdf.invertidofecha', [
            'resultados' => $resultados,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'totalinvertido' => $totalinvertido,
        ]);
    
        // Devolver el PDF como flujo
        return $pdf->stream('reporte_invertido.pdf');
    }
}
