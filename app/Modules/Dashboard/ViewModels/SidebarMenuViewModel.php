<?php

namespace App\Modules\Dashboard\ViewModels;

use Illuminate\Support\Facades\Auth;

class SidebarMenuViewModel
{
    public function menu(): array
    {
        $usuario = Auth::user();

        if (!$usuario) {
            return [];
        }

        $usuario->loadMissing([
            'rol.permisos.modulo'
        ]);

        $rol = $usuario->rol;

        if (!$rol) {
            return [];
        }

        return $rol->permisos
            ->filter(fn ($permiso) => $permiso->modulo !== null)
            ->map(fn ($permiso) => $permiso->modulo)
            ->unique('id')
            ->values()
            ->map(fn ($modulo) => [
                'nombre' => $modulo->nombre,
                'slug'   => $modulo->slug,
                'ruta'   => $modulo->ruta,
            ])
            ->toArray();
    }
}