<?php

use App\Modules\Autenticacion\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Modules\Profesiones\Controllers\ProfesionesController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::prefix('profesiones')->group(function () {
    Route::get('/', [ProfesionesController::class, 'index'])->name('profesiones.index');
    Route::get('/crear', [ProfesionesController::class, 'create'])->name('profesiones.create');
    Route::post('/', [ProfesionesController::class, 'store'])->name('profesiones.store');
    Route::get('/{id}', [ProfesionesController::class, 'show'])->name('profesiones.show');
    Route::get('/{id}/editar', [ProfesionesController::class, 'edit'])->name('profesiones.edit');
    Route::put('/{id}', [ProfesionesController::class, 'update'])->name('profesiones.update');
    Route::patch('/{id}/desactivar', [ProfesionesController::class, 'destroy'])->name('profesiones.destroy');
});

