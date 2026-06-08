<?php

namespace App\Modules\Usuarios\Actions;

use App\Models\Usuarios;

class ActivarUsuario
{
    public function execute(int $userId): Bool
    {
        $usuario = Usuarios::findOrFail($userId);
        $usuario->estado = true; // Marcar como activo
        return $usuario->save(); // Guardar cambioss
    }
}