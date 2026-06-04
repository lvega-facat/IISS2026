<?php

use App\Modules\Autenticacion\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Modules\Usuarios\Controllers\UsuariosController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('usuarios', UsuariosController::class);
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});
