<?php

namespace App\Modules\Departamentos\Actions;

use App\Models\Departamentos;
use App\Models\DepartamentoDependiente;

class CrearDepartamentoAction
{
    public function execute(array $data): Departamentos
    {
        $departamento = Departamentos::create([
            'id_organizacion'   => $data['id_organizacion'],
            'nombre'            => $data['nombre'],
            'codigo'            => $data['codigo'],
            'funcion_principal' => $data['funcion_principal'],
            'descripcion'       => $data['descripcion'] ?? null,
            'estado'            => true,
        ]);

        if (!empty($data['id_departamento_padre'])) {
            DepartamentoDependiente::create([
                'id_departamento_padre' => $data['id_departamento_padre'],
                'id_departamento_hijo'  => $departamento->id,
                'tipo_dependencia'      => $data['tipo_dependencia'] ?? 'jerarquica',
            ]);
        }

        return $departamento;
    }
}
