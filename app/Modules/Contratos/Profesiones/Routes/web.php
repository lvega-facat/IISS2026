<?php

use App\Modules\Contratos\Profesiones\Controllers\ProfesionesController;
use App\Enums\Permisos;
use Illuminate\Support\Facades\Route;

Route::prefix('profesiones')
    ->name('profesiones.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [ProfesionesController::class, 'index'])
            ->name('index')->middleware('permisos:' . Permisos::CONTRATOS_VER);
        Route::get('/crear', [ProfesionesController::class, 'create'])
            ->name('create')->middleware('permisos:' . Permisos::CONTRATOS_CREAR);
        Route::post('/', [ProfesionesController::class, 'store'])
            ->name('store')->middleware('permisos:' . Permisos::CONTRATOS_CREAR);
        Route::get('/{id}', [ProfesionesController::class, 'show'])
            ->name('show')->middleware('permisos:' . Permisos::CONTRATOS_VER);
        Route::get('/{id}/editar', [ProfesionesController::class, 'edit'])
            ->name('edit')->middleware('permisos:' . Permisos::CONTRATOS_EDITAR);
        Route::put('/{id}', [ProfesionesController::class, 'update'])
            ->name('update')->middleware('permisos:' . Permisos::CONTRATOS_EDITAR);
        Route::patch('/{id}/desactivar', [ProfesionesController::class, 'destroy'])
            ->name('destroy')->middleware('permisos:' . Permisos::CONTRATOS_ELIMINAR);
    });
