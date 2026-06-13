<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Autenticacion\Controllers\LoginController;
use App\Modules\Departamentos\Controllers\DepartamentosController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');