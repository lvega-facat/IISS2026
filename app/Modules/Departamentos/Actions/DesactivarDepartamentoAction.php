<?php

namespace App\Modules\Departamentos\Actions;

use App\Models\Departamentos;

class DesactivarDepartamentoAction
{
    public function execute(Departamentos $departamento): void
    {
        $departamento->estado = false;
        $departamento->save();
    }
}
