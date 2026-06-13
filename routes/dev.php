<?php

use Illuminate\Support\Facades\Route;

Route::view('/dev/usuario', 'Modules.usuario.index');
Route::view('/dev/empleado', 'Modules.empelado.index');

// HU-ORG-004 PROFESIONES — datos de demo (en producción vienen del controlador)
$profesionesDemo = [
    ['nombre' => 'Médico', 'descripcion' => 'Profesional de la salud', 'activo' => true, 'creado_en' => '2026-01-15'],
    ['nombre' => 'Abogado', 'descripcion' => 'Profesional del derecho', 'activo' => true, 'creado_en' => '2026-02-03'],
    ['nombre' => 'Contador', 'descripcion' => 'Profesional de las finanzas', 'activo' => false, 'creado_en' => '2026-03-21'],
];

$profesionDemo = ['nombre' => 'Médico', 'descripcion' => 'Profesional de la salud', 'activo' => true, 'creado_en' => '2026-01-15'];

Route::view('/dev/profesion', 'Modules.profesion.index', ['profesiones' => $profesionesDemo]);
Route::view('/dev/profesion/crear', 'Modules.profesion.form');
Route::view('/dev/profesion/editar', 'Modules.profesion.form', ['profesion' => $profesionDemo]);
Route::view('/dev/profesion/ver', 'Modules.profesion.show', ['profesion' => $profesionDemo]);