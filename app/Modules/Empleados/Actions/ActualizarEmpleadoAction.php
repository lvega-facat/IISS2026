<?php

namespace App\Modules\Empleados\Actions;

use App\Models\AuditoriaLog;
use App\Models\Empleados;

class ActualizarEmpleadoAction
{
    public function execute(Empleados $empleado, array $data): Empleados
    {
        $anterior = $empleado->toArray();

        $empleado->update([
            'id_departamento' => $data['id_departamento'] ?? $empleado->id_departamento,
            'id_cargo'        => array_key_exists('id_cargo', $data) ? $data['id_cargo'] : $empleado->id_cargo,
            'id_profesion'    => array_key_exists('id_profesion', $data) ? $data['id_profesion'] : $empleado->id_profesion,
            'nombre'          => $data['nombre'] ?? $empleado->nombre,
            'apellido'        => $data['apellido'] ?? $empleado->apellido,
            'email'           => $data['email'] ?? $empleado->email,
            'telefono'        => $data['telefono'] ?? $empleado->telefono,
            'tipo_trabajo'    => $data['tipo_trabajo'] ?? $empleado->tipo_trabajo,
            'descripcion'     => $data['descripcion'] ?? $empleado->descripcion,
            'foto_url'        => $data['foto_url'] ?? $empleado->foto_url,
        ]);

        AuditoriaLog::create([
            'id_usuario'     => auth()->id(),
            'modulo'         => 'Empleados',
            'accion'         => 'ACTUALIZAR',
            'valor_anterior' => json_encode($anterior),
            'valor_nuevo'    => json_encode($empleado->fresh()->toArray()),
            'ip_origen'      => request()->ip(),
            'ruta'           => request()->path(),
            'timestamp'      => now(),
        ]);

        return $empleado->fresh();
    }
}
