<?php

use App\Modules\Justificativos\Controllers\JustificativosController;
use Illuminate\Support\Facades\Route;
use App\Modules\RolesPermisos\Enums\Permisos;

Route::prefix('justificativos')
    ->name('justificativos.')
    ->group(function () {

        Route::get('/', [
            JustificativoController::class,
            'index'
        ])->name('index')->middleware('permisos:'. Permisos::JUSTIFICATIVOS_VER);

        Route::get('/create', [
            JustificativoController::class,
            'create'
        ])->name('create')->middleware('permisos:'. Permisos::JUSTIFICATIVOS_CREAR);

        Route::post('/', [
            JustificativoController::class,
            'store'
        ])->name('store')->middleware('permisos:'. Permisos::JUSTIFICATIVOS_CREAR);

        Route::put('/{id}', [
            JustificativoController::class,
            'update'
        ])->name('update')->middleware('permisos:'. Permisos::JUSTIFICATIVOS_EDITAR);

        Route::post('/{id}/aprobar', [
            JustificativoController::class,
            'aprobar'
        ])->name('aprobar')->middleware('permisos:'. Permisos::JUSTIFICATIVOS_APROBAR);

        Route::post('/{id}/rechazar', [
            JustificativoController::class,
            'rechazar'
        ])->name('rechazar')->middleware('permisos:'. Permisos::JUSTIFICATIVOS_APROBAR);
    });