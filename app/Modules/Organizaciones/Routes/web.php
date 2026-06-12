<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Organizaciones\Controllers\OrganizacionController;
use App\Modules\RolesPermisos\Enums\Permisos;

Route::prefix('organizacion')
    ->middleware(['auth'])
    ->name('organizacion.')
    ->group(function () {

        Route::get('/', [OrganizacionController::class, 'show'])
            ->middleware('permisos:' . Permisos::ORGANIZACION_VER)
            ->name('show');

        Route::get('/create', [OrganizacionController::class, 'create'])
            ->middleware('permisos:' . Permisos::ORGANIZACION_CREAR)
            ->name('create');

        Route::post('/', [OrganizacionController::class, 'store'])
            ->middleware('permisos:' . Permisos::ORGANIZACION_CREAR)
            ->name('store');

        Route::get('/edit', [OrganizacionController::class, 'edit'])
            ->middleware('permisos:' . Permisos::ORGANIZACION_EDITAR)
            ->name('edit');

        Route::put('/', [OrganizacionController::class, 'update'])
            ->middleware('permisos:' . Permisos::ORGANIZACION_EDITAR)
            ->name('update');

        Route::delete('/', [OrganizacionController::class, 'destroy'])
            ->middleware('permisos:' . Permisos::ORGANIZACION_ELIMINAR)
            ->name('destroy');
    });