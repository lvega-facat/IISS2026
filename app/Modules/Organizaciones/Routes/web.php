<?php

use App\Modules\Organizaciones\Controllers\OrganizacionController;
use Illuminate\Support\Facades\Route;
use App\Modules\RolesPermisos\Enums\Permisos;

Route::prefix('organizacion')->middleware(['auth'])->group(function () {
    Route::get('/', [OrganizacionController::class, 'index'])->middleware('Permisos:' . Permisos::ORGANIZACION_VER);
        Route::get('/create', [OrganizacionController::class, 'create'])->middleware('Permisos:' . Permisos::ORGANIZACION_CREAR);
        Route::get('/{id}/edit', [OrganizacionController::class, 'edit'])->middleware('Permisos:' . Permisos::ORGANIZACION_EDITAR);
        Route::post('/', [OrganizacionController::class, 'store'])->middleware('Permisos:' . Permisos::ORGANIZACION_CREAR);
        Route::put('/{id}', [OrganizacionController::class, 'update'])->middleware('Permisos:' . Permisos::ORGANIZACION_EDITAR);
        Route::delete('/{id}', [OrganizacionController::class, 'destroy'])->middleware('Permisos:' . Permisos::ORGANIZACION_ELIMINAR);
});
//