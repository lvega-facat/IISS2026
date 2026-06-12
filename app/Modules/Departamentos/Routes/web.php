<?php

use App\Modules\Departamentos\Controllers\DepartamentosController;
use Illuminate\Support\Facades\Route;
use App\Modules\RolesPermisos\Enums\Permisos;

Route::prefix('departamentos')->name('departamentos.')->controller(DepartamentosController::class)->middleware(['auth'])->group(function () {

    Route::get('/', 'index')
        ->name('index')
        ->middleware('permisos:' . Permisos::DEPARTAMENTOS_VER);

    Route::get('/create', 'create')
        ->name('create')
        ->middleware('permisos:' . Permisos::DEPARTAMENTOS_CREAR);

    Route::post('/', 'store')
        ->name('store')
        ->middleware('permisos:' . Permisos::DEPARTAMENTOS_CREAR);

    Route::get('/{id}/edit', 'edit')
        ->name('edit')
        ->middleware('permisos:' . Permisos::DEPARTAMENTOS_EDITAR);

    Route::put('/{id}', 'update')
        ->name('update')
        ->middleware('permisos:' . Permisos::DEPARTAMENTOS_EDITAR);

    Route::patch('/{id}/activar', 'activar')
        ->name('activar')
        ->middleware('permisos:' . Permisos::DEPARTAMENTOS_ELIMINAR);

    Route::patch('/{id}/desactivar', 'desactivar')
        ->name('desactivar')
        ->middleware('permisos:' . Permisos::DEPARTAMENTOS_ELIMINAR);
});
