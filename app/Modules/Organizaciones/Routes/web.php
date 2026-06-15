<?php

use App\Modules\Organizaciones\Controllers\OrganizacionesController;
use Illuminate\Support\Facades\Route;
use App\Modules\RolesPermisos\Enums\Permisos;

Route::prefix('organizacion')->middleware(['auth'])->group(function () {
    Route::get('/', [OrganizacionesController::class, 'index'])->middleware('Permisos:' . Permisos::ORGANIZACION_VER);
        Route::get('/create', [OrganizacionesController::class, 'create'])->middleware('Permisos:' . Permisos::ORGANIZACION_CREAR);
        Route::get('/{id}/edit', [OrganizacionesController::class, 'edit'])->middleware('Permisos:' . Permisos::ORGANIZACION_EDITAR);
        Route::post('/', [OrganizacionesController::class, 'store'])->middleware('Permisos:' . Permisos::ORGANIZACION_CREAR);
        Route::put('/{id}', [OrganizacionesController::class, 'update'])->middleware('Permisos:' . Permisos::ORGANIZACION_EDITAR);
        Route::delete('/{id}', [OrganizacionesController::class, 'destroy'])->middleware('Permisos:' . Permisos::ORGANIZACION_ELIMINAR);
});
//