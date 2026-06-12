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
        return view('Modules.Contratos.Profesiones.index');
    }

    public function create()
    {
        return view('Modules.Contratos.Profesiones.form');
    }

    public function store(Request $request)
    {
        $validado = $request->validate([
            'nombre' => 'required|string|max:255|unique:profesiones,nombre',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        (new CrearProfesionAction())($validado);

        return redirect('/')->with('success', 'Profesión creada exitosamente');
    }

    public function show($id)
    {
        $profesion = Profesiones::findOrFail($id);
        return view('Modules.Contratos.Profesiones.show', compact('profesion'));
    }

    public function edit($id)
    {
        return view('Modules.Contratos.Profesiones.form');
    }

    public function update(Request $request, $id)
    {
        $profesion = Profesiones::findOrFail($id);

        $validado = $request->validate([
            'nombre' => 'required|string|max:255|unique:profesiones,nombre,' . $id,
            'descripcion' => 'nullable|string|max:1000',
            'estado' => 'required|boolean',
        ]);

        (new ActualizarProfesionAction())($profesion, $validado);

        return redirect('/')->with('success', 'Profesión actualizada exitosamente');
    }

    public function destroy($id)
    {
        $profesion = Profesiones::findOrFail($id);

        (new DesactivarProfesionAction())($profesion);

        return redirect('/')->with('success', 'Profesión desactivada exitosamente');
    }
}

