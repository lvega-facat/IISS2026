<?php

namespace App\Modules\Justificativos\Controllers;

use App\Models\Justificativos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Justificativos\Actions\CrearJustificativoAction;
use App\Modules\Justificativos\Actions\ActualizarJustificativoAction;
use App\Modules\Justificativos\Actions\AprobarJustificativoAction;
use App\Modules\Justificativos\Actions\RechazarJustificativoAction;

class JustificativoController extends Controller
{
    public function index()
    {
        return view('Modules.Justificativos.index');
    }

    public function create()
    {
        return view('Modules.Justificativos.form');
    }

    public function store(
        Request $request,
        CrearJustificativoAction $action
    ) {

        $data = $request->validate([
            'id_asistencia' => [
                'required',
                'exists:asistencias,id'
            ],
            'tipo_justificativo' => [
                'required'
            ],
            'descripcion' => [
                'nullable'
            ],
            'archivo_url' => [
                'nullable'
            ]
        ]);

        $data['estado_aprobacion'] = 'pendiente';

        $action->execute($data);

        return redirect()
            ->route('justificativos.index');
    }

    public function update(
        Request $request,
        int $id,
        ActualizarJustificativoAction $action
    ) {

        $justificativo =
            Justificativos::findOrFail($id);

        $data = $request->validate([
            'tipo_justificativo' => [
                'required'
            ],
            'descripcion' => [
                'nullable'
            ],
            'archivo_url' => [
                'nullable'
            ]
        ]);

        $action->execute(
            $justificativo,
            $data
        );

        return redirect()
            ->route('justificativos.index');
    }

    public function aprobar(
        int $id,
        AprobarJustificativoAction $action
    ) {

        $justificativo =
            Justificativos::findOrFail($id);

        $action->execute(
            $justificativo,
            auth()->id()
        );

        return back();
    }

    public function rechazar(
        int $id,
        RechazarJustificativoAction $action
    ) {

        $justificativo =
            Justificativos::findOrFail($id);

        $action->execute(
            $justificativo,
            auth()->id()
        );

        return back();
    }
}