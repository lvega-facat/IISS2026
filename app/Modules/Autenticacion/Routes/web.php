<?php

use App\Modules\Autenticacion\Controllers\AutenticacionController;
use Illuminate\Support\Facades\Route;

Route::prefix('autenticacion')->middleware(['auth'])->group(function () {
    Route::get('/', [AutenticacionController::class, 'index']);
});
