<?php

namespace App\Modules\TiposPagos\Actions;

use App\Models\TiposPago;

class CrearTipoPagoAction
{
    public function execute(array $data): TiposPago
    {
        return TiposPago::create([
            'nombre' => $data['nombre'],
            'codigo' => $data['codigo'],
            'descripcion' => $data['descripcion'] ?? null,
            'unidad_calculo' => $data['unidad_calculo'] ?? null,
            'estado' => true,
        ]);
    }
}
