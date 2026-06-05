<?php

namespace App\Modules\RolesPermisos\Actions;

use App\Models\Usuarios;
use Illuminate\Support\Facades\Cache;

class ObtenerPermisosUsuarioAction
{
    public function execute(int $usuarioId): array
    {
    return Cache::remember(
        "usuario:{$usuarioId}:permisos",
        now()->addHours(12),
        function () use ($usuarioId) {

            $usuario = Usuarios::with([
                'roles.rol_permisos.permisos.modulos'
            ])->findOrFail($usuarioId);

            return $usuario->roles
                ->rol_permisos
                ->map(fn ($rolPermiso) =>
                    strtolower(
                        $rolPermiso->permisos->modulos->slug .
                        '.' .
                        $rolPermiso->permisos->accion
                    )
                )
                ->toArray();
    }
);
    }
}
