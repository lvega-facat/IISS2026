<?php

use Illuminate\Support\Facades\Route;

Route::view('/dev/usuario', 'Modules.usuario.index');
Route::view('/dev/empleado', 'Modules.empelado.index');
Route::view('/dev/cargo', 'Modules.cargo.index');
Route::view('/dev/contrato/tipo-contrato', 'Modules.contrato.tipo-contrato.index');
Route::view('/dev/contrato/profesion', 'Modules.contrato.profesion.index');
Route::view('/dev/contrato/horario', 'Modules.contrato.horario.index');

// ── Tipos de Pago ─────────────────────────────────────────────────────────────
Route::view('/dev/contrato/tipos-pago', 'Modules.contrato.tipos-pago.index', [
    'tiposPago' => collect([]),
])->name('tipos-pago.index');

Route::view('/dev/contrato/tipos-pago/create', 'Modules.contrato.tipos-pago.form')
    ->name('tipos-pago.create');

Route::view('/dev/contrato/tipos-pago/edit', 'Modules.contrato.tipos-pago.form', [
    'tiposPago' => (object) ['id' => 1, 'nombre' => 'Transferencia Bancaria', 'descripcion' => 'Pago por transferencia', 'estado' => true],
])->name('tipos-pago.edit');

Route::view('/dev/contrato/tipos-pago/gestionar', 'Modules.contrato.tipos-pago.gestionar', [
    'tipoPago'      => (object) ['id' => 1, 'nombre' => 'Transferencia Bancaria', 'descripcion' => 'Pago por transferencia', 'estado' => true],
    'frecuencias'   => collect([]),
    'seleccionadas' => [],
])->name('tipos-pago.gestionar');

Route::post('/dev/contrato/tipos-pago', fn() => back())->name('tipos-pago.store');
Route::put('/dev/contrato/tipos-pago/{id}', fn() => back())->name('tipos-pago.update');
Route::delete('/dev/contrato/tipos-pago/{id}', fn() => back())->name('tipos-pago.destroy');
Route::patch('/dev/contrato/tipos-pago/{id}/toggle', fn() => back())->name('tipos-pago.toggle');
Route::post('/dev/contrato/tipos-pago/{id}/frecuencias', fn() => back())->name('tipos-pago.guardar-frecuencias');

// ── Frecuencia de Pago ────────────────────────────────────────────────────────
Route::view('/dev/contrato/frecuencia-pago', 'Modules.contrato.frecuencia-pago.index', [
    'frecuenciasPago' => collect([]),
])->name('frecuencia-pago.index');

Route::view('/dev/contrato/frecuencia-pago/create', 'Modules.contrato.frecuencia-pago.form')
    ->name('frecuencia-pago.create');

Route::view('/dev/contrato/frecuencia-pago/edit', 'Modules.contrato.frecuencia-pago.form', [
    'frecuenciaPago' => (object) ['id' => 1, 'nombre' => 'Mensual', 'descripcion' => 'Pago mensual', 'estado' => true],
])->name('frecuencia-pago.edit');

Route::post('/dev/contrato/frecuencia-pago', fn() => back())->name('frecuencia-pago.store');
Route::put('/dev/contrato/frecuencia-pago/{id}', fn() => back())->name('frecuencia-pago.update');
Route::delete('/dev/contrato/frecuencia-pago/{id}', fn() => back())->name('frecuencia-pago.destroy');
Route::patch('/dev/contrato/frecuencia-pago/{id}/toggle', fn() => back())->name('frecuencia-pago.toggle');
