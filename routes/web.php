<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [CalculadoraController::class, 'showForm'])->name('form');
Route::post('/calcular', [CalculadoraController::class, 'calcular'])->name('calcular');
