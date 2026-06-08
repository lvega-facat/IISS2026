<?php

use App\Modules\Autenticacion\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Modules\Organizacion\Controllers\OrganizacionController;

Route::get('/', function () {
    return view('welcome');
})->middleware('permission:dashboard.ver');

    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::prefix('organizacion')->group(function () {
    Route::get('/', [OrganizacionController::class, 'index'])->name('organizacion.index');
    Route::get('/create', [OrganizacionController::class, 'create'])->name('organizacion.create');
    Route::post('/', [OrganizacionController::class, 'store'])->name('organizacion.store');
    Route::get('/edit/{id}', [OrganizacionController::class, 'edit'])->name('organizacion.edit');
    Route::put('/{id}', [OrganizacionController::class, 'update'])->name('organizacion.update');
    Route::delete('/{id}', [OrganizacionController::class, 'destroy'])->name('organizacion.destroy');
});