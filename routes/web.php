<?php

use App\Modules\Profesiones\Controllers\ProfesionesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('profesiones', ProfesionesController::class)
    ->only(['index', 'store', 'update', 'destroy']);
