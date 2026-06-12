<?php

namespace App\Modules\RolesPermisos\ViewModels;

use App\Models\Modulos;
use App\Models\RolPermiso;
use App\Models\Roles;
use Illuminate\Http\Request;

class RolesPermisosViewModel
{
    public static function forIndex(Request $request): array
    {
        $query = Roles::query()->orderBy('created_at', 'desc');

        if ($request->filled('nombre')) {
            $query->where('nombre', 'ilike', '%' . $request->nombre . '%');
        }

        if ($request->filled('estado') && $request->estado !== '') {
            $query->where('estado', $request->estado);
        }

        $roles = $query->paginate(5)->withQueryString();

        return compact('roles');
    }

    public static function forCreate(): array
    {
        return [];
    }

    public static function forEdit(Roles $rol): array
    {
        return compact('rol');
    }

    public static function forGestionarPermisos(Roles $rol): array
    {
        $modulos = Modulos::with('permisos')->orderBy('nombre')->get();

        $permisosAsignados = RolPermiso::where('id_rol', $rol->id)
            ->pluck('id_permiso')
            ->all();

        return compact('rol', 'modulos', 'permisosAsignados');
    }
}
