<?php

use App\Modules\Autenticacion\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Modules\Organizacion\Controllers\OrganizacionController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

