<?php

namespace App\Modules\FrecuenciaPagos\Actions;

use App\Models\FrecuenciasPago;

class ActivarFrecuenciaPagoAction
{
    public function execute(FrecuenciasPago $frecuencia): FrecuenciasPago
    {
        $frecuencia->update(['estado' => true]);

        return $frecuencia->fresh();
    }
}
