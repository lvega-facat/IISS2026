<?php

namespace App\Modules\Contratos\Actions;

use App\Models\Contratos;

class CrearContratoAction
{
    public function execute(array $data): Contratos
    {
        return Contratos::create([
            'id_empleado'         => $data['id_empleado'],
            'id_tipo_contrato'    => $data['id_tipo_contrato'],
            'monto_base'          => $data['monto_base'],
            'fecha_inicio'        => $data['fecha_inicio'],
            'id_tipo_pago'        => $data['id_tipo_pago'],
            'id_frecuencia_pago'  => $data['id_frecuencia_pago'],
            'fecha_fin'           => $data['fecha_fin'] ?? null,
            'estado'              => true,
        ]);
    }
}