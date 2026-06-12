<?php

namespace App\Modules\RolesPermisos\Actions;

use App\Models\AuditoriaLog;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ActualizarRolAction
{
	public function handle(int $id, array $data, array $context = []): Roles
	{
		$role = Roles::query()->findOrFail($id);
		$validated = Validator::make($data, [
			'nombre' => ['required', 'string', 'max:100', Rule::unique('roles', 'nombre')->ignore($role->id)],
			'descripcion' => ['nullable', 'string'],
			'estado' => ['nullable', 'boolean'],
		])->validate();

		return DB::transaction(function () use ($role, $validated, $context) {
			$before = $role->toArray();

			$role->fill([
				'nombre' => $validated['nombre'],
				'descripcion' => $validated['descripcion'] ?? null,
				'estado' => $validated['estado'] ?? $role->estado,
			]);
			$role->save();

			$this->registrarAuditoria(
				$context,
				'actualizar',
				$before,
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
