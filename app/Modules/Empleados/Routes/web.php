<?php

use App\Modules\Empleados\Controllers\EmpleadosController;
use Illuminate\Support\Facades\Route;

Route::prefix('empleados')->middleware(['auth'])->group(function () {

    // Listado y búsqueda
    Route::get('/', [EmpleadosController::class, 'index'])->name('index')->middleware('permisos:' . Permisos::EMPLEADOS_VER);

    // Ficha de detalle
    Route::get('/{empleado}', [EmpleadosController::class, 'show'])->name('show');

    // Registro 
    Route::get('/create', [EmpleadosController::class, 'create'])->name('create');
    Route::post('/', [EmpleadosController::class, 'store'])->name('store');

    // Edición
    Route::get('/{empleado}/edit', [EmpleadosController::class, 'edit'])->name('edit');
    Route::put('/{empleado}', [EmpleadosController::class, 'update'])->name('update');

    // Cambio de cargo/departamento con historial 
    Route::patch('/{empleado}/cargo', [EmpleadosController::class, 'cambiarCargo'])->name('cargo');

    // Baja lógica 
    Route::delete('/{empleado}', [EmpleadosController::class, 'destroy'])->name('destroy');

    // Restaurar empleado dado de baja 
    Route::patch('/{empleado}/restaurar', [EmpleadosController::class, 'restore'])->name('restore');

    // Exportar ficha PDF 
    Route::get('/{empleado}/exportar/pdf', [EmpleadosController::class, 'exportarPDF'])->name('exportar.pdf');
});
