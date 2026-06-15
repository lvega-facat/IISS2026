<?php

namespace App\Modules\Empleados\Actions;

use App\Models\AuditoriaLog;
use App\Models\Empleados;

/**
 * Registra un cambio de cargo, puesto o departamento en el historial de auditoría.
 * Para historial estructurado, se recomienda crear la tabla "historial_cargos_empleados".
 */
class RegistrarCambioCargoAction
{
    public function execute(Empleados $empleado, array $data): Empleados
    {
        $anterior = [
            'id_cargo'        => $empleado->id_cargo,
            'id_departamento' => $empleado->id_departamento,
        ];

        $empleado->update([
            'id_cargo'        => $data['id_cargo'] ?? $empleado->id_cargo,
            'id_departamento' => $data['id_departamento'] ?? $empleado->id_departamento,
            'id_profesion'    => $data['id_profesion'] ?? $empleado->id_profesion,
        ]);

        AuditoriaLog::create([
            'id_usuario'     => auth()->id(),
            'modulo'         => 'Empleados',
            'accion'         => 'CAMBIO_CARGO',
            'valor_anterior' => json_encode($anterior),
            'valor_nuevo'    => json_encode([
                'id_cargo'        => $empleado->id_cargo,
                'id_departamento' => $empleado->id_departamento,
                'motivo'          => $data['motivo'] ?? null,
            ]),
            'ip_origen'  => request()->ip(),
            'ruta'       => request()->path(),
            'timestamp'  => now(),
        ]);

        return $empleado->fresh();
    }
}
