<?php

namespace App\Modules\Organizacion\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organizaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizacionController extends Controller
{
    public function index()
    {
        $organizacion = Organizaciones::first();

        return view('Modules.organizacion.index', compact('organizacion'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'ruc' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'pais' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:50',
            'sector' => 'nullable|string|max:100',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo_url'] = $request->file('logo')->store('organizacion', 'public');
        }

        Organizaciones::create($data);

        return redirect()->route('organizacion.index')
            ->with('success', 'Organización creada correctamente');
    }

    public function update(Request $request, $id)
    {
        $organizacion = Organizaciones::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'ruc' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'pais' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:50',
            'sector' => 'nullable|string|max:100',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // borrar anterior si existe
            if ($organizacion->logo_url) {
                Storage::disk('public')->delete($organizacion->logo_url);
            }

            $data['logo_url'] = $request->file('logo')->store('organizacion', 'public');
        }

        $organizacion->update($data);

        return redirect()->route('organizacion.index')
            ->with('success', 'Organización actualizada correctamente');
    }

    public function destroy($id)
    {
        $organizacion = Organizaciones::findOrFail($id);

        if ($organizacion->logo_url) {
            Storage::disk('public')->delete($organizacion->logo_url);
        }

        $organizacion->delete();

        return redirect()->route('organizacion.index')
            ->with('success', 'Organización eliminada correctamente');
    }
}