<?php

namespace App\Modules\Organizaciones\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organizaciones;
use Illuminate\Http\Request;


use App\Modules\Organizaciones\Actions\CrearOrganizacionAction;
use App\Modules\Organizaciones\Actions\ActualizarOrganizacionAction;
use App\Modules\Organizaciones\Actions\EliminarOrganizacionAction;

class OrganizacionController extends Controller
{
    public function show()
    {
        $organizacion = Organizaciones::first();

        return view('Modules.Organizaciones.show', compact('organizacion'));
    }

    public function create()
    {
        return view('Modules.Organizaciones.create');
    }

    public function store(
        Request $request,
        CrearOrganizacionAction $action
    ) {

        $request->validate([
            'nombre' => 'required|string|max:150',
            'ruc' => 'required|string|max:20',
            'fecha_registro' => 'required|date',
            'direccion' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:80',
            'email' => 'nullable|email|max:150',
            'telefono' => 'nullable|string|max:30',
            'sector' => 'nullable|string|max:100',
            'logo' => 'nullable|image|max:2048',
            'estado' => 'nullable|boolean'
        ]);

        $organizacion = $action->execute(
            $request->all()
        );

        return redirect()->route('organizacion.show')->with('success', 'Organización creada correctamente.');
    }

    public function edit()
    {
        $organizacion = Organizaciones::firstOrFail();
        return view('Modules.Organizaciones.edit', compact('organizacion'));
    }

    public function update(
        Request $request,
        ActualizarOrganizacionAction $action
    ) {

        $request->validate([
            'nombre' => 'required|string|max:150',
            'ruc' => 'required|string|max:20',
            'fecha_registro' => 'required|date',
            'direccion' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:80',
            'email' => 'nullable|email|max:150',
            'telefono' => 'nullable|string|max:30',
            'sector' => 'nullable|string|max:100',
            'logo' => 'nullable|image|max:2048',
            'estado' => 'required|boolean'
        ]);

        $organizacion = Organizaciones::firstOrFail();

        $organizacion = $action->execute(
            $organizacion->id,
            $request->all()
        );

        return redirect()->route('organizacion.show')->with('success', 'Organización actualizada correctamente.');
    }

    public function destroy(
        EliminarOrganizacionAction $action
    ) {

        $organizacion = Organizaciones::firstOrFail();

        $action->execute($organizacion->id);

        return redirect()->route('organizacion.index')->with('success', 'Organización eliminada correctamente.');
    }
}