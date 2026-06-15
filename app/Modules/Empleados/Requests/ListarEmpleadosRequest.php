<?php

namespace App\Modules\Empleados\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListarEmpleadosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('empleados.ver');
    }

    public function rules(): array
    {
        return [
            'busqueda'        => ['nullable', 'string', 'max:100'],
            'id_departamento' => ['nullable', 'integer', 'exists:departamentos,id'],
            'id_cargo'        => ['nullable', 'integer', 'exists:cargos,id'],
            'tipo_trabajo'    => ['nullable', 'string', 'in:Remoto,Presencial,Híbrido'],
            'estado'          => ['nullable', 'boolean'],
            'con_baja'        => ['nullable', 'boolean'],
            'por_pagina'      => ['nullable', 'integer', 'min:5', 'max:100'],
        ];
    }
}
