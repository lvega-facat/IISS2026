<?php

namespace App\Modules\FrecuenciaPagos\Actions;

use App\Models\FrecuenciasPago;

class ActualizarFrecuenciaPagoAction
{
    public function execute(FrecuenciasPago $frecuencia, array $data): FrecuenciasPago
    {
        $frecuencia->update([
            'nombre' => $data['nombre'],
            'dias'   => $data['dias'],
        ]);

        return $frecuencia->fresh();
    }
}
