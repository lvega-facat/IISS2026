<?php

namespace App\Modules\Organizaciones\Actions;

use App\Models\Organizaciones;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ActualizarOrganizacionAction
{
    public function execute(
        int $id,
        array $data
    ): Organizaciones {

        $organizacion = Organizaciones::findOrFail($id);

        $rucExiste = Organizaciones::where(
                'ruc',
                $data['ruc']
            )
            ->where('id', '!=', $id)
            ->exists();

        if ($rucExiste) {
            throw ValidationException::withMessages([
                'ruc' =>
                'El RUC ya se encuentra registrado.'
            ]);
        }

        if (isset($data['logo'])) {

            if (
                $organizacion->logo_url &&
                Storage::disk('public')->exists(
                    $organizacion->logo_url
                )
            ) {
                Storage::disk('public')->delete(
                    $organizacion->logo_url
                );
            }

            $data['logo_url'] = $data['logo']->store(
                'organizaciones/logos',
                'public'
            );
        }

        unset($data['logo']);

        $organizacion->update($data);

        return $organizacion->fresh();
    }
}