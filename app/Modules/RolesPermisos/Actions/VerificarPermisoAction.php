<?php

namespace App\Modules\RolesPermisos\Actions;

class VerificarPermisoAction
{
    public function execute(
        array $permisosUsuario,
        string $permisoRequerido
    ): bool {

        return in_array(
            strtolower($permisoRequerido),
            $permisosUsuario
        );
    }
}
