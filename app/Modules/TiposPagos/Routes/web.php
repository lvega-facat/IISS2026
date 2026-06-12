<?php

use App\Modules\TiposPagos\Controllers\TiposPagoController;
use Illuminate\Support\Facades\Route;
use App\Modules\RolesPermisos\Enums\Permisos;

Route::prefix('tipos-pago')
    ->name('tipos-pago.')
    ->controller(TiposPagoController::class)
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
