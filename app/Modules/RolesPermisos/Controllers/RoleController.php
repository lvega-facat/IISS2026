<?php

namespace App\Modules\RolesPermisos\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\RolesPermisos\Actions\ActualizarRolAction;
use App\Modules\RolesPermisos\Actions\AsignarPermisosRolAction;
use App\Modules\RolesPermisos\Actions\CrearRolAction;
use App\Modules\RolesPermisos\Actions\EliminarRolAction;
use App\Modules\RolesPermisos\Actions\ObtenerPermisosPorModuloAction;
use App\Modules\RolesPermisos\Actions\ObtenerRolesAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
	public function __construct(
		private readonly CrearRolAction $crearRolAction,
		private readonly ActualizarRolAction $actualizarRolAction,
		private readonly EliminarRolAction $eliminarRolAction,
		private readonly ObtenerRolesAction $obtenerRolesAction,
		private readonly AsignarPermisosRolAction $asignarPermisosRolAction,
		private readonly ObtenerPermisosPorModuloAction $obtenerPermisosPorModuloAction,
	) {
	}

	public function index(): JsonResponse
	{
		return response()->json($this->obtenerRolesAction->handle());
	}

	public function show(int $id): JsonResponse
	{
		return response()->json($this->obtenerRolesAction->handle($id));
	}

	public function store(Request $request): JsonResponse
	{
		$role = $this->crearRolAction->handle($request->all(), $this->buildContext($request));

		return response()->json($role, 201);
	}

	public function update(Request $request, int $id): JsonResponse
	{
		$role = $this->actualizarRolAction->handle($id, $request->all(), $this->buildContext($request));

		return response()->json($role);
	}

	public function destroy(Request $request, int $id): JsonResponse
	{
		$result = $this->eliminarRolAction->handle($id, $this->buildContext($request));

		return response()->json($result);
	}

	public function permisosPorModulo(Request $request): JsonResponse
	{
		$roleId = $request->query('id_rol');
		$roleId = $roleId !== null ? (int) $roleId : null;

		return response()->json($this->obtenerPermisosPorModuloAction->handle($roleId));
	}

	public function asignarPermisos(Request $request, int $id): JsonResponse
	{
		$result = $this->asignarPermisosRolAction->handle(
			$id,
			$request->input('permisos', []),
			$this->buildContext($request),
		);

		return response()->json($result);
	}

	private function buildContext(Request $request): array
	{
		$user = $request->user();

		return [
			'id_usuario' => $user?->id ?? $request->input('id_usuario'),
			'ip_origen' => $request->ip(),
			'ruta' => $request->path(),
		];
	}
}
