<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Usuarios\Controllers\UsuariosController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('usuarios', UsuariosController::class);
