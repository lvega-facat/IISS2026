<?php

use App\Modules\Empleados\Controllers\EmpleadosController;
use Illuminate\Support\Facades\Route;

Route::prefix('empleados')->middleware(['auth'])->group(function () {
    Route::get('/', [EmpleadosController::class, 'index']);
});
