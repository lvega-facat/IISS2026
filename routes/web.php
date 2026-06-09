<?php

use App\Modules\Autenticacion\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Modules\Usuarios\Controllers\UsuariosController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// Rutas de Roles y Permisos - Solo vistas
Route::get('/roles', function () {
    return view('Modules.RolesPermisos.index');
})->name('roles.index');

Route::get('/roles/gestionarPrivilegio', function () {
    return view('Modules.RolesPermisos.gestionarPrivilegio');
})->name('roles.gestion');

Route::get('/roles/{id}/permisos', function ($id) {
    return view('Modules.RolesPermisos.gestionarPrivilegio', compact('id'));
})->name('roles.permissions');

Route::get('/roles/create', function () {
    return view('Modules.RolesPermisos.form');
})->name('roles.create');

Route::get('/roles/{id}/edit', function () {
    return view('Modules.RolesPermisos.form');
})->name('roles.edit');

Route::post('/roles', function () {
})->name('roles.store');

Route::put('/roles/{id}', function () {
})->name('roles.update');

Route::delete('/roles/{id}', function () {
})->name('roles.destroy');