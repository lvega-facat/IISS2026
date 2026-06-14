<?php

namespace App\Modules\Justificativos\Actions;

use App\Models\Justificativos;

class ActualizarJustificativoAction
{
    public function execute(
        Justificativos $justificativo,
        array $data
    ): Justificativos {

        $justificativo->update($data);

        return $justificativo->fresh();
    }
}