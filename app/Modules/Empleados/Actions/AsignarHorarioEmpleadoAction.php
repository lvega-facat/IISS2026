<?php

namespace App\Modules\Empleados\Actions;

use App\Models\AuditoriaLog;
use App\Models\Contratos;
use App\Models\Empleados;

/**
 * Asigna un horario de trabajo al empleado actualizando el tipo de contrato activo.
 * El horario se gestiona a través de la relación TiposContrato → HorariosTrabajo.
 */
class AsignarHorarioEmpleadoAction
{
    public function execute(Empleados $empleado, int $idTipoContrato): Contratos
    {
        $contrato = $empleado->contratos()
            ->where('estado', true)
            ->firstOrFail();

        $anterior = ['id_tipo_contrato' => $contrato->id_tipo_contrato];

        $contrato->update(['id_tipo_contrato' => $idTipoContrato]);

        AuditoriaLog::create([
            'id_usuario'     => auth()->id(),
            'modulo'         => 'Empleados',
            'accion'         => 'ASIGNAR_HORARIO',
            'valor_anterior' => json_encode($anterior),
            'valor_nuevo'    => json_encode(['id_tipo_contrato' => $idTipoContrato]),
            'ip_origen'      => request()->ip(),
            'ruta'           => request()->path(),
            'timestamp'      => now(),
        ]);

        return $contrato->fresh();
    }
}
