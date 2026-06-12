<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Autenticacion\Controllers\LoginController;
use App\Modules\Departamentos\Controllers\DepartamentosController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::prefix('departamentos')->group(function () {

    Route::get('/', [DepartamentosController::class, 'index'])
        ->name('departamentos.index');

    Route::get('/create', [DepartamentosController::class, 'create'])
        ->name('departamentos.create');

    Route::post('/', [DepartamentosController::class, 'store'])
        ->name('departamentos.store');

    Route::get('/{id}/edit', [DepartamentosController::class, 'edit'])
        ->name('departamentos.edit');

    Route::put('/{id}', [DepartamentosController::class, 'update'])
        ->name('departamentos.update');

    Route::delete('/{id}', [DepartamentosController::class, 'destroy'])
        ->name('departamentos.destroy');
});