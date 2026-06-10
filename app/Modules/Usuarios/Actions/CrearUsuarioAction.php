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
        //validar datos
        $validatedData = validator($data, [
            'id_empleado' => 'nullable|exists:empleados,id',
            'id_rol' => 'required|exists:roles,id',
            'id_organizacion' => 'required|exists:organizaciones,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:8|confirmed',
            'foto_url' => 'nullable|url',
            'estado' => 'boolean',
        ])->validate();

        // Crear el usuario
        $usuario = Usuarios::create([
            'id_empleado' => $validatedData['id_empleado'] ?? null,
            'id_rol' => $validatedData['id_rol'],
            'id_organizacion' => $validatedData['id_organizacion'],
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
            'email' => $validatedData['email'],
            'password_hash' => Hash::make($validatedData['password']),
            'foto_url' => $validatedData['foto_url'] ?? null,
            'estado' => $validatedData['estado'] ?? true,
            'intentos_fallidos' => 0,
            'bloqueado_hasta' => null,
            'ultimo_acceso' => null,
        ]);

        return $usuario;
    }
}