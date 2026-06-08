<?php

use App\Modules\Asistencias\Controllers\AsistenciasController;
use Illuminate\Support\Facades\Route;

Route::prefix('asistencias')->middleware(['auth'])->group(function () {
    Route::get('/', [AsistenciasController::class, 'index']);
    Route::get('/create', [AsistenciasController::class, 'create']);
    Route::get('/{id}/edit', [AsistenciasController::class, 'edit']);
});
