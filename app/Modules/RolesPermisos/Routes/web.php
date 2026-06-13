<?php

use App\Modules\RolesPermisos\Enums\Permisos;
use App\Modules\RolesPermisos\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

use App\Modules\Autenticacion\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::prefix('roles')->middleware(['auth'])->group(function () {
    // Usando las constantes del enum
    Route::get('/', [RoleController::class, 'index'])
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_VER);
    Route::get('/create', [RoleController::class, 'create'])
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_CREAR);
    Route::get('/{id}/edit', [RoleController::class, 'edit'])
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_EDITAR);
    
    Route::post('/', [RoleController::class, 'store'])
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_CREAR);
    
    Route::put('/{id}', [RoleController::class, 'update'])
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_EDITAR);
    
    Route::delete('/{id}', [RoleController::class, 'destroy'])
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_ELIMINAR);
    
    Route::post('/{id}/asignar-permisos', [RoleController::class, 'asignarPermisos'])
        ->middleware('permisos:' . Permisos::ROLES_PERMISOS_EDITAR);
});