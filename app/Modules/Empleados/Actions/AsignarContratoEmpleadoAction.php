<?php

namespace App\Modules\Empleados\Actions;

use App\Models\AuditoriaLog;
use App\Models\Contratos;
use App\Models\Empleados;

class AsignarContratoEmpleadoAction
{
    public function execute(Empleados $empleado, array $data): Contratos
    {
        // Finalizar contrato activo si existe
        $empleado->contratos()
            ->where('estado', true)
            ->update(['estado' => false]);

        $contrato = Contratos::create([
            'id_empleado'        => $empleado->id,
            'id_tipo_contrato'   => $data['id_tipo_contrato'],
            'monto_base'         => $data['monto_base'],
            'fecha_inicio'       => $data['fecha_inicio'],
            'id_tipo_pago'       => $data['id_tipo_pago'],
            'id_frecuencia_pago' => $data['id_frecuencia_pago'],
            'fecha_fin'          => $data['fecha_fin'] ?? null,
            'estado'             => true,
        ]);

        AuditoriaLog::create([
            'id_usuario'     => auth()->id(),
            'modulo'         => 'Empleados',
            'accion'         => 'ASIGNAR_CONTRATO',
            'valor_anterior' => null,
            'valor_nuevo'    => json_encode($contrato->toArray()),
            'ip_origen'      => request()->ip(),
            'ruta'           => request()->path(),
            'timestamp'      => now(),
        ]);

        return $contrato;
    }
}
