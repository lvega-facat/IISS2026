<?php

namespace App\Modules\Departamentos\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Departamentos;
use App\Models\Organizaciones;
use App\Models\DepartamentoDependiente;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Modules\Departamentos\Actions\CrearDepartamentoAction;
use App\Modules\Departamentos\Actions\ActualizarDepartamentoAction;
use App\Modules\Departamentos\Actions\ActivarDepartamentoAction;
use App\Modules\Departamentos\Actions\DesactivarDepartamentoAction;

class DepartamentosController extends Controller
{
    public function __construct(
        protected CrearDepartamentoAction $crearDepartamentoAction,
        protected ActualizarDepartamentoAction $actualizarDepartamentoAction,
        protected ActivarDepartamentoAction $activarDepartamentoAction,
        protected DesactivarDepartamentoAction $desactivarDepartamentoAction,
    ) {}

    public function index()
    {
        $departamentos = Departamentos::with('organizaciones')->get();

        return view('Modules.Departamentos.index', compact('departamentos'));
    }

    public function create()
    {
        $organizacion = Organizaciones::first();

        if (!$organizacion) {
            return redirect()
                ->route('departamentos.index')
                ->with('error', 'Debe existir una organización registrada');
        }

        return view('Modules.Departamentos.form', compact('organizacion'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:100',
            'funcion_principal' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'id_departamento_padre' => 'nullable|integer|exists:departamentos,id',
        ]);

        $organizacion = Organizaciones::first();

        if (!$organizacion) {
            return back()
                ->with('error', 'Debe existir una organización registrada')
                ->withInput();
        }

        $duplicado = Departamentos::where('id_organizacion', $organizacion->id)
            ->whereRaw('LOWER(nombre) = ?', [strtolower($request->nombre)])
            ->exists();

        if ($duplicado) {
            return back()
                ->withErrors(['nombre' => 'Ya existe un departamento con ese nombre'])
                ->withInput();
        }

        $this->crearDepartamentoAction->execute(
            array_merge($request->all(), [
                'id_organizacion' => $organizacion->id
            ])
        );

        return redirect()
            ->route('departamentos.index')
            ->with('success', 'Departamento creado correctamente');
    }

    public function edit(int $id)
    {
        $departamento = Departamentos::findOrFail($id);

        return view('Modules.Departamentos.form', compact('departamento'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:100',
            'funcion_principal' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        try {
            $departamento = Departamentos::findOrFail($id);
        } catch (ModelNotFoundException) {
            return redirect()
                ->route('departamentos.index')
                ->with('error', 'Departamento no encontrado');
        }

        $duplicado = Departamentos::where('id_organizacion', $departamento->id_organizacion)
            ->where('id', '!=', $id)
            ->whereRaw('LOWER(nombre) = ?', [strtolower($request->nombre)])
            ->exists();

        if ($duplicado) {
            return back()
                ->withErrors(['nombre' => 'Ya existe un departamento con ese nombre'])
                ->withInput();
        }

        $this->actualizarDepartamentoAction->execute($departamento, $request->all());

        return redirect()
            ->route('departamentos.index')
            ->with('success', 'Departamento actualizado correctamente');
    }

    public function activar(int $id)
    {
        $departamento = Departamentos::findOrFail($id);

        $this->activarDepartamentoAction->execute($departamento);

        return redirect()
            ->route('departamentos.index')
            ->with('success', 'Departamento activado correctamente');
    }

    public function desactivar(int $id)
    {
        $departamento = Departamentos::findOrFail($id);

        $tieneEmpleados = $departamento->empleados()->where('estado', true)->exists();

        if ($tieneEmpleados) {
            return redirect()
                ->route('departamentos.index')
                ->with('error', 'No se puede desactivar porque tiene empleados.');
        }

        $tieneHijos = DepartamentoDependiente::where('id_departamento_padre', $id)->exists();

        if ($tieneHijos) {
            return redirect()
                ->route('departamentos.index')
                ->with('error', 'No se puede desactivar porque tiene dependientes.');
        }

        $this->desactivarDepartamentoAction->execute($departamento);

        return redirect()
            ->route('departamentos.index')
            ->with('success', 'Departamento desactivado correctamente');
    }
}