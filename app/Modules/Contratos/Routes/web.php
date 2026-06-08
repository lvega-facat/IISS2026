<?php

use App\Modules\Contratos\Controllers\ContratosController;
use Illuminate\Support\Facades\Route;

Route::prefix('contratos')->middleware(['auth'])->group(function () {
    Route::get('/', [ContratosController::class, 'index']);
});
