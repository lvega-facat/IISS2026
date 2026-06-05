<?php

use App\Modules\RolesPermisos\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::get('/permisos-por-modulo', [RoleController::class, 'permisosPorModulo']);
    Route::get('/{id}', [RoleController::class, 'show']);
    Route::post('/', [RoleController::class, 'store']);
    Route::put('/{id}', [RoleController::class, 'update']);
    Route::delete('/{id}', [RoleController::class, 'destroy']);
    Route::post('/{id}/asignar-permisos', [RoleController::class, 'asignarPermisos']);
});
