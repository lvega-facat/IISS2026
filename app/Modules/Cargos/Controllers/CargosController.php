<?php

namespace App\Modules\Cargos\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cargos;
use App\Models\Departamentos;
use App\Modules\Cargos\Actions\ActualizarCargosAction;
use App\Modules\Cargos\Actions\CrearCargosAction;
use App\Modules\Cargos\Actions\ToggleEstadoAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CargosController extends Controller
{
    public function __construct(
        protected CrearCargosAction $crearCargosAction,
        protected ActualizarCargosAction $actualizarCargosAction,
        protected ToggleEstadoAction $toggleEstadoAction,
    ) {}

    public function index()
    {
        return view('Modules.Cargos.index');
    }

    public function create()
    {
        return view('Modules.Cargos.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_departamento' => 'required|integer|exists:departamentos,id',
            'id_cargo_padre' => 'nullable|integer|exists:cargos,id',
            'nombre' => 'required|string|max:150',
        ]);

        $duplicado = Cargos::where('nombre', $request->nombre)
            ->where('id_departamento', $request->id_departamento)
            ->exists();

        if ($duplicado) {
            return back()
                ->withErrors(['nombre' => 'Ya existe un cargo con ese nombre en este departamento'])
                ->withInput();
        }

        $this->crearCargosAction->execute($request->all());

        return redirect()
            ->route('cargos.index')
            ->with('success', 'Cargo creado correctamente');
    }

    public function edit($id)
    {
        return view('Modules.Cargos.form');
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'id_departamento' => 'required|integer|exists:departamentos,id',
            'id_cargo_padre' => 'nullable|integer|exists:cargos,id',
            'nombre' => 'required|string|max:150',
        ]);

        try {
            $cargo = Cargos::findOrFail($id);
        } catch (ModelNotFoundException) {
            return redirect()->route('cargos.index')
                ->with('error', 'Cargo no encontrado');
        }

        $duplicado = Cargos::where('nombre', $request->nombre)
            ->where('id_departamento', $request->id_departamento)
            ->where('id', '!=', $id)
            ->exists();

        if ($duplicado) {
            return back()
                ->withErrors(['nombre' => 'Ya existe un cargo con ese nombre en este departamento'])
                ->withInput();
        }

        $this->actualizarCargosAction->execute($cargo, $request->all());

        return redirect()->route('cargos.index')
            ->with('success', 'Cargo actualizado correctamente');
    }

    public function activar(int $id)
    {
        try {
            $cargo = Cargos::findOrFail($id);
        } catch (ModelNotFoundException) {
            return redirect()->route('cargos.index')
                ->with('error', 'Cargo no encontrado');
        }

        $this->toggleEstadoAction->activar($cargo);

        return redirect()->route('cargos.index')
            ->with('success', 'Cargo activado correctamente');
    }

    public function desactivar(int $id)
    {
        try {
            $cargo = Cargos::findOrFail($id);
        } catch (ModelNotFoundException) {
            return redirect()->route('cargos.index')
                ->with('error', 'Cargo no encontrado');
        }

        $tieneEmpleados = $cargo->empleados()
            ->where('estado', true)
            ->exists();

        if ($tieneEmpleados) {
            return redirect()->route('cargos.index')
                ->with('error', 'No se puede desactivar porque tiene empleados asociados');
        }

        $tieneHijos = Cargos::where('id_cargo_padre', $id)
            ->where('estado', true)
            ->exists();

        if ($tieneHijos) {
            return redirect()->route('cargos.index')
                ->with('error', 'No se puede desactivar porque tiene cargos dependientes');
        }

        $this->toggleEstadoAction->desactivar($cargo);

        return redirect()->route('cargos.index')
            ->with('success', 'Cargo desactivado correctamente');
    }
}

