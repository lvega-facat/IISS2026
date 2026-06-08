<?php

use App\Modules\Justificativos\Controllers\JustificativosController;
use Illuminate\Support\Facades\Route;

Route::prefix('justificativos')->middleware(['auth'])->group(function () {
    Route::get('/', [JustificativosController::class, 'index']);
});
