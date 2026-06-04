<?php

namespace App\Modules\Profesiones\Actions;

use App\Models\Profesiones;

class EliminarProfesionAction
{
    public function execute(Profesiones $profesion): void
    {
        $profesion->update(['estado' => false]);
    }
}
