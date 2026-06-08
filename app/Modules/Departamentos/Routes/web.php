<?php

use App\Modules\Departamentos\Controllers\DepartamentosController;
use Illuminate\Support\Facades\Route;

Route::prefix('departamentos')->middleware(['auth'])->group(function () {
    Route::get('/', [DepartamentosController::class, 'index']);
});
