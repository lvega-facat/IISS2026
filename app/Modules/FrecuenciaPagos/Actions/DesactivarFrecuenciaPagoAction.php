<?php

namespace App\Modules\FrecuenciaPagos\Actions;

use App\Models\FrecuenciasPago;

class DesactivarFrecuenciaPagoAction
{
    public function execute(FrecuenciasPago $frecuencia): FrecuenciasPago
    {
        $frecuencia->update(['estado' => false]);

        return $frecuencia->fresh();
    }
}
