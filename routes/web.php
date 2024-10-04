<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalzadoController;

Route::get('/calzados', [CalzadoController::class, 'index'])->name('index');

