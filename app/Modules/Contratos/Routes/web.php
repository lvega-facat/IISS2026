<?php

use App\Modules\Contratos\Controllers\ContratosController;
USE App\Modules\Contratos\Profesiones\Controllers\ProfesionesController;
USE App\Modules\Contratos\TiposContrato\Controllers\TiposContratoController;
USE App\Modules\Contratos\Horarios\Controllers\HorariosController;
use App\Modules\Contratos\TiposFrecuencias\Controllers\TiposFrecuenciasController;

use Illuminate\Support\Facades\Route;

Route::prefix('contratos')->middleware(['auth'])->group(function () {
    Route::get('/', [ContratosController::class, 'index']);
    Route::get('/create', [ContratosController::class, 'create']);
    Route::get('/{id}/edit', [ContratosController::class, 'edit']);
});

Route::prefix('contratos/profesiones')->middleware(['auth'])->group(function () {
    Route::get('/', [ProfesionesController::class, 'index']);
    Route::get('/create', [ProfesionesController::class, 'create']);
    Route::get('/{id}/edit', [ProfesionesController::class, 'edit']);
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