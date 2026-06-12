<?php

namespace App\Modules\Organizaciones\Actions;

use App\Models\Organizaciones;
use Illuminate\Validation\ValidationException;

class CrearOrganizacionAction
{
    public function execute(array $data): Organizaciones
    {
        if (Organizaciones::exists()) {
            throw ValidationException::withMessages([
                'organizacion' =>
                'Ya existe una organización registrada en el sistema.'
            ]);
        }

        if (
            Organizaciones::where('ruc', $data['ruc'])->exists()
        ) {
            throw ValidationException::withMessages([
                'ruc' =>
                'El RUC ya se encuentra registrado.'
            ]);
        }

        if (isset($data['logo'])) {
            $data['logo_url'] = $data['logo']->store(
                'organizaciones/logos',
                'public'
            );
        }

        unset($data['logo']);

        return Organizaciones::create($data);
    }
}