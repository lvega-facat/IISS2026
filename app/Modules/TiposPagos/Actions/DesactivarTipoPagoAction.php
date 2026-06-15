<?php

namespace App\Modules\TiposPagos\Actions;

use App\Models\TiposPago;

class DesactivarTipoPagoAction
{
    public function execute(TiposPago $tipoPago): void
    {
        $tipoPago->estado = false;
        $tipoPago->save();
    }
}
