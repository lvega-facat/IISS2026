<?php

namespace App\Modules\Usuarios\Actions;

use App\Models\Usuarios;
use App\Models\Empleados;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ActualizarUsuarioAction
{
    public function execute(Usuarios $usuario, array $data): Usuarios
    {
        // Verificar si el empleado ya tiene un usuario asociado (excluyendo el actual)
        if (isset($data['id_empleado']) && $data['id_empleado']) {
            $existingUser = Usuarios::where('id_empleado', $data['id_empleado'])
                ->where('id', '!=', $usuario->id)
                ->first();
            
            if ($existingUser) {
                throw ValidationException::withMessages([
                    'id_empleado' => ['Este empleado ya tiene un usuario asociado.']
                ]);
            }
        }

        // Preparar datos para actualizar
        $updateData = [
            'id_empleado' => $data['id_empleado'] ?? null,
            'id_rol' => $data['id_rol'],
            'id_organizacion' => $data['id_organizacion'],
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'foto_url' => $data['foto_url'] ?? null,
            'estado' => $data['estado'] ?? true,
        ];

        // Actualizar contraseña solo si se proporciona
        if (!empty($data['password'])) {
            $updateData['password_hash'] = Hash::make($data['password']);
        }

        $usuario->update($updateData);

        return $usuario;
    }
}