<?php

namespace App\Modules\Contratos\Profesiones\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profesiones;
use App\Modules\Contratos\Profesiones\Actions\ActualizarProfesionAction;
use App\Modules\Contratos\Profesiones\Actions\CrearProfesionAction;
use App\Modules\Contratos\Profesiones\Actions\DesactivarProfesionAction;
use Illuminate\Http\Request;

class ProfesionesController extends Controller
{
    public function index()
    {
        // TODO: implementar
    }

    public function create()
    {
        // TODO: implementar
    }

    public function store(Request $request)
    {
        $validado = $request->validate([
            'nombre' => 'required|string|max:255|unique:profesiones,nombre',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        (new CrearProfesionAction())($validado);

        return redirect()->route('profesiones.index')->with('success', 'Profesión creada exitosamente');
    }

    public function show(int $id)
    {
        $profesion = Profesiones::findOrFail($id);

        return view('profesiones.show', compact('profesion'));
    }

    public function edit(int $id)
    {
        // TODO: implementar
    }

    public function update(int $id, Request $request)
    {
        $profesion = Profesiones::findOrFail($id);

        $validado = $request->validate([
            'nombre' => 'required|string|max:255|unique:profesiones,nombre,' . $id,
            'descripcion' => 'nullable|string|max:1000',
            'estado' => 'required|boolean',
        ]);

        (new ActualizarProfesionAction())($profesion, $validado);

        return redirect()->route('profesiones.index')->with('success', 'Profesión actualizada exitosamente');
    }

    public function destroy(int $id)
    {
        $profesion = Profesiones::findOrFail($id);

        (new DesactivarProfesionAction())($profesion);

        return redirect()->route('profesiones.index')->with('success', 'Profesión desactivada exitosamente');
    }
}
