<?php

namespace App\Modules\Profesiones\Actions;

use App\Models\Profesiones;
use Illuminate\Database\Eloquent\Collection;

class ObtenerProfesionesAction
{
    public function execute(): Collection
    {
        return Profesiones::where('estado', true)
            ->orderBy('nombre', 'asc')
            ->get();
    }
}
