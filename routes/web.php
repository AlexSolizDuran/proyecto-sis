<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalzadoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\VistaController;

Auth::routes();
//inicio para todos
Route::get('/', function(){
    return view('welcome');
})->name('welcome');



//inicio para el admin
Route::get('/admin',function(){
    return view ('admin.inicio');
})->name('admin.inicio')->middleware('auth');;

// lista de calzados
Route::get('/calzados', [VistaController::class, 'index'])->name('cliente.index');

//gestionar calzados
Route::resource('calzado',CalzadoController::class)->names('admin.calzado');
//gestionar lote
Route::resource('compra',CompraController::class)->names('admin.compra');
//gestionar cliente
Route::resource('cliente',ClienteController::class)->names('admin.cliente');
//gestionar venta
Route::resource('venta',VentaController::class)->names('admin.venta');

//realizacion de venta
Route::post('venta/buscar-cliente', [VentaController::class, 'buscarCliente'])->name('admin.venta.buscarCliente');
Route::post('venta/agregar-calzado', [VentaController::class, 'addCalzado'])->name('admin.venta.addCalzado');
Route::post('venta/cancelar-carrito', [VentaController::class, 'cancelarCarrito'])->name('admin.venta.cancelar');
Route::get('/admin/venta/filtrar', [VentaController::class, 'filtrar'])->name('admin.venta.filtrar');
//realizacion de lote
Route::post('compra/lote',[CompraController::class,'lote'])->name('admin.compra.lote');
Route::post('compra/addlote',[CompraController::class, 'addlote'])->name('admin.compra.addlote');
Route::post('compra/cancelar',[CompraController::class, 'cancelar'])->name('admin.compra.cancelar');
Route::get('/admin/compra/filtrar',[CompraController::class,'filtrar'])->name('admin.compra.filtrar');