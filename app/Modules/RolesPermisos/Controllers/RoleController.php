<?php

namespace App\Modules\RolesPermisos\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Modules\RolesPermisos\Actions\ActualizarRolAction;
use App\Modules\RolesPermisos\Actions\AsignarPermisosRolAction;
use App\Modules\RolesPermisos\Actions\CrearRolAction;
use App\Modules\RolesPermisos\Actions\EliminarRolAction;
use App\Modules\RolesPermisos\ViewModels\RolesPermisosViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function __construct(
        private readonly CrearRolAction $crearRolAction,
        private readonly ActualizarRolAction $actualizarRolAction,
        private readonly EliminarRolAction $eliminarRolAction,
        private readonly AsignarPermisosRolAction $asignarPermisosRolAction,
    ) {
    }

	public function index(Request $request): View
	{
		return view('Modules.RolesPermisos.index', RolesPermisosViewModel::forIndex($request));
	}
	public function create(): View
	{
		return view('Modules.RolesPermisos.form', RolesPermisosViewModel::forCreate());
	}

	public function edit(int $id): View
	{
		$rol = Roles::findOrFail($id);

		return view('Modules.RolesPermisos.form', RolesPermisosViewModel::forEdit($rol));
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

    public function gestionarPermisos(int $id): View
    {
        $rol = Roles::findOrFail($id);

        return view('Modules.RolesPermisos.gestionarPrivilegio', RolesPermisosViewModel::forGestionarPermisos($rol));
    }

	public function asignarPermisos(Request $request, int $id): RedirectResponse
	{
		try {
			$this->asignarPermisosRolAction->handle(
				$id,
				array_map('intval', $request->input('permisos', [])),
				$this->buildContext($request),
			);

			return redirect()->route('roles.index')->with('success', 'Permisos guardados exitosamente.');
		} catch (\Throwable $e) {
			return redirect()->back()->with('error', 'No se pudieron guardar los permisos: ' . $e->getMessage());
		}
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
