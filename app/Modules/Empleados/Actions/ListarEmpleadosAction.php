<?php

namespace App\Modules\Empleados\Actions;

use App\Models\Empleados;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListarEmpleadosAction
{
    public function execute(array $filtros = []): LengthAwarePaginator
    {
        $query = Empleados::with(['departamentos', 'cargos', 'profesiones'])
            ->withCount(['contratos' => fn($q) => $q->where('estado', true)]);

        if (!empty($filtros['busqueda'])) {
            $busqueda = $filtros['busqueda'];
            $query->where(function ($q) use ($busqueda) {
                $q->where('nombre', 'ilike', "%{$busqueda}%")
                  ->orWhere('apellido', 'ilike', "%{$busqueda}%")
                  ->orWhere('dni_ci', 'ilike', "%{$busqueda}%");
            });
        }

        if (!empty($filtros['id_departamento'])) {
            $query->where('id_departamento', $filtros['id_departamento']);
        }

        if (!empty($filtros['id_cargo'])) {
            $query->where('id_cargo', $filtros['id_cargo']);
        }

        if (!empty($filtros['tipo_trabajo'])) {
            $query->where('tipo_trabajo', $filtros['tipo_trabajo']);
        }

        if (isset($filtros['estado'])) {
            $query->where('estado', $filtros['estado']);
        }

        if (!empty($filtros['con_baja'])) {
            $query->withTrashed();
        }

        $perPage = $filtros['por_pagina'] ?? 15;

        return $query->orderBy('apellido')->orderBy('nombre')->paginate($perPage);
    }
}
