<?php

namespace App\Modules\Cargos\Actions;

use App\Models\Cargos;

class CrearCargosAction
{
    public function execute(array $data): Cargos
    {
        return Cargos::create([
            'id_departamento' => $data['id_departamento'],
            'id_cargo_padre' => $data['id_cargo_padre'] ?? null,
            'nombre' => $data['nombre'],
            'estado' => true,
        ]);
    }
}
