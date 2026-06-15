<?php

namespace App\Modules\Empleados\Actions;

use App\Models\AuditoriaLog;
use App\Models\Empleados;

class CrearEmpleadoAction
{
    public function execute(array $data): Empleados
    {
        $empleado = Empleados::create([
            'id_departamento' => $data['id_departamento'],
            'id_cargo'        => $data['id_cargo'] ?? null,
            'id_profesion'    => $data['id_profesion'] ?? null,
            'nombre'          => $data['nombre'],
            'apellido'        => $data['apellido'],
            'email'           => $data['email'],
            'dni_ci'          => $data['dni_ci'],
            'telefono'        => $data['telefono'] ?? null,
            'tipo_trabajo'    => $data['tipo_trabajo'] ?? null,
            'fecha_registro'  => $data['fecha_registro'],
            'descripcion'     => $data['descripcion'] ?? null,
            'foto_url'        => $data['foto_url'] ?? null,
            'estado'          => true,
        ]);

        AuditoriaLog::create([
            'id_usuario'     => auth()->id(),
            'modulo'         => 'Empleados',
            'accion'         => 'CREAR',
            'valor_anterior' => null,
            'valor_nuevo'    => json_encode($empleado->toArray()),
            'ip_origen'      => request()->ip(),
            'ruta'           => request()->path(),
            'timestamp'      => now(),
        ]);

        return $empleado;
    }
}
