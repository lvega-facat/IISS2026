<?php

namespace App\Modules\Contratos\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contratos;
use Illuminate\Http\Request;

use App\Modules\Contratos\Actions\CrearContratoAction;
use App\Modules\Contratos\Actions\ActualizarContratoAction;
use App\Modules\Contratos\Actions\FinalizarContratoAction;

class ContratosController extends Controller
{
    public function index()
    {
        return view('Modules.Contratos.index');
    }

    public function create()
    {
        return view('Modules.Contratos.form');
    }

    public function edit($id)
    {
        return view('Modules.Contratos.form');
    }
//crear
    public function store(
        Request $request,
        CrearContratoAction $action
    ) {
        $data = $request->validate([
            'id_empleado' => 'required|integer|exists:empleados,id',
            'id_tipo_contrato' => 'required|integer|exists:tipos_contrato,id',
            'monto_base' => 'required|numeric|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'id_tipo_pago' => 'required|integer|exists:tipos_pago,id',
            'id_frecuencia_pago' => 'required|integer|exists:frecuencias_pago,id',
        ]);

        $existeContratoActivo = Contratos::where(
            'id_empleado',
            $data['id_empleado']
        )
        ->where('estado', true)
        ->exists();

        if ($existeContratoActivo) {
            return back()->withErrors([
                'id_empleado' => 'El empleado ya posee un contrato activo.'
            ]);
        }

        $action->execute($data);

        return redirect()->route('contratos.index');
    }

    public function update(
        Request $request,
        $id,
        ActualizarContratoAction $action
    ) {
        $contrato = Contratos::findOrFail($id);

        $data = $request->validate([
            'id_tipo_contrato' => 'required|integer|exists:tipos_contrato,id',
            'monto_base' => 'required|numeric|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'id_tipo_pago' => 'required|integer|exists:tipos_pago,id',
            'id_frecuencia_pago' => 'required|integer|exists:frecuencias_pago,id',
        ]);

        $action->execute($contrato, $data);

        return redirect()->route('contratos.index');
    }

    public function destroy(
        Request $request,
        $id,
        FinalizarContratoAction $action
    ) {
        $contrato = Contratos::findOrFail($id);

        $data = $request->validate([
            'fecha_fin' => 'required|date'
        ]);

        $action->execute(
            $contrato,
            $data['fecha_fin']
        );

        return redirect()->route('contratos.index');
    }
}