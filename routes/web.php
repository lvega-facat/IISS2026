<?php

use App\Modules\Autenticacion\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Modules\Profesiones\Controllers\ProfesionesController;
use App\Modules\Usuarios\Controllers\UsuariosController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');
//rutas para login
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

