<?php

use App\Modules\Contratos\Controllers\ContratosController;
USE App\Modules\Contratos\Profesiones\Controllers\ProfesionesController;
USE App\Modules\Contratos\TiposContrato\Controllers\TiposContratoController;
USE App\Modules\Contratos\Horarios\Controllers\HorariosController;
use App\Modules\Contratos\TiposFrecuencias\Controllers\TiposFrecuenciasController;
use App\Modules\RolesPermisos\Enums\Permisos;
use Illuminate\Support\Facades\Route;

Route::prefix('contratos')->middleware(['auth'])->group(function () {
    Route::get('/', [ContratosController::class, 'index']);
    Route::get('/create', [ContratosController::class, 'create']);
    Route::get('/{id}/edit', [ContratosController::class, 'edit']);
});

//rutas para profesiones
Route::prefix('contratos/profesiones')->middleware(['auth'])->group(function () {
    Route::get('/', [ProfesionesController::class, 'index'])->name('profesiones.index')->middleware('permisos:' . Permisos::CONTRATOS_VER);
    Route::get('/crear', [ProfesionesController::class, 'create'])->name('profesiones.create')->middleware('permisos:' . Permisos::CONTRATOS_CREAR);
    Route::post('/', [ProfesionesController::class, 'store'])->name('profesiones.store')->middleware('permisos:' . Permisos::CONTRATOS_CREAR);
    Route::get('/{id}', [ProfesionesController::class, 'show'])->name('profesiones.show')->middleware('permisos:' . Permisos::CONTRATOS_VER);
    Route::get('/{id}/editar', [ProfesionesController::class, 'edit'])->name('profesiones.edit')->middleware('permisos:' . Permisos::CONTRATOS_EDITAR);
    Route::put('/{id}', [ProfesionesController::class, 'update'])->name('profesiones.update')->middleware('permisos:' . Permisos::CONTRATOS_EDITAR);
    Route::patch('/{id}/desactivar', [ProfesionesController::class, 'destroy'])->name('profesiones.destroy')->middleware('permisos:' . Permisos::CONTRATOS_ELIMINAR);
});



Route::prefix('contratos/tipos-contrato')->middleware(['auth'])->group(function () {
    Route::get('/', [TiposContratoController::class, 'index']);
    Route::get('/create', [TiposContratoController::class, 'create']);
    Route::get('/{id}/edit', [TiposContratoController::class, 'edit']);
});

Route::prefix('contratos/horarios')->middleware(['auth'])->group(function () {
    Route::get('/', [HorariosController::class, 'index']);
    Route::get('/create', [HorariosController::class, 'create']);
    Route::get('/{id}/edit', [HorariosController::class, 'edit']);
});

Route::prefix('contratos/tipos-frecuencias')->middleware(['auth'])->group(function () {
    Route::get('/', [TiposFrecuenciasController::class, 'index']);
    Route::get('/create', [TiposFrecuenciasController::class, 'create']);
    Route::get('/{id}/edit', [TiposFrecuenciasController::class, 'edit']);
});