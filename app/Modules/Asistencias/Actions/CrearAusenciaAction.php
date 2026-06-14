<?php

namespace App\Modules\Asistencias\Actions;

use App\Models\Asistencias;

class CrearAusenciaAction
{
    public function execute(array $data): Asistencias
    {
        return Asistencias::create($data);
    }
}