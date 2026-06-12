<?php

namespace App\Modules\RolesPermisos\Actions;

use App\Models\AuditoriaLog;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;

class EliminarRolAction
{
	public function handle(int $id, array $context = []): array
	{
		$role = Roles::query()->findOrFail($id);

		return DB::transaction(function () use ($role, $context) {
			$before = $role->toArray();
			$accion = 'eliminar';
			$resultado = ['eliminado' => false, 'desactivado' => true];

			$role->estado = false;
			$role->save();

			$this->registrarAuditoria(
				$context,
				$accion,
				$before,
				$role->toArray(),
			);

			return $resultado;
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
