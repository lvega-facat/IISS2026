<?php

use App\Modules\Autenticacion\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Modules\Usuarios\Controllers\UsuariosController;

Route::get('/', function () {
    return view('welcome');
})->middleware('permission:dashboard.ver');

    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/usuarios', function () {
    return view('Modules.Usuarios.index');
})->name('usuarios.index');

Route::get('/usuarios/create', function () {
    return view('Modules.Usuarios.form');
})->name('usuarios.create');

Route::get('/usuarios/{id}', function () {
    return view('Modules.Usuarios.form');
})->name('usuarios.show');

Route::get('/usuarios/{id}/edit', function () {
    return view('Modules.Usuarios.form');
})->name('usuarios.edit');

Route::post('/usuarios', function () {})->name('usuarios.store');
Route::put('/usuarios/{id}', function () {})->name('usuarios.update');
Route::patch('/usuarios/{id}/toggle', function () {})->name('usuarios.toggle');
Route::get('/usuarios/{id}/auditoria', function () {})->name('usuarios.auditoria');
Route::get('/usuarios/{id}/change-password', function () {})->name('usuarios.change-password');