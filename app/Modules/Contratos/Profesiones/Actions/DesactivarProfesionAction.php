<?php

namespace App\Modules\Contratos\Profesiones\Actions;

use App\Models\Profesiones;

class DesactivarProfesionAction
{
    public function __invoke(Profesiones $profesion): void
    {
        $profesion->update(['estado' => false]);
    }
}
