<?php

namespace App\Modules\Contratos\Actions;

use App\Models\Contratos;

class ActualizarContratoAction
{
    public function execute(Contratos $contrato, array $data): Contratos
    {
        $contrato->update([
            'id_tipo_contrato'   => $data['id_tipo_contrato'],
            'monto_base'         => $data['monto_base'],
            'fecha_inicio'       => $data['fecha_inicio'],
            'id_tipo_pago'       => $data['id_tipo_pago'],
            'id_frecuencia_pago' => $data['id_frecuencia_pago'],
            'fecha_fin'          => $data['fecha_fin'] ?? null,
        ]);

        return $contrato->fresh();
    }
}