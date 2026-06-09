<?php

namespace Modules\RolesPermisos\ViewModels;

use App\Models\Modulos;
use App\Models\Roles;

class RolePermissionViewModel
{
    //Obtener todos los módulos con sus permisos (EAGER LOADING)

    public function modulos()
    {
        return Modulos::with('permisos')->get();
    }

    //Obtener todos los permisos del sistema
    public function permisos()
    {
        return Modulos::with('permisos')
            ->get()
            ->pluck('permisos')
            ->flatten();
    }

    //Permisos agrupados por módulo (estructura base)
    public function permisosPorModulo()
    {
        return Modulos::with('permisos')->get();
    }

    //IDs de permisos asignados a un rol
    public function permisosRol(int $rolId): array
    {
        $rol = Roles::with('permisos')->findOrFail($rolId);

        return $rol->permisos->pluck('id')->toArray();
    }

    //Estructura lista para checkboxes en Blade

    public function estructuraPermisos(int $rolId = null): array
    {
        $permisosAsignados = $rolId
            ? $this->permisosRol($rolId)
            : [];

        return Modulos::with('permisos')->get()->map(function ($modulo) use ($permisosAsignados) {

            return [
                'id' => $modulo->id,
                'nombre' => $modulo->nombre,
                'slug' => $modulo->slug,
                'permisos' => $modulo->permisos->map(function ($permiso) use ($permisosAsignados) {

                    return [
                        'id' => $permiso->id,
                        'accion' => $permiso->accion,
                        'seleccionado' => in_array($permiso->id, $permisosAsignados),
                    ];
                })->toArray()
            ];
        })->toArray();
    }

    ///Vista final para Blade o Controller
    public function toArray(int $rolId = null): array
    {
        return $this->estructuraPermisos($rolId);
    }
}