<?php

namespace App\Modules\Contratos\Profesiones\Actions;

use App\Models\Profesiones;

class CrearProfesionAction
{
    public function __invoke(array $datos): Profesiones
    {
        return Profesiones::create([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'] ?? null,
            'estado' => true,
        ]);
    }
}
