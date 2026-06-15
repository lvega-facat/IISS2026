<?php

namespace App\Modules\FrecuenciaPagos\Actions;

use App\Models\FrecuenciasPago;

class CrearFrecuenciaPagoAction
{
    public function execute(array $data): FrecuenciasPago
    {
        return FrecuenciasPago::create([
            'nombre' => $data['nombre'],
            'dias'   => $data['dias'],
            'estado' => true,
        ]);
    }
}
