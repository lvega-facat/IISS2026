<?php

namespace App\Modules\Empleados\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cargos;
use App\Models\Departamentos;
use App\Models\Empleados;
use App\Models\Profesiones;
use App\Modules\Empleados\Actions\ActualizarEmpleadoAction;
use App\Modules\Empleados\Actions\AsignarContratoEmpleadoAction;
use App\Modules\Empleados\Actions\CrearEmpleadoAction;
use App\Modules\Empleados\Actions\DarBajaEmpleadoAction;
use App\Modules\Empleados\Actions\ExportarFichaEmpleadosPDFAction;
use App\Modules\Empleados\Actions\ListarEmpleadosAction;
use App\Modules\Empleados\Actions\RegistrarCambioCargoAction;
use App\Modules\Empleados\Actions\RestaurarEmpleadoAction;
use App\Modules\Empleados\Requests\ActualizarEmpleadoRequest;
use App\Modules\Empleados\Requests\CrearEmpleadoRequest;
use App\Modules\Empleados\Requests\ListarEmpleadosRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class EmpleadosController extends Controller
{
    public function index(ListarEmpleadosRequest $request, ListarEmpleadosAction $action)
    {
        $empleados = $action->execute($request->validated());

        $departamentos = Departamentos::where('estado', true)->orderBy('nombre')->get();
        $cargos        = Cargos::where('estado', true)->orderBy('nombre')->get();

        return view('Modules.Empleados.index', compact('empleados', 'departamentos', 'cargos'));
    }

    public function create()
    {
        $this->authorize('empleados.crear');

        $departamentos = Departamentos::where('estado', true)->orderBy('nombre')->get();
        $cargos        = Cargos::where('estado', true)->orderBy('nombre')->get();
        $profesiones   = Profesiones::where('estado', true)->orderBy('nombre')->get();

        return view('Modules.Empleados.form', compact('departamentos', 'cargos', 'profesiones'));
    }

    public function store(
        CrearEmpleadoRequest $request,
        CrearEmpleadoAction $crearEmpleado,
        AsignarContratoEmpleadoAction $asignarContrato
    ) {
        $data     = $request->validated();
        $empleado = $crearEmpleado->execute($data);

        if (!empty($data['contrato'])) {
            $asignarContrato->execute($empleado, $data['contrato']);
        }

        return redirect()
            ->route('empleados.show', $empleado->id)
            ->with('success', 'Empleado registrado correctamente.');
    }

    public function show(int $id)
    {
        $this->authorize('empleados.ver');

        $empleado = Empleados::with([
            'departamentos',
            'cargos',
            'profesiones',
            'contratos' => fn($q) => $q->where('estado', true)->with('tipos_contrato', 'tipos_pago', 'frecuencias_pago'),
        ])->findOrFail($id);

        return view('Modules.Empleados.show', compact('empleado'));
    }

    public function edit(int $id)
    {
        $this->authorize('empleados.editar');

        $empleado    = Empleados::findOrFail($id);
        $departamentos = Departamentos::where('estado', true)->orderBy('nombre')->get();
        $cargos        = Cargos::where('estado', true)->orderBy('nombre')->get();
        $profesiones   = Profesiones::where('estado', true)->orderBy('nombre')->get();

        return view('Modules.Empleados.form', compact('empleado', 'departamentos', 'cargos', 'profesiones'));
    }

    public function update(
        ActualizarEmpleadoRequest $request,
        int $id,
        ActualizarEmpleadoAction $action
    ) {
        $empleado = Empleados::findOrFail($id);
        $action->execute($empleado, $request->validated());

        return redirect()
            ->route('empleados.show', $id)
            ->with('success', 'Empleado actualizado correctamente.');
    }

    public function cambiarCargo(
        ActualizarEmpleadoRequest $request,
        int $id,
        RegistrarCambioCargoAction $action
    ) {
        $empleado = Empleados::findOrFail($id);
        $action->execute($empleado, $request->validated());

        return redirect()
            ->route('empleados.show', $id)
            ->with('success', 'Cargo actualizado y registrado en historial.');
    }

    public function destroy(int $id, DarBajaEmpleadoAction $action)
    {
        $this->authorize('empleados.baja');

        $empleado = Empleados::findOrFail($id);
        $action->execute($empleado);

        return redirect()
            ->route('empleados.index')
            ->with('success', 'Empleado dado de baja correctamente.');
    }

    public function restore(int $id, RestaurarEmpleadoAction $action)
    {
        $this->authorize('empleados.restaurar');

        $empleado = Empleados::withTrashed()->findOrFail($id);
        $action->execute($empleado);

        return redirect()
            ->route('empleados.show', $id)
            ->with('success', 'Empleado restaurado correctamente.');
    }

    public function exportarPDF(int $id, ExportarFichaEmpleadosPDFAction $action)
    {
        $this->authorize('empleados.ver');

        $empleado = Empleados::findOrFail($id);
        $datos    = $action->execute($empleado);

        $pdf = Pdf::loadView('Modules.Empleados.pdf.ficha', $datos);

        return $pdf->download("ficha-empleado-{$empleado->dni_ci}.pdf");
    }
}
