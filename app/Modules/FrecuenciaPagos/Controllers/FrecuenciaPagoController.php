<?php

namespace App\Modules\FrecuenciaPagos\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FrecuenciasPago;
use App\Modules\FrecuenciaPagos\Actions\CrearFrecuenciaPagoAction;
use App\Modules\FrecuenciaPagos\Actions\ActualizarFrecuenciaPagoAction;
use App\Modules\FrecuenciaPagos\Actions\ActivarFrecuenciaPagoAction;
use App\Modules\FrecuenciaPagos\Actions\DesactivarFrecuenciaPagoAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FrecuenciaPagoController extends Controller
{
    public function __construct(
        protected CrearFrecuenciaPagoAction $crearAction,
        protected ActualizarFrecuenciaPagoAction $actualizarAction,
        protected ActivarFrecuenciaPagoAction $activarAction,
        protected DesactivarFrecuenciaPagoAction $desactivarAction,
    ) {}

    public function index()
    {
        return view('Modules.FrecuenciaPagos.index');
    }

    public function create()
    {
        return view('Modules.FrecuenciaPagos.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:frecuencias_pago,nombre',
            'dias'   => 'required|integer|min:1',
        ]);

        $this->crearAction->execute($request->all());

        return redirect()->route('frecuencias-pago.index')
            ->with('success', 'Frecuencia de pago creada correctamente');
    }

    public function edit(int $id)
    {
        return view('Modules.FrecuenciaPagos.form');
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:frecuencias_pago,nombre,' . $id,
            'dias'   => 'required|integer|min:1',
        ]);

        try {
            $frecuencia = FrecuenciasPago::findOrFail($id);
        } catch (ModelNotFoundException) {
            return redirect()->route('frecuencias-pago.index')
                ->with('error', 'Frecuencia de pago no encontrada');
        }

        $this->actualizarAction->execute($frecuencia, $request->all());

        return redirect()->route('frecuencias-pago.index')
            ->with('success', 'Frecuencia de pago actualizada correctamente');
    }

    public function activar(int $id)
    {
        try {
            $frecuencia = FrecuenciasPago::findOrFail($id);
        } catch (ModelNotFoundException) {
            return redirect()->route('frecuencias-pago.index')
                ->with('error', 'Frecuencia de pago no encontrada');
        }

        $this->activarAction->execute($frecuencia);

        return redirect()->route('frecuencias-pago.index')
            ->with('success', 'Frecuencia de pago activada correctamente');
    }

    public function desactivar(int $id)
    {
        try {
            $frecuencia = FrecuenciasPago::findOrFail($id);
        } catch (ModelNotFoundException) {
            return redirect()->route('frecuencias-pago.index')
                ->with('error', 'Frecuencia de pago no encontrada');
        }

        $this->desactivarAction->execute($frecuencia);

        return redirect()->route('frecuencias-pago.index')
            ->with('success', 'Frecuencia de pago desactivada correctamente');
    }
}
