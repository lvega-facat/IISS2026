<?php

namespace App\Modules\TiposPagos\Actions;

use App\Models\TiposPago;

class ActivarTipoPagoAction
{
    public function execute(TiposPago $tipoPago): void
    {
        $tipoPago->estado = true;
        $tipoPago->save();
    }
}
