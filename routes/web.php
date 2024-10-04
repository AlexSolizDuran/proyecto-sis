<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalzadoController;
Route::get('/', function(){
    return view('welcome');
})->name('welcome');

Route::get('/calzados', [CalzadoController::class, 'index'])->name('cliente.index');

Route::get('/create',[CalzadoController::class, 'create'])->name('admin.calzados.create');