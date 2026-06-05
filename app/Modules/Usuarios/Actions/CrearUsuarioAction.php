<?php

namespace App\Modules\Usuarios\Actions;

use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;

class CrearUsuarioAction
{
    public function handle(array $data): array
    {
        $usuario = Usuarios::create([
            'id_empleado' => $data['id_empleado'],
            'id_rol' => $data['id_rol'],
            'id_organizacion' => 1,
            'nombre' => $data['nombre'] ?? '',
            'apellido' => $data['apellido'] ?? '',
            'email' => $data['email'],
            'password_hash' => Hash::make($data['password_hash']),
            'estado' => true,
        ]);

        return ['status' => 'success', 'usuario' => $usuario];
    }
}
