<?php

use App\Modules\Planillas\Controllers\PlanillasController;
use Illuminate\Support\Facades\Route;

Route::prefix('planillas')->middleware(['auth'])->group(function () {
    Route::get('/', [PlanillasController::class, 'index']);
});
