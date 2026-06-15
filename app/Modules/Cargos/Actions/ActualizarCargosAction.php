<?php

namespace App\Modules\Cargos\Actions;

use App\Models\Cargos;

class ActualizarCargosAction
{
    public function execute(Cargos $cargo, array $data): Cargos
    {
        $cargo->update([
            'id_departamento' => $data['id_departamento'],
            'id_cargo_padre' => $data['id_cargo_padre'] ?? null,
            'nombre' => $data['nombre'],
        ]);

        return $cargo->fresh();
    }
}
