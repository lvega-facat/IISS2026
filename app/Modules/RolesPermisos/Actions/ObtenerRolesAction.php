<?php

namespace App\Modules\RolesPermisos\Actions;

use App\Models\Roles;
use Illuminate\Database\Eloquent\Collection;

class ObtenerRolesAction
{
	public function handle(?int $id = null): array|Collection
	{
		if ($id === null) {
			return Roles::query()
				->orderBy('id')
				->get();
		}

		$role = Roles::query()
			->with(['rol_permisos.permisos.modulos'])
			->findOrFail($id);

		$permisosPorModulo = [];

		foreach ($role->rol_permisos as $rolPermiso) {
			$permiso = $rolPermiso->permisos;
			if (!$permiso || !$permiso->modulos) {
				continue;
			}

			$modulo = $permiso->modulos;
			$permisosPorModulo[$modulo->id]['modulo'] = [
				'id' => $modulo->id,
				'nombre' => $modulo->nombre,
				'slug' => $modulo->slug,
			];
			$permisosPorModulo[$modulo->id]['permisos'][] = [
				'id' => $permiso->id,
				'accion' => $permiso->accion,
			];
		}

		return [
			'rol' => $role,
			'permisos_por_modulo' => array_values($permisosPorModulo),
		];
	}
}
