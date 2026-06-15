<?php

namespace App\Modules\Empleados\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearEmpleadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('empleados.crear');
    }

    public function rules(): array
    {
        return [
            // Datos personales
            'nombre'   => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:150', 'unique:empleados,email'],
            'dni_ci'   => ['required', 'string', 'max:20', 'unique:empleados,dni_ci'],
            'telefono' => ['nullable', 'string', 'max:20'],

            // Datos laborales
            'id_departamento' => ['required', 'integer', 'exists:departamentos,id'],
            'id_cargo'        => ['nullable', 'integer', 'exists:cargos,id'],
            'id_profesion'    => ['nullable', 'integer', 'exists:profesiones,id'],
            'tipo_trabajo'    => ['nullable', 'string', 'in:Remoto,Presencial,Híbrido'],
            'fecha_registro'  => ['required', 'date'],
            'descripcion'     => ['nullable', 'string', 'max:500'],
            'foto_url'        => ['nullable', 'url', 'max:255'],

            // Contrato opcional
            'contrato'                    => ['nullable', 'array'],
            'contrato.id_tipo_contrato'   => ['required_with:contrato', 'integer', 'exists:tipos_contrato,id'],
            'contrato.monto_base'         => ['required_with:contrato', 'numeric', 'min:0'],
            'contrato.fecha_inicio'       => ['required_with:contrato', 'date'],
            'contrato.id_tipo_pago'       => ['required_with:contrato', 'integer', 'exists:tipos_pago,id'],
            'contrato.id_frecuencia_pago' => ['required_with:contrato', 'integer', 'exists:frecuencias_pago,id'],
            'contrato.fecha_fin'          => ['nullable', 'date', 'after:contrato.fecha_inicio'],
        ];
    }

    public function messages(): array
    {
        return [
            'dni_ci.unique'          => 'El DNI/Cédula ya está registrado.',
            'email.unique'           => 'El email ya está en uso.',
            'id_departamento.exists' => 'El departamento seleccionado no existe.',
            'id_cargo.exists'        => 'El cargo seleccionado no existe.',
            'id_profesion.exists'    => 'La profesión seleccionada no existe.',
            'tipo_trabajo.in'        => 'El tipo de trabajo debe ser Remoto, Presencial o Híbrido.',
        ];
    }
}
