<?php

namespace App\Modules\Profesiones\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfesionRequest;
use App\Http\Requests\UpdateProfesionRequest;
use App\Models\Profesiones;
use App\Modules\Profesiones\Actions\ActualizarProfesionAction;
use App\Modules\Profesiones\Actions\CrearProfesionAction;
use App\Modules\Profesiones\Actions\EliminarProfesionAction;
use App\Modules\Profesiones\Actions\ObtenerProfesionesAction;
use Illuminate\Database\Eloquent\Collection;

class ProfesionesController extends Controller
{
    public function index(ObtenerProfesionesAction $action): Collection
    {
        return $action->execute();
    }

    public function store(StoreProfesionRequest $request, CrearProfesionAction $action): Profesiones
    {
        return $action->execute($request->validated());
    }

    public function update(UpdateProfesionRequest $request, Profesiones $profesion, ActualizarProfesionAction $action): Profesiones
    {
        return $action->execute($profesion, $request->validated());
    }

    public function destroy(Profesiones $profesion, EliminarProfesionAction $action): void
    {
        $action->execute($profesion);
    }
}
