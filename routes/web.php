<?php

use App\Modules\Autenticacion\Controllers\LoginController;
use App\Modules\RolesPermisos\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// Rutas de Roles y Permisos
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
Route::get('/roles/{id}/permisos', [RoleController::class, 'gestionarPermisos'])->name('roles.permissions');
Route::post('/roles/{id}/asignar-permisos', [RoleController::class, 'asignarPermisos'])->name('roles.asignarPermisos');

