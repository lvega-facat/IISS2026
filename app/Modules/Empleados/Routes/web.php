<?php

use App\Modules\Empleados\Controllers\EmpleadosController;
use Illuminate\Support\Facades\Route;

Route::prefix('empleados')->middleware(['auth'])->name('empleados.')->group(function () {

    // Listado y búsqueda — HU-EMP-019
    Route::get('/', [EmpleadosController::class, 'index'])->name('index');

    // Ficha de detalle
    Route::get('/{empleado}', [EmpleadosController::class, 'show'])->name('show');

    // Registro — HU-EMP-016
    Route::get('/create', [EmpleadosController::class, 'create'])->name('create');
    Route::post('/', [EmpleadosController::class, 'store'])->name('store');

    // Edición — HU-EMP-017
    Route::get('/{empleado}/edit', [EmpleadosController::class, 'edit'])->name('edit');
    Route::put('/{empleado}', [EmpleadosController::class, 'update'])->name('update');

    // Cambio de cargo/departamento con historial — HU-EMP-017
    Route::patch('/{empleado}/cargo', [EmpleadosController::class, 'cambiarCargo'])->name('cargo');

    // Baja lógica — HU-EMP-017
    Route::delete('/{empleado}', [EmpleadosController::class, 'destroy'])->name('destroy');

    // Restaurar empleado dado de baja — HU-EMP-017
    Route::patch('/{empleado}/restaurar', [EmpleadosController::class, 'restore'])->name('restore');

    // Exportar ficha PDF — HU-EMP-016
    Route::get('/{empleado}/exportar/pdf', [EmpleadosController::class, 'exportarPDF'])->name('exportar.pdf');
});
