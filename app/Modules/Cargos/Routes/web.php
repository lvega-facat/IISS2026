<?php

use App\Modules\Cargos\Controllers\CargosController;
use Illuminate\Support\Facades\Route;
use App\Modules\RolesPermisos\Enums\Permisos;

Route::prefix('cargos')
    ->name('cargos.')
    ->controller(CargosController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index')
            ->name('index')
            ->middleware('permisos:' . Permisos::CARGOS_VER);

        Route::get('/create', 'create')
            ->name('create')
            ->middleware('permisos:' . Permisos::CARGOS_CREAR);

        Route::post('/', 'store')
            ->name('store')
            ->middleware('permisos:' . Permisos::CARGOS_CREAR);

        Route::get('/{id}/edit', 'edit')
            ->name('edit')
            ->middleware('permisos:' . Permisos::CARGOS_EDITAR);

        Route::put('/{id}', 'update')
            ->name('update')
            ->middleware('permisos:' . Permisos::CARGOS_EDITAR);

        Route::patch('/{id}/activar', 'activar')
            ->name('activar')
            ->middleware('permisos:' . Permisos::CARGOS_ELIMINAR);

        Route::patch('/{id}/desactivar', 'desactivar')
            ->name('desactivar')
            ->middleware('permisos:' . Permisos::CARGOS_ELIMINAR);
    });

