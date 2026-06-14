<?php

namespace App\Modules\Contratos\TiposContrato\Actions;

use App\Models\TiposContrato;

class EliminarTipoContratoAction
{
    public function execute(
        TiposContrato $tipoContrato
    ): TiposContrato {

        $tipoContrato->update([
            'estado' => false
        ]);

        return $tipoContrato->fresh();
    }
}