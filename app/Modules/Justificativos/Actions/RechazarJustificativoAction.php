<?php

namespace App\Modules\Justificativos\Actions;

use Carbon\Carbon;
use App\Models\Justificativos;

class RechazarJustificativoAction
{
    public function execute(
        Justificativos $justificativo,
        int $idAprobador
    ): Justificativos {

        $justificativo->update([
            'estado_aprobacion' => 'rechazado',
            'id_aprobador' => $idAprobador,
            'fecha_aprobacion' => Carbon::now()
        ]);

        return $justificativo->fresh();
    }
}