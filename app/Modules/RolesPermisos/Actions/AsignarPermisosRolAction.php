<?php

namespace App\Modules\RolesPermisos\Actions;

use App\Models\AuditoriaLog;
use App\Models\CambiosPermisos;
use App\Models\Permisos;
use App\Models\RolPermiso;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AsignarPermisosRolAction
{
	public function handle(int $roleId, array $permisosIds, array $context = []): array
	{
		$validator = Validator::make([
			'id_rol' => $roleId,
			'permisos' => $permisosIds,
			'id_usuario' => $context['id_usuario'] ?? null,
		], [
			'id_rol' => ['required', 'integer', 'exists:roles,id'],
			'permisos' => ['array'],
			'permisos.*' => ['integer', 'distinct', 'exists:permisos,id'],
			'id_usuario' => ['required', 'integer', 'exists:usuarios,id'],
		]);

		$validator->validate();

		$permisosIds = array_values(array_unique(array_map('intval', $permisosIds)));

		return DB::transaction(function () use ($roleId, $permisosIds, $context) {
			$role = Roles::query()->findOrFail($roleId);

			$permisos = Permisos::query()
				->with('modulos')
				->whereIn('id', $permisosIds)
				->get();

			$currentIds = RolPermiso::query()
				->where('id_rol', $roleId)
				->pluck('id_permiso')
				->all();

			$toAttach = array_values(array_diff($permisosIds, $currentIds));
			$toDetach = array_values(array_diff($currentIds, $permisosIds));

			if (!empty($toAttach)) {
				$insertRows = array_map(fn ($permisoId) => [
					'id_rol' => $roleId,
					'id_permiso' => $permisoId,
				], $toAttach);
				RolPermiso::query()->insert($insertRows);
			}

			if (!empty($toDetach)) {
				RolPermiso::query()
					->where('id_rol', $roleId)
					->whereIn('id_permiso', $toDetach)
					->delete();
			}

			$cambios = [];
			$permisoPorId = $permisos->keyBy('id');

			foreach ($toAttach as $permisoId) {
				$permiso = $permisoPorId->get($permisoId);
				$cambios[] = $this->crearCambioPermiso($context, $roleId, $permiso, 'asignado');
			}

			if (!empty($toDetach)) {
				$detached = Permisos::query()->with('modulos')->whereIn('id', $toDetach)->get();
				foreach ($detached as $permiso) {
					$cambios[] = $this->crearCambioPermiso($context, $roleId, $permiso, 'revocado');
				}
			}

			if (!empty($cambios)) {
				CambiosPermisos::query()->insert($cambios);
			}

			$this->registrarAuditoria(
				$context,
				$role,
				$currentIds,
				$permisosIds,
			);

			return [
				'role_id' => $roleId,
				'permisos_asignados' => $permisosIds,
				'agregados' => $toAttach,
				'removidos' => $toDetach,
			];
		});
	}

	private function crearCambioPermiso(array $context, int $roleId, Permisos $permiso, string $tipo): array
	{
		return [
			'id_usuario' => $context['id_usuario'],
			'id_rol' => $roleId,
			'id_modulo' => $permiso->id_modulo,
			'accion' => sprintf('%s:%s', $tipo, $permiso->accion),
			'timestamp' => now(),
		];
	}

	private function registrarAuditoria(array $context, Roles $role, array $antes, array $despues): void
	{
		AuditoriaLog::create([
			'id_usuario' => $context['id_usuario'] ?? null,
			'modulo' => 'roles_permisos',
			'accion' => 'asignar_permisos',
			'valor_anterior' => json_encode(['role_id' => $role->id, 'permisos' => $antes]),
			'valor_nuevo' => json_encode(['role_id' => $role->id, 'permisos' => $despues]),
			'ip_origen' => $context['ip_origen'] ?? null,
			'ruta' => $context['ruta'] ?? null,
			'timestamp' => now(),
		]);
	}
}
