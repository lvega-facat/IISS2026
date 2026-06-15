<?php

namespace App\Modules\Empleados\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActualizarEmpleadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('empleados.editar');
    }

    public function rules(): array
    {
        $id = $this->route('empleado');

        return [
            'nombre'          => ['required', 'string', 'max:100'],
            'apellido'        => ['required', 'string', 'max:100'],
            'email'           => ['required', 'email', 'max:150', Rule::unique('empleados', 'email')->ignore($id)],
            'telefono'        => ['nullable', 'string', 'max:20'],
            'id_departamento' => ['required', 'integer', 'exists:departamentos,id'],
            'id_cargo'        => ['nullable', 'integer', 'exists:cargos,id'],
            'id_profesion'    => ['nullable', 'integer', 'exists:profesiones,id'],
            'tipo_trabajo'    => ['nullable', 'string', 'in:Remoto,Presencial,Híbrido'],
            'descripcion'     => ['nullable', 'string', 'max:500'],
            'foto_url'        => ['nullable', 'url', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique'           => 'El email ya está en uso por otro empleado.',
            'id_departamento.exists' => 'El departamento seleccionado no existe.',
            'id_cargo.exists'        => 'El cargo seleccionado no existe.',
            'id_profesion.exists'    => 'La profesión seleccionada no existe.',
            'tipo_trabajo.in'        => 'El tipo de trabajo debe ser Remoto, Presencial o Híbrido.',
        ];
    }
}
