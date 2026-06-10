<?php

use App\Modules\Organizacion\Controllers\OrganizacionController;
use Illuminate\Support\Facades\Route;

Route::prefix('organizacion')->middleware(['auth'])->group(function () {
    Route::get('/', [OrganizacionController::class, 'index']);
        Route::get('/create', [OrganizacionController::class, 'create']);
        Route::get('/{id}/edit', [OrganizacionController::class, 'edit']);
});
