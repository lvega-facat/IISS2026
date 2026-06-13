
<?php

use Illuminate\Support\Facades\Route;

use App\Modules\Asistencias\Controllers\AsistenciaController;

use App\Modules\RolesPermisos\Enums\Permisos;

Route::prefix('asistencias')
    ->middleware(['auth'])
    ->name('asistencias.')
    ->group(function () {

        Route::get(
            '/',
            [AsistenciaController::class, 'index']
        )->name('index')->middleware('permisos:' . Permisos::ASISTENCIA_VER);
        Route::get(
            '/{id}/edit',
            [AsistenciaController::class, 'edit']
        )->name('edit')
            ->middleware('permisos:' . Permisos::ASISTENCIA_EDITAR);

        Route::put(
            '/{id}',
            [AsistenciaController::class, 'update']
        )->name('update')
            ->middleware('permisos:' . Permisos::ASISTENCIA_EDITAR);

        Route::post(
            '/entrada',
            [AsistenciaController::class, 'registrarEntrada']
        )->name('entrada')->middleware('permisos:' . Permisos::ASISTENCIA_REGISTRAR);

        Route::put(
            '/{id}/salida',
            [AsistenciaController::class, 'registrarSalida']
        )->name('salida')->middleware('permisos:' . Permisos::ASISTENCIA_EDITAR);

        Route::post(
            '/generar-ausencias',
            [AsistenciaController::class, 'generarAusencias']
        )->name('ausencias')->middleware('permisos:' . Permisos::ASISTENCIA_CREAR);
    });
