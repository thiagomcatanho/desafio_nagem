<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContatoController;

use Illuminate\Support\Facades\Route;

Route::get('/', [ClienteController::class, 'index'])->name('home');
Route::get('/clientes/search', [ClienteController::class, 'search'])->name('clientes.search');


Route::resource('/clientes', ClienteController::class)->except(['show']);
Route::resource('/contatos', ContatoController::class)->except(['show']);