<?php

namespace App\Modules\Departamentos\Actions;

use App\Models\Departamentos;

class CrearDepartamentoAction
{
    public function execute(array $data): Departamentos
    {
        return Departamentos::create([
            'id_organizacion'=> $data['id_organizacion'],
            'nombre'=> $data['nombre'],
            'codigo'=> $data['codigo'],
            'funcion_principal'=> $data['funcion_principal'],
            'descripcion'=> $data['descripcion'] ?? null,
            'estado'=> true,
        ]);
    }
}
