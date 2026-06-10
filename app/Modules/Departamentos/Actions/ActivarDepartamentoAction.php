<?php

namespace App\Modules\Departamentos\Actions;

use App\Models\Departamentos;

class ActivarDepartamentoAction
{
    public function execute(Departamentos $departamento): void
    {
        $departamento->estado = true;
        $departamento->save();
    }
}
