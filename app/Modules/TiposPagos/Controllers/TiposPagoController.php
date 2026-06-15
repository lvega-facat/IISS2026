<?php

namespace App\Modules\TiposPagos\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposPago;
use App\Modules\TiposPagos\Actions\CrearTipoPagoAction;
use App\Modules\TiposPagos\Actions\ActualizarTipoPagoAction;
use App\Modules\TiposPagos\Actions\ActivarTipoPagoAction;
use App\Modules\TiposPagos\Actions\DesactivarTipoPagoAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TiposPagoController extends Controller
{
    public function __construct(
        protected CrearTipoPagoAction $crearAction,
        protected ActualizarTipoPagoAction $actualizarAction,
        protected ActivarTipoPagoAction $activarAction,
        protected DesactivarTipoPagoAction $desactivarAction,
    ) {}

    public function index()
    {
        $tiposPago = TiposPago::orderBy('id')->get();

        return view('Modules.TiposPagos.index', compact('tiposPago'));
    }

    public function create()
    {
        return view('Modules.TiposPagos.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'codigo' => 'required|string|max:10',
            'descripcion' => 'nullable|string|max:255',
            'unidad_calculo' => 'required|string|in:salario,dia,hora,porcentaje,unidad',
        ]);

        $this->crearAction->execute($request->all());

        return redirect()->route('tipos-pago.index')
            ->with('success', 'Tipo de pago creado correctamente');
    }

    public function edit(int $id)
    {
        try {
            $tipoPago = TiposPago::findOrFail($id);
        } catch (ModelNotFoundException) {
            return redirect()->route('tipos-pago.index')
                ->with('error', 'Tipo de pago no encontrado');
        }

        return view('Modules.TiposPagos.form', compact('tipoPago'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'codigo' => 'required|string|max:10',
            'descripcion' => 'nullable|string|max:255',
            'unidad_calculo' => 'required|string|in:salario,dia,hora,porcentaje,unidad',
        ]);

        try {
            $tipoPago = TiposPago::findOrFail($id);
        } catch (ModelNotFoundException) {
            return redirect()->route('tipos-pago.index')
                ->with('error', 'Tipo de pago no encontrado');
        }

        $this->actualizarAction->execute($tipoPago, $request->all());

        return redirect()->route('tipos-pago.index')
            ->with('success', 'Tipo de pago actualizado correctamente');
    }

    public function activar(int $id)
    {
        try {
            $tipoPago = TiposPago::findOrFail($id);
        } catch (ModelNotFoundException) {
            return redirect()->route('tipos-pago.index')
                ->with('error', 'Tipo de pago no encontrado');
        }

        $this->activarAction->execute($tipoPago);

        return redirect()->route('tipos-pago.index')
            ->with('success', 'Tipo de pago activado correctamente');
    }

    public function desactivar(int $id)
    {
        try {
            $tipoPago = TiposPago::findOrFail($id);
        } catch (ModelNotFoundException) {
            return redirect()->route('tipos-pago.index')
                ->with('error', 'Tipo de pago no encontrado');
        }

        $this->desactivarAction->execute($tipoPago);

        return redirect()->route('tipos-pago.index')
            ->with('success', 'Tipo de pago desactivado correctamente');
    }
}
