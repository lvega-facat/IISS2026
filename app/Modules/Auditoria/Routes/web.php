<?php

use App\Modules\Auditoria\Controllers\AuditoriaController;
use Illuminate\Support\Facades\Route;

Route::prefix('auditoria')->middleware(['auth'])->group(function () {
    Route::get('/', [AuditoriaController::class, 'index']);
});
