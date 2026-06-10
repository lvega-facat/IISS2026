<?php

namespace App\Modules\Organizaciones\Actions;

use App\Models\Organizaciones;
use Illuminate\Validation\ValidationException;

class EliminarOrganizacionAction
{
    public function execute(int $id): bool
    {
        $organizacion = Organizaciones::findOrFail($id);

        if ($organizacion->departamentos()->exists()) {
            throw ValidationException::withMessages([
                'organizacion' =>
                'La organización posee departamentos asociados.'
            ]);
        }

        if ($organizacion->usuarios()->exists()) {
            throw ValidationException::withMessages([
                'organizacion' =>
                'La organización posee usuarios asociados.'
            ]);
        }

        if ($organizacion->planillas()->exists()) {
            throw ValidationException::withMessages([
                'organizacion' =>
                'La organización posee planillas asociadas.'
            ]);
        }

        return $organizacion->delete();
    }
}