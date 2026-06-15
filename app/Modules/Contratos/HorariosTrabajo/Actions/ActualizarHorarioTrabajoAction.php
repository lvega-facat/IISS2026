<?php

namespace App\Modules\Contratos\HorariosTrabajo\Actions;

use App\Models\HorariosTrabajo;

class ActualizarHorarioTrabajoAction
{
    public function execute(
        HorariosTrabajo $horario,
        array $data
    ): HorariosTrabajo {

        $horario->update([
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'] ?? null,
            'tipo_jornada' => $data['tipo_jornada'],
            'hora_entrada' => $data['hora_entrada'],
            'hora_salida' => $data['hora_salida'],
            'horas_diarias' => $data['horas_diarias'],
            'horas_semanales' => $data['horas_semanales'],
            'tolerancia_minutos' => $data['tolerancia_minutos'] ?? 0,
        ]);

        return $horario->fresh();
    }
}