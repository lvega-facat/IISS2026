<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Asistencias\Controllers\AsistenciaController;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/asistencias', [AsistenciaController::class, 'index'])
        ->name('asistencias.index');
    Route::post('/asistencias/entrada', [AsistenciaController::class, 'storeEntrada'])
        ->name('asistencias.entrada');
    Route::post('/asistencias/salida', [AsistenciaController::class, 'storeSalida'])
        ->name('asistencias.salida');
    Route::post('/asistencias/manual', [AsistenciaController::class, 'storeManual'])
        ->name('asistencias.manual');