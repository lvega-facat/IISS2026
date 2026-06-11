<?php

use App\Modules\Autenticacion\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Modules\Organizacion\Controllers\OrganizacionController;

Route::get('/', function () {
    return view('welcome');
})->middleware('permission:dashboard.ver');

    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    //ORGANIZACION
    Route::get('/organizacion', [OrganizacionController::class, 'show'])
    ->name('organizacion.show');
    Route::get('/organizacion/form', [OrganizacionController::class, 'form'])
    ->name('organizacion.form');