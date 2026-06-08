<?php

namespace App\Modules\Usuarios\Actions;

use App\Models\Usuarios;

class SoftELiminarUsuarioAction
{
    public function execute(Usuarios $usuario): bool
    {
        $usuario->estado = false; // Marcar como inactivo
        return $usuario->save(); // Guardar cambios
    }
}