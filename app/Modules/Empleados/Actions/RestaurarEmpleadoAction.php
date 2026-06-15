<?php

namespace App\Modules\Empleados\Actions;

use App\Models\AuditoriaLog;
use App\Models\Empleados;

class RestaurarEmpleadoAction
{
    public function execute(Empleados $empleado): Empleados
    {
        $empleado->restore();
        $empleado->update(['estado' => true]);

        AuditoriaLog::create([
            'id_usuario'     => auth()->id(),
            'modulo'         => 'Empleados',
            'accion'         => 'RESTAURAR',
            'valor_anterior' => json_encode(['estado' => false]),
            'valor_nuevo'    => json_encode(['estado' => true, 'deleted_at' => null]),
            'ip_origen'      => request()->ip(),
            'ruta'           => request()->path(),
            'timestamp'      => now(),
        ]);

        return $empleado->fresh();
    }
}
