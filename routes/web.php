<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalzadoController;
use App\Http\Controllers\LoteMercaderiaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;

//inicio para todos
Route::get('/', function(){
    return view('welcome');
})->name('welcome');
//inicio para el admin
Route::get('/admin',function(){
    return view ('admin.inicio');
})->name('admin.inicio');

// lista de calzados
Route::get('/calzados', [CalzadoController::class, 'lista'])->name('cliente.index');

//gestionar calzados
Route::resource('calzado',CalzadoController::class)->names('admin.calzado');

//gestionar lote
Route::get('/lote_mercaderia/create', [LoteMercaderiaController::class, 'create'])->name('admin.lote_mercaderia.create');
Route::post('/lote_mercaderia', [LoteMercaderiaController::class, 'store'])->name('lote_mercaderia.store');

//gestionar cliente
Route::resource('cliente',ClienteController::class)->names('admin.cliente');
//gestionar venta
Route::resource('venta',VentaController::class)->names('admin.venta');