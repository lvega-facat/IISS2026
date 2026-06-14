<?php

namespace App\Modules\Contratos\TiposContrato\Actions;

use App\Models\TiposContrato;

class CrearTipoContratoAction
{
    public function execute(array $data): TiposContrato
    {
        return TiposContrato::create([
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'] ?? null,
            'id_profesion' => $data['id_profesion'],
            'id_horario' => $data['id_horario'],
            'estado' => true,
        ]);
    }
}