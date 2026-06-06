<?php

namespace App\Modules\RolesPermisos\Middleware;

// closure es un tipo de dato que representa una función anónima, es decir, una función sin nombre que se puede asignar a una variable o pasar como argumento a otra función. En el contexto de Laravel, se utiliza para definir la lógica que se ejecutará antes o después de que se procese una solicitud HTTP.
use Closure;
use Illuminate\Http\Request;
use App\Modules\RolesPermisos\Actions\ObtenerPermisosUsuarioAction;
use App\Modules\RolesPermisos\Actions\VerificarPermisoAction;

class CheckPermissions
{
    /**
     * El método __construct es el constructor de la clase CheckPermissions. Se utiliza para inyectar las dependencias necesarias para que el middleware funcione correctamente.
     * En este caso, se inyectan tres acciones: ObtenerPermisosUsuarioAction, VerificarPermisoAction y RegistrarAccesoDenegadoAction.
     * Estas acciones se utilizan para obtener los permisos del usuario, verificar si el usuario tiene el permiso requerido y registrar
     *  los accesos denegados, respectivamente.
     */
    public function __construct(
        private ObtenerPermisosUsuarioAction $obtenerPermisosUsuarioAction,
        private VerificarPermisoAction $verificarPermisoAction
        ) {}
    public function handle(
        Request $request,
        Closure $next,
        string $permisoRequerido
    ) {
        $usuario = auth()->user();

        if (!$usuario) {
           return redirect()->route('login')->withErrors(['message' => 'Debe iniciar sesión para acceder a esta página.']);
        }

        if (!$usuario->estado) {
            return redirect()->route('login')->withErrors(['message' => 'Su cuenta está inactiva.']);
        }

        $permisos = $this->obtenerPermisosUsuarioAction
            ->execute($usuario->id);

        $permitido = $this->verificarPermisoAction
            ->execute(
                $permisos,
                $permisoRequerido
            );

        if (!$permitido) {

            [$modulo, $accion] = explode(
                '.',
                $permisoRequerido
            );

            return redirect()->route('login')->withErrors(['message' => 'No tiene permisos para acceder a esta página.']);
        }

        return $next($request);
    }
}
