<?php

namespace App\Modules\Contratos\Actions;

use App\Models\Contratos;

class FinalizarContratoAction
{
    public function execute(Contratos $contrato, string $fechaFin): Contratos
    {
        $contrato->update([
            'fecha_fin' => $fechaFin,
            'estado' => false,
        ]);

        return $contrato->fresh();
    }
}