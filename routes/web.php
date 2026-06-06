<?php

use App\Modules\Autenticacion\Controllers\LoginController;
use App\Http\Controllers\DepartamentoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('permission:dashboard.ver');

/*
    AUTENTICACIÓN
*/

Route::get('/login', [LoginController::class, 'show'])->name('login');

Route::post('/login', [LoginController::class, 'store'])->name('login.store');

/*
    DEPARTAMENTOS
*/

Route::get('/departamentos', [DepartamentoController::class, 'index'])
    ->name('departamentos.index');

Route::post('/departamentos', [DepartamentoController::class, 'store'])
    ->name('departamentos.store');