<?php

namespace App\Modules\Contratos\HorariosTrabajo\Actions;

use App\Models\HorariosTrabajo;

class EliminarHorarioTrabajoAction
{
    public function execute(
        HorariosTrabajo $horario
    ): HorariosTrabajo {

        $horario->update([
            'estado' => false
        ]);

        return $horario->fresh();
    }
}