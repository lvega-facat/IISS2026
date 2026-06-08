<?php

use App\Modules\Organizacion\Controllers\OrganizacionController;
use Illuminate\Support\Facades\Route;

Route::prefix('organizacion')->middleware(['auth'])->group(function () {
    Route::get('/', [OrganizacionController::class, 'index']);
});
