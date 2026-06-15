<?php

namespace App\Modules\Usuarios\Actions;

use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;

class CambiarPasswordUsuarioAction
{
    public function execute(
        Usuarios $usuario,
        string $password,
        string $passwordConfirmation
    ): bool {
        //validar password
        $validatedData = validator([
            'password' => $password,
            'password_confirmation' => $passwordConfirmation
        ], [
            'password' => 'required|string|min:8|confirmed',
        ])->validate();

        $usuario->password_hash = Hash::make($password);

        return $usuario->save();
    }
}
