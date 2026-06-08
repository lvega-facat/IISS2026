<?php

use App\Modules\Usuarios\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;
use App\Modules\RolesPermisos\Enums\Permisos;

// Grupo de rutas para usuarios
Route::prefix('usuarios')->name('usuarios.')->controller(UsuariosController::class)->middleware(['auth'])->group(function () {
    // Listar usuarios (vista principal)
    Route::get('/', 'index')->name('index')->middleware('permisos:' . Permisos::USUARIOS_VER);
    
    // Crear usuario
    Route::post('/', 'store')->middleware('permisos:' . Permisos::USUARIOS_CREAR);
    
    // Actualizar usuario
    Route::put('/{id}', 'update')->middleware('permisos:' . Permisos::USUARIOS_EDITAR);
    
    // Eliminar usuario (soft delete)
    Route::delete('/{id}', 'destroy')->middleware('permisos:' . Permisos::USUARIOS_ELIMINAR);
    
    // Activar/Desactivar usuario
    Route::patch('/activar/{id}', 'activate')->middleware('permisos:' . Permisos::USUARIOS_ELIMINAR);
    ;
});