<?php

namespace App\Modules\Empleados\Actions;

use App\Models\AuditoriaLog;
use App\Models\Empleados;

class DarBajaEmpleadoAction
{
    public function execute(Empleados $empleado): void
    {
        $anterior = $empleado->toArray();

        // Marcar como inactivo y aplicar soft delete
        $empleado->update(['estado' => false]);
        $empleado->delete();

        AuditoriaLog::create([
            'id_usuario'     => auth()->id(),
            'modulo'         => 'Empleados',
            'accion'         => 'BAJA',
            'valor_anterior' => json_encode($anterior),
            'valor_nuevo'    => json_encode(['estado' => false, 'deleted_at' => now()]),
            'ip_origen'      => request()->ip(),
            'ruta'           => request()->path(),
            'timestamp'      => now(),
        ]);
    }
}
