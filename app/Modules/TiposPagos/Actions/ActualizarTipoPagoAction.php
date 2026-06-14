<?php

namespace App\Modules\TiposPagos\Actions;

use App\Models\TiposPago;

class ActualizarTipoPagoAction
{
    public function execute(TiposPago $tipoPago, array $data): TiposPago
    {
        $tipoPago->update([
            'nombre' => $data['nombre'],
            'codigo' => $data['codigo'],
            'descripcion' => $data['descripcion'] ?? null,
            'unidad_calculo' => $data['unidad_calculo'] ?? null,
        ]);

        return $tipoPago->fresh();
    }
}
