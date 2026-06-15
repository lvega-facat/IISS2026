<?php

namespace App\Modules\RolesPermisos\Actions;

use App\Models\AuditoriaLog;
use App\Models\CambiosPermisos;
use App\Models\Permisos;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CrearRolAction
{
	public function handle(array $data, array $context = []): Roles
	{
		$validated = Validator::make($data, [
			'nombre' => ['required', 'string', 'max:100', Rule::unique('roles', 'nombre')],
			'descripcion' => ['nullable', 'string'],
			'estado' => ['nullable', 'boolean'],
			'permisos' => ['nullable', 'array'],
			'permisos.*' => ['integer', 'exists:permisos,id'],
		])->validate();

		return DB::transaction(function () use ($validated, $context) {
			$role = Roles::create([
				'nombre' => $validated['nombre'],
				'descripcion' => $validated['descripcion'] ?? null,
				'estado' => $validated['estado'] ?? true,
			]);

			$permisosIds = array_values(array_unique(array_map('intval', $validated['permisos'] ?? [])));

			if (!empty($permisosIds)) {
				DB::table('rol_permiso')->insert(
					array_map(fn ($id) => ['id_rol' => $role->id, 'id_permiso' => $id], $permisosIds)
				);

				if ($context['id_usuario'] ?? null) {
					$permisos = Permisos::query()->whereIn('id', $permisosIds)->get();
					CambiosPermisos::query()->insert(
						$permisos->map(fn ($p) => [
							'id_usuario' => $context['id_usuario'],
							'id_rol' => $role->id,
							'id_modulo' => $p->id_modulo,
							'accion' => 'asignado:' . $p->accion,
							'timestamp' => now(),
						])->all()
					);
				}
			}

			$this->registrarAuditoria(
				$context,
				'crear',
				null,
				$role->toArray(),
			);

			return $role->fresh();
		});
	}

	private function registrarAuditoria(array $context, string $accion, ?array $valorAnterior, ?array $valorNuevo): void
	{
		AuditoriaLog::create([
			'id_usuario' => $context['id_usuario'] ?? null,
			'modulo' => 'roles',
			'accion' => $accion,
			'valor_anterior' => $valorAnterior ? json_encode($valorAnterior) : null,
			'valor_nuevo' => $valorNuevo ? json_encode($valorNuevo) : null,
			'ip_origen' => $context['ip_origen'] ?? null,
			'ruta' => $context['ruta'] ?? null,
			'timestamp' => now(),
		]);
	}
}
