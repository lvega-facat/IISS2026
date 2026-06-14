<?php

namespace App\Modules\Contratos\TiposContrato\Actions;

use App\Models\TiposContrato;

class ActualizarTipoContratoAction
{
    public function execute(
        TiposContrato $tipoContrato,
        array $data
    ): TiposContrato {

        $tipoContrato->update([
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'] ?? null,
            'id_profesion' => $data['id_profesion'],
            'id_horario' => $data['id_horario'],
        ]);

        return $tipoContrato->fresh();
    }
}