<?php

namespace App\Modules\Profesiones\Actions;

use App\Models\Profesiones;

class CrearProfesionAction
{
    public function execute(array $data): Profesiones
    {
        return Profesiones::create([
            'nombre'      => $data['nombre'],
            'descripcion' => $data['descripcion'] ?? null,
            'estado'      => true,
        ]);
    }
}
