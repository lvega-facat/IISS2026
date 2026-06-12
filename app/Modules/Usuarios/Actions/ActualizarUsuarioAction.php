<?php

namespace App\Modules\Usuarios\Actions;

use App\Models\Usuarios;
use Illuminate\Validation\ValidationException;

class ActualizarUsuarioAction
{
    public function execute(
        Usuarios $usuario,
        array $data
    ): Usuarios {

        if (!empty($data['id_empleado'])) {

            $existingUser = Usuarios::query()
                ->where('id_empleado', $data['id_empleado'])
                ->where('id', '!=', $usuario->id)
                ->first();

            if ($existingUser) {
                throw ValidationException::withMessages([
                    'id_empleado' => [
                        'Este empleado ya tiene un usuario asociado.'
                    ]
                ]);
            }
        }
        // Validar datos
        $validatedData = validator($data, [
            'id_empleado' => 'nullable|exists:empleados,id',
            'id_rol' => 'required|exists:roles,id',
            'id_organizacion' => 'required|exists:organizaciones,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'foto_url' => 'nullable|url',
            'estado' => 'boolean',
        ])->validate();

        $usuario->update([
            'id_empleado'      => $validatedData['id_empleado'] ?? null,
            'id_rol'           => $validatedData['id_rol'],
            'id_organizacion'  => $validatedData['id_organizacion'],
            'nombre'           => $validatedData['nombre'],
            'apellido'         => $validatedData['apellido'],
            'email'            => $validatedData['email'],
            'foto_url'         => $validatedData['foto_url'] ?? null,
            'estado'           => $validatedData['estado'] ?? true,
        ]);

        return $usuario->fresh();
    }
}