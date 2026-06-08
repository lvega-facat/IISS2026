<?php

namespace App\Modules\Usuarios\Actions;

use App\Models\Usuarios;
use App\Models\Empleados;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CrearUsuarioAction
{
    public function execute(array $data): Usuarios
    {
        // Verificar si el empleado ya tiene un usuario asociado
        if (isset($data['id_empleado']) && $data['id_empleado']) {
            $existingUser = Usuarios::where('id_empleado', $data['id_empleado'])->first();
            if ($existingUser) {
                throw ValidationException::withMessages([
                    'id_empleado' => ['Este empleado ya tiene un usuario asociado.']
                ]);
            }
        }

        // Crear el usuario
        $usuario = Usuarios::create([
            'id_empleado' => $data['id_empleado'] ?? null,
            'id_rol' => $data['id_rol'],
            'id_organizacion' => $data['id_organizacion'],
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'password_hash' => Hash::make($data['password']),
            'foto_url' => $data['foto_url'] ?? null,
            'estado' => $data['estado'] ?? true,
            'intentos_fallidos' => 0,
            'bloqueado_hasta' => null,
            'ultimo_acceso' => null,
        ]);

        return $usuario;
    }
}