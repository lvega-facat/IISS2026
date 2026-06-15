<?php

namespace App\Modules\Contratos\TiposContrato\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TiposContrato;

use App\Modules\Contratos\TiposContrato\Actions\CrearTipoContratoAction;
use App\Modules\Contratos\TiposContrato\Actions\ActualizarTipoContratoAction;
use App\Modules\Contratos\TiposContrato\Actions\EliminarTipoContratoAction;

class TipoContratoController extends Controller
{
    public function index()
    {
        return view('Modules.Contratos.TiposContrato.index');
    }

    public function create()
    {
        return view('Modules.Contratos.TiposContrato.form');
    }

    public function edit($id)
    {
        return view('Modules.Contratos.TiposContrato.form');
    }

    public function store(
        Request $request,
        CrearTipoContratoAction $action
    ) {
        $data = $request->validate([
            'nombre' => 'required|string|max:100|unique:tipos_contrato,nombre',
            'descripcion' => 'nullable|string|max:255',

            'id_profesion' => 'required|integer|exists:profesiones,id',
            'id_horario' => 'required|integer|exists:horarios_trabajo,id',
        ]);

        $action->execute($data);

        return redirect()->route('tipos-contrato.index');
    }

    public function update(
        Request $request,
        $id,
        ActualizarTipoContratoAction $action
    ) {
        $tipoContrato = TiposContrato::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required|string|max:100|unique:tipos_contrato,nombre,' . $tipoContrato->id,

            'descripcion' => 'nullable|string|max:255',

            'id_profesion' => 'required|integer|exists:profesiones,id',

            'id_horario' => 'required|integer|exists:horarios_trabajo,id',
        ]);

        $action->execute(
            $tipoContrato,
            $data
        );

        return redirect()->route('tipos-contrato.index');
    }

    public function destroy(
        $id,
        EliminarTipoContratoAction $action
    ) {
        $tipoContrato = TiposContrato::findOrFail($id);

        if ($tipoContrato->contratos()->exists()) {
            return back()->withErrors([
                'tipo_contrato' =>
                    'No se puede eliminar porque tiene contratos asociados.'
            ]);
        }

        $action->execute($tipoContrato);

        return redirect()->route('tipos-contrato.index');
    }
}