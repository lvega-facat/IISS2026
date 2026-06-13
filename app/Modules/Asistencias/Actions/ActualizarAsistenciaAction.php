<?php

namespace App\Modules\Asistencias\Actions;

use App\Models\Asistencias;

class ActualizarAsistenciaAction
{
    public function execute(
        Asistencias $asistencia,
        array $data
    ): Asistencias {

        $asistencia->update($data);

        return $asistencia->fresh();
    }
}