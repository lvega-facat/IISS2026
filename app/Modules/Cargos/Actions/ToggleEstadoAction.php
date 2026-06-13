<?php

namespace App\Modules\Cargos\Actions;

use App\Models\Cargos;

class ToggleEstadoAction
{
    public function activar(Cargos $cargo): void
    {
        $cargo->estado = true;
        $cargo->save();
    }

    public function desactivar(Cargos $cargo): void
    {
        $cargo->estado = false;
        $cargo->save();
    }
}
