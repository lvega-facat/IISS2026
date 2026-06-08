<?php

use App\Modules\Cargos\Controllers\CargosController;
use Illuminate\Support\Facades\Route;

Route::prefix('cargos')->middleware(['auth'])->group(function () {
    Route::get('/', [CargosController::class, 'index']);
    Route::get('/create', [CargosController::class, 'create']);
    Route::get('/{id}/edit', [CargosController::class, 'edit']);
});
