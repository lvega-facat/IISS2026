<?php

namespace App\Modules\Dashboard\ViewModels;

use App\Models\Usuarios;

class DashboardViewModel
{
    protected Usuarios $usuario;

    public function __construct(?Usuarios $usuario = null)
    {
        // Usa el usuario recibido o el usuario autenticado.
        $this->usuario = $usuario ?? auth()->user();

        // Carga el rol, permisos y módulos relacionados.
        $this->usuario->loadMissing([
            'roles.rol_permisos.permisos.modulos'
        ]);
    }

    public function usuario(): array
    {
        // Devuelve los datos básicos del usuario.
        return [
            'id' => $this->usuario->id,
            'nombre' => $this->usuario->nombre,
            'apellido' => $this->usuario->apellido,
            'email' => $this->usuario->email,
            'foto_url' => $this->usuario->foto_url,
            'ultimo_acceso' => $this->usuario->ultimo_acceso,
            'id_rol' => $this->usuario->id_rol,
            'id_organizacion' => $this->usuario->id_organizacion,
        ];
    }

    public function rol(): array
    {
        // Obtiene el rol del usuario.
        $role = $this->usuario->roles;

        if (!$role) {
            return [];
        }

        // Devuelve los datos básicos del rol.
        return [
            'id' => $role->id,
            'nombre' => $role->nombre,
            'descripcion' => $role->descripcion,
        ];
    }

    public function modulos(): array
    {
        // Obtiene el rol del usuario.
        $role = $this->usuario->roles;

        if (!$role) {
            return [];
        }

        $modulosUnicos = [];
        $modulosIds = [];

        // Recorre los permisos del rol para obtener sus módulos.
        foreach ($role->rol_permisos as $rolPermiso) {
            $permiso = $rolPermiso->permisos;

            // Si no hay permiso o módulo, se omite.
            if (!$permiso || !$permiso->modulos) {
                continue;
            }

            $modulo = $permiso->modulos;

            // Agrega el módulo solo si todavía no fue agregado.
            if (!in_array($modulo->id, $modulosIds)) {
                $modulosIds[] = $modulo->id;

                $modulosUnicos[] = [
                    'id' => $modulo->id,
                    'nombre' => $modulo->nombre,
                    'slug' => $modulo->slug,
                ];
            }
        }

        return $modulosUnicos;
    }

    public function permisos(): array
    {
        // Obtiene el rol del usuario.
        $role = $this->usuario->roles;

        if (!$role) {
            return [];
        }

        $permisosAgrupados = [];

        // Recorre los permisos del rol.
        foreach ($role->rol_permisos as $rolPermiso) {
            $permiso = $rolPermiso->permisos;

            // Si no hay permiso o módulo, se omite.
            if (!$permiso || !$permiso->modulos) {
                continue;
            }

            $modulo = $permiso->modulos;
            $moduloSlug = $modulo->slug;

            // Crea el grupo del módulo si todavía no existe.
            if (!isset($permisosAgrupados[$moduloSlug])) {
                $permisosAgrupados[$moduloSlug] = [];
            }

            // Agrega la acción solo si todavía no está en el grupo.
            if (!in_array($permiso->accion, $permisosAgrupados[$moduloSlug])) {
                $permisosAgrupados[$moduloSlug][] = $permiso->accion;
            }
        }

        return $permisosAgrupados;
    }

    public function toArray(): array
    {
        // Devuelve todos los datos listos para usar en la vista.
        return [
            'usuario' => $this->usuario(),
            'rol' => $this->rol(),
            'modulos' => $this->modulos(),
            'permisos' => $this->permisos(),
        ];
    }
}