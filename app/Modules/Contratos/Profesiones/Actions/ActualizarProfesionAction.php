<?php

namespace App\Modules\Contratos\Profesiones\Actions;

use App\Models\Profesiones;

class ActualizarProfesionAction
{
    public function __invoke(Profesiones $profesion, array $datos): Profesiones
    {
        $profesion->update([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'] ?? null,
            'estado' => $datos['estado'],
        ]);

        return $profesion;
    }
}
