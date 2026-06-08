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
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
	public function __construct(
		private readonly CrearRolAction $crearRolAction,
		private readonly ActualizarRolAction $actualizarRolAction,
		private readonly EliminarRolAction $eliminarRolAction,
		private readonly AsignarPermisosRolAction $asignarPermisosRolAction,
	) {
	}

	public function index(): View
	{
		return view('Modules.RolesPermisos.index');
	}
	public function create(): View
	{
		return view('Modules.RolesPermisos.form');
	}
	public function edit(int $id): View
	{
		return view('Modules.RolesPermisos.form');
	}
	public function store(Request $request): RedirectResponse
	{
		$role = $this->crearRolAction->handle($request->all(), $this->buildContext($request));

		return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
	}

	public function update(Request $request, int $id): RedirectResponse
	{
		$role = $this->actualizarRolAction->handle($id, $request->all(), $this->buildContext($request));

		return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
	}

	public function destroy(Request $request, int $id): RedirectResponse
	{
		$result = $this->eliminarRolAction->handle($id, $this->buildContext($request));

		return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
	}


	public function asignarPermisos(Request $request, int $id): RedirectResponse
	{
		$result = $this->asignarPermisosRolAction->handle(
			$id,
			$request->input('permisos', []),
			$this->buildContext($request),
		);

		return redirect()->route('roles.index')->with('success', 'Permisos asignados exitosamente.');
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
