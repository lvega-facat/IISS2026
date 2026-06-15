<?php

namespace App\Modules\Empleados\Actions;

use App\Models\Empleados;

class ExportarFichaEmpleadosPDFAction
{
    public function execute(Empleados $empleado): array
    {
        $empleado->load([
            'departamentos',
            'cargos',
            'profesiones',
            'contratos' => fn($q) => $q->where('estado', true)->with([
                'tipos_contrato',
                'tipos_pago',
                'frecuencias_pago',
            ]),
        ]);

        return [
            'empleado'   => $empleado,
            'contrato'   => $empleado->contratos->first(),
            'generado_en' => now()->format('d/m/Y H:i'),
        ];
    }
}
