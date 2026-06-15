<?php

namespace App\Modules\Departamentos\Actions;

use App\Models\Departamentos;

class ActualizarDepartamentoAction
{
    public function execute(Departamentos $departamento, array $data): Departamentos 
    {
        $departamento->update([
            'nombre'=> $data['nombre'],
            'codigo'=> $data['codigo'],
            'funcion_principal'=> $data['funcion_principal'],
            'descripcion'=> $data['descripcion'] ?? null,
        ]);

        return $departamento->fresh();
    }
}
