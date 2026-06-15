<?php

use App\Modules\FrecuenciaPagos\Controllers\FrecuenciaPagoController;
use App\Modules\RolesPermisos\Enums\Permisos;
use Illuminate\Support\Facades\Route;

Route::prefix('contratos/frecuencias-pago')
    ->name('frecuencias-pago.')
    ->controller(FrecuenciaPagoController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index')
            ->name('index')
            ->middleware('permisos:' . Permisos::CONTRATOS_VER);

        Route::get('/create', 'create')
            ->name('create')
            ->middleware('permisos:' . Permisos::CONTRATOS_CREAR);

        Route::post('/', 'store')
            ->name('store')
            ->middleware('permisos:' . Permisos::CONTRATOS_CREAR);

        Route::get('/{id}/edit', 'edit')
            ->name('edit')
            ->middleware('permisos:' . Permisos::CONTRATOS_EDITAR);

        Route::put('/{id}', 'update')
            ->name('update')
            ->middleware('permisos:' . Permisos::CONTRATOS_EDITAR);

        Route::patch('/{id}/activar', 'activar')
            ->name('activar')
            ->middleware('permisos:' . Permisos::CONTRATOS_ELIMINAR);

        Route::patch('/{id}/desactivar', 'desactivar')
            ->name('desactivar')
            ->middleware('permisos:' . Permisos::CONTRATOS_ELIMINAR);
    });
