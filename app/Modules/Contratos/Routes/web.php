<?php

use App\Modules\Contratos\Controllers\ContratosController;
use App\Modules\Contratos\Profesiones\Controllers\ProfesionesController;
use App\Modules\Contratos\TiposContrato\Controllers\TipoContratoController;
use App\Modules\Contratos\HorariosTrabajo\Controllers\HorariosTrabajoController;
use App\Modules\Contratos\TiposFrecuencias\Controllers\TiposFrecuenciasController;
use App\Modules\RolesPermisos\Enums\Permisos;
use Illuminate\Support\Facades\Route;

Route::prefix('contratos')->middleware(['auth'])->group(function () {
    Route::get('/', [ContratosController::class, 'index'])->name('contratos.index')->middleware('permisos:' . Permisos::CONTRATOS_VER);
    Route::get('/create', [ContratosController::class, 'create'])->middleware('permisos:' . Permisos::CONTRATOS_CREAR);
    Route::get('/{id}/edit', [ContratosController::class, 'edit'])->middleware('permisos:' . Permisos::CONTRATOS_EDITAR);
    Route::post('/', [ContratosController::class, 'store'])->middleware('permisos:' . Permisos::CONTRATOS_CREAR);
    Route::put('/{id}', [ContratosController::class, 'update'])->middleware('permisos:' . Permisos::CONTRATOS_EDITAR);
    Route::delete('/{id}', [ContratosController::class, 'destroy'])->middleware('permisos:' . Permisos::CONTRATOS_ELIMINAR);
});

//rutas para profesiones

Route::prefix('contratos/profesiones')
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



Route::prefix('contratos/tipos-contrato')->middleware(['auth'])->group(function () {
    Route::get('/', [TipoContratoController::class, 'index'])->name('tipos-contrato.index')->middleware('permisos:' . Permisos::CONTRATOS_VER);
    Route::get('/create', [TipoContratoController::class, 'create'])->name('tipos-contrato.create')->middleware('permisos:' . Permisos::CONTRATOS_CREAR);
    Route::get('/{id}/edit', [TipoContratoController::class, 'edit'])->name('tipos-contrato.edit')->middleware('permisos:' . Permisos::CONTRATOS_EDITAR);
    Route::post('/', [TipoContratoController::class,'store'])->name('tipos-contrato.store')->middleware('permisos:' . Permisos::CONTRATOS_CREAR);
    Route::put('/{id}', [TipoContratoController::class,'update'])->name('tipos-contrato.update')->middleware('permisos:' . Permisos::CONTRATOS_EDITAR);
    Route::delete('/{id}', [TipoContratoController::class,'destroy'])->name('tipos-contrato.destroy')->middleware('permisos:' . Permisos::CONTRATOS_ELIMINAR);
});

Route::prefix('contratos/horarios')->middleware(['auth'])->group(function () {
    Route::get('/', [HorariosTrabajoController::class, 'index'])->name('horarios.index')->middleware('permisos:' . Permisos::CONTRATOS_VER)->name('horarios.index');
    Route::get('/create', [HorariosTrabajoController::class, 'create'])->middleware('permisos:' . Permisos::CONTRATOS_CREAR)->name('horarios.create');
    Route::get('/{id}/edit', [HorariosTrabajoController::class, 'edit'])->middleware('permisos:' . Permisos::CONTRATOS_EDITAR)->name('horarios.edit');
    Route::post('/', [HorariosTrabajoController::class, 'store'])->middleware('permisos:' . Permisos::CONTRATOS_CREAR)->name('horarios.store');
    Route::put('/{id}', [HorariosTrabajoController::class, 'update'])->middleware('permisos:' . Permisos::CONTRATOS_EDITAR)->name('horarios.update');
    Route::delete('/{id}', [HorariosTrabajoController::class, 'destroy'])->middleware('permisos:' . Permisos::CONTRATOS_ELIMINAR)->name('horarios.destroy');
});

Route::prefix('contratos/tipos-frecuencias')->middleware(['auth'])->group(function () {
    Route::get('/', [TiposFrecuenciasController::class, 'index']);
    Route::get('/create', [TiposFrecuenciasController::class, 'create']);
    Route::get('/{id}/edit', [TiposFrecuenciasController::class, 'edit']);
});
