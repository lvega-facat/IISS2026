<?php

namespace App\Modules\RolesPermisos\Actions;

use App\Models\Modulos;
use App\Models\RolPermiso;
use Illuminate\Database\Eloquent\Collection;

class ObtenerPermisosPorModuloAction
{
	public function handle(?int $roleId = null): Collection
	{
		$permisosAsignados = [];

		if ($roleId) {
			$permisosAsignados = RolPermiso::query()
				->where('id_rol', $roleId)
				->pluck('id_permiso')
				->all();
		}

		return Modulos::query()
			->with('permisos')
			->orderBy('nombre')
			->get()
			->map(function (Modulos $modulo) use ($permisosAsignados) {
				return [
					'id' => $modulo->id,
					'nombre' => $modulo->nombre,
					'slug' => $modulo->slug,
					'permisos' => $modulo->permisos
						->sortBy('accion')
						->values()
						->map(fn ($permiso) => [
							'id' => $permiso->id,
							'accion' => $permiso->accion,
							'asignado' => in_array($permiso->id, $permisosAsignados, true),
						]),
				];
			});
	}
}
