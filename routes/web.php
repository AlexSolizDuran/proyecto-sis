<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalzadoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;

use App\Http\Controllers\VistaController;

Auth::routes();
//inicio para todos
Route::get('/', function(){
    return view('welcome');
})->name('welcome');
Route::get('/welcome', function(){
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



Route::post('/ventas/finalizar', [VentaController::class, 'finalizar'])->name('admin.venta.finalizar');
Route::get('/crear-lote', [CompraController::class, 'showForm'])->name('lote.create');

Route::post('/ventas/buscar-cliente', [VentaController::class, 'buscarCliente'])->name('admin.venta.buscarCliente');
Route::post('venta/agregar-calzado', [VentaController::class, 'addCalzado'])->name('admin.venta.addCalzado');
Route::post('/cancelar-carrito', [VentaController::class, 'cancelarCarrito'])->name('admin.venta.cancelar');
Route::get('/filtrar',[VentaController::class,'filtrar'])->name('admin.venta.filtrar');