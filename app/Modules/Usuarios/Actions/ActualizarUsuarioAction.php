<?php

namespace App\Modules\Usuarios\Actions;

use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;

class ActualizarUsuarioAction
{
    public function handle(Usuarios $usuario, array $data): array
    {
        $update = [
            'id_rol' => $data['id_rol'],
            'estado' => $data['estado'] ?? $usuario->estado,
        ];

        if (!empty($data['password_hash'])) {
            $update['password_hash'] = Hash::make($data['password_hash']);
        }

        $usuario->update($update);

        return ['status' => 'success', 'usuario' => $usuario];
    }
}
