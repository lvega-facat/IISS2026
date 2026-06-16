<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Contratos\TiposContrato\Controllers\TipoContratoController;

Route::view('/dev/usuario', 'Modules.usuario.index');
Route::view('/dev/empleado', 'Modules.empelado.index');
Route::view('/dev/cargo', 'Modules.cargo.index');
Route::view('/dev/contrato/tipo-contrato', 'Modules.contrato.tipo-contrato.index');
Route::view('/dev/contrato/profesion', 'Modules.contrato.profesion.index');
Route::view('/dev/contrato/tipo-pago', 'Modules.contrato.tipo-pago.index');
Route::view('/dev/contrato/frecuencia-pago', 'Modules.contrato.frecuencia-pago.index');
Route::view('/dev/contrato/horario', 'Modules.contrato.horario.index');

Route::resource('tipos-contrato', TipoContratoController::class)->names([
    'index'   => 'tipos-contrato.index',
    'create'  => 'tipos-contrato.create',
    'store'   => 'tipos-contrato.store',
    'edit'    => 'tipos-contrato.edit',
    'update'  => 'tipos-contrato.update',
    'destroy' => 'tipos-contrato.destroy',
])->except(['show']);