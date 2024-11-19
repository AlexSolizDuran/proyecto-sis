<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Inventario\CalzadoController;
use App\Http\Controllers\Admin\Compra\CompraController;
use App\Http\Controllers\Admin\Cliente\ClienteController;
use App\Http\Controllers\Admin\Venta\VentaController;
use App\Http\Controllers\Admin\BitacoraController;

use App\Http\Controllers\Admin\Categoria\ColorController;
use App\Http\Controllers\Admin\Categoria\MarcaController;
use App\Http\Controllers\Admin\Categoria\MaterialController;
use App\Http\Controllers\Admin\Categoria\TallaController;
use App\Http\Controllers\Admin\Categoria\ModeloController;
use App\Http\Controllers\Admin\Compra\PaisController;

use App\Http\Controllers\Admin\Venta\CarritoController;
use App\Http\Controllers\CuentaController;

use App\Http\Controllers\PayPalController;

use Illuminate\Support\Facades\Auth;

Auth::routes();
//inicio para todos
Route::get('/', [CarritoController::class, 'inicio'])->name('inicio');


//inicio para el admin
Route::get('/admin',function(){
    return view ('admin.inicio');
})->middleware('can:admin.inicio')->name('admin.inicio');

// vista de clientes
Route::post('zapato/añadir-zapato', [CarritoController::class, 'añadir'])->name('cliente.zapato.add');
Route::delete('zapato/quitar-zapato/{calzadoCod}', [CarritoController::class, 'quitar'])->name('cliente.zapato.quitar');
Route::get('zapato/pedido',[CarritoController::class,'pedido'])->name('zapato.pedido');

Route::post('zapato/cancelar', [CarritoController::class, 'cancelar'])->name('cliente.zapato.cancelar');

Route::resource('zapato',CarritoController::class)->names('cliente.zapato');

Route::resource('cuenta',CuentaController::class)->names('cliente.cuenta');


//bitacora
Route::resource('bitacora',BitacoraController::class)->only(['index','destroy'])->names('admin.bitacora');
//gestionar calzados
Route::resource('calzado',CalzadoController::class)->names('admin.calzado');
//gestionar lote
Route::resource('compra',CompraController::class)->names('admin.compra');
//gestionar cliente
Route::resource('cliente',ClienteController::class)->names('admin.cliente');
//gestionar venta
Route::resource('venta',VentaController::class)->names('admin.venta');

Route::get('venta/sin-cancelar/{nro}', [VentaController::class, 'pagado'])->name('venta.sinCancelar');


//realizacion de venta
Route::post('venta/buscar-cliente', [VentaController::class, 'buscarCliente'])->name('admin.venta.buscarCliente');
Route::post('venta/agregar-calzado', [VentaController::class, 'addCalzado'])->name('admin.venta.addCalzado');
Route::delete('venta/quitar-calzado/{calzadoCod}', [VentaController::class, 'delCalzado'])->name('admin.venta.delCalzado');
Route::post('venta/cancelar-carrito', [VentaController::class, 'cancelarCarrito'])->name('admin.venta.cancelar');
Route::get('/admin/venta/filtrar', [VentaController::class, 'filtrar'])->name('admin.venta.filtrar');
//realizacion de lote
Route::post('compra/lote',[CompraController::class,'lote'])->name('admin.compra.lote');
Route::post('compra/addlote',[CompraController::class, 'addlote'])->name('admin.compra.addlote');
Route::post('compra/cancelar',[CompraController::class, 'cancelar'])->name('admin.compra.cancelar');
Route::get('/admin/compra/filtrar',[CompraController::class,'filtrar'])->name('admin.compra.filtrar');

Route::get('/api/modelos/{marca}', [ModeloController::class, 'obtenerModelos'])->name('api.modelos');

Route::resource('color',ColorController::class)->except(['create', 'edit', 'show'])->names('admin.color');
Route::resource('marca',MarcaController::class)->except(['create', 'edit', 'show'])->names('admin.marca');
Route::resource('material',MaterialController::class)->except(['create', 'edit', 'show'])->names('admin.material');
Route::resource('modelo',ModeloController::class)->except(['create', 'edit', 'show'])->names('admin.modelo');
Route::resource('talla',TallaController::class)->except(['create', 'edit', 'show'])->names('admin.talla');
Route::resource('pais',PaisController::class)->except(['create', 'edit', 'show'])->names('admin.pais');

Route::get('/change-password', [CuentaController::class, 'showChangePasswordForm'])->name('password.change.form');
Route::post('/change-password', [CuentaController::class, 'changePassword'])->name('password.change');

//paypal


Route::get('/pay-with-paypal', [PayPalController::class, 'payWithPayPal'])->name('paypal.pay');
Route::get('/paypal/success', [PayPalController::class, 'success'])->name('paypal.success');