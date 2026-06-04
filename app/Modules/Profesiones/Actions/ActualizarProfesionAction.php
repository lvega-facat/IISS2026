<?php

namespace App\Modules\Profesiones\Actions;

use App\Models\Profesiones;

class ActualizarProfesionAction
{
    public function execute(Profesiones $profesion, array $data): Profesiones
    {
        $profesion->update([
            'nombre'      => $data['nombre'],
            'descripcion' => array_key_exists('descripcion', $data)
                ? $data['descripcion']
                : $profesion->descripcion,
        ]);

        return $profesion->fresh();
    }
}
