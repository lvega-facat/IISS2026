<?php

namespace App\Modules\Justificativos\Actions;

use App\Models\Justificativos;

class CrearJustificativoAction
{
    public function execute(array $data): Justificativos
    {
        return Justificativos::create($data);
    }
}