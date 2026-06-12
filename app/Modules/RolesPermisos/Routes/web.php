<?php

use App\Modules\RolesPermisos\Enums\Permisos;
use App\Modules\RolesPermisos\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')->middleware(['auth'])->name('roles.')->group(function () {

    Route::get('/', [RoleController::class, 'index'])
        ->name('index')
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_VER);

    Route::get('/create', [RoleController::class, 'create'])
        ->name('create')
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_CREAR);

    Route::post('/', [RoleController::class, 'store'])
        ->name('store')
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_CREAR);

    Route::get('/{id}/edit', [RoleController::class, 'edit'])
        ->name('edit')
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_EDITAR);

    Route::put('/{id}', [RoleController::class, 'update'])
        ->name('update')
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_EDITAR);

    Route::delete('/{id}', [RoleController::class, 'destroy'])
        ->name('destroy')
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_ELIMINAR);

    Route::get('/{id}/permisos', [RoleController::class, 'gestionarPermisos'])
        ->name('permissions')
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_EDITAR);

    Route::post('/{id}/asignar-permisos', [RoleController::class, 'asignarPermisos'])
        ->name('asignarPermisos')
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_EDITAR);
});
