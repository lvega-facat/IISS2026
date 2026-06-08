<?php

namespace App\Modules\Asistencias\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        // UI: pantalla principal de marcación y listado
        return view('Modules.asistencias.index');
    }

    public function storeEntrada(Request $request)
    {
        // TODO: Backend implementa:
        // - registrar hora de entrada
        // - asignar fecha automática
        // - calcular estado de asistencia

        return back();
    }

    public function storeSalida(Request $request)
    {
        // TODO: Backend implementa:
        // - registrar hora de salida
        // - actualizar asistencia del día
        // - calcular horas trabajadas

        return back();
    }

    public function storeManual(Request $request)
    {
        // TODO: Backend implementa:
        // - validación de RRHH
        // - marcación manual (entrada/salida)
        // - registro en logs

        return back();
    }
}