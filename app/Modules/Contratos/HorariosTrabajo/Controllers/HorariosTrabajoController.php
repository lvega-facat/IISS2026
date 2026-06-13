<?php

namespace App\Modules\Contratos\HorariosTrabajo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HorariosTrabajo;

use App\Modules\Contratos\HorariosTrabajo\Actions\CrearHorarioTrabajoAction;
use App\Modules\Contratos\HorariosTrabajo\Actions\ActualizarHorarioTrabajoAction;
use App\Modules\Contratos\HorariosTrabajo\Actions\EliminarHorarioTrabajoAction;

class HorariosTrabajoController extends Controller
{
    public function index()
    {
        return view('Modules.HorariosTrabajo.index');
    }

    public function create()
    {
        return view('Modules.HorariosTrabajo.form');
    }

    public function edit($id)
    {
        return view('Modules.HorariosTrabajo.form');
    }

    public function store(
        Request $request,
        CrearHorarioTrabajoAction $action
    ) {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'tipo_jornada' => 'required|string|max:50',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida' => 'required|date_format:H:i',
            'horas_diarias' => 'required|numeric|min:1',
            'horas_semanales' => 'required|numeric|min:1',
            'tolerancia_minutos' => 'nullable|integer|min:0',
        ]);

        if (
            strtotime($data['hora_salida']) <=
            strtotime($data['hora_entrada'])
        ) {
            return back()->withErrors([
                'hora_salida' => 'La hora de salida debe ser posterior a la hora de entrada.'
            ]);
        }

        if (
            $data['tipo_jornada'] === 'JORNADA_COMPLETA' &&
            $data['horas_diarias'] > 8
        ) {
            return back()->withErrors([
                'horas_diarias' => 'La jornada completa no puede superar 8 horas diarias.'
            ]);
        }

        if (
            $data['tipo_jornada'] === 'MEDIA_JORNADA' &&
            $data['horas_diarias'] > 4
        ) {
            return back()->withErrors([
                'horas_diarias' => 'La media jornada no puede superar 4 horas diarias.'
            ]);
        }

        if ($data['horas_semanales'] > 48) {
            return back()->withErrors([
                'horas_semanales' => 'No puede superar 48 horas semanales.'
            ]);
        }

        $action->execute($data);

        return redirect()->route('horarios.index');
    }

    public function update(
        Request $request,
        $id,
        ActualizarHorarioTrabajoAction $action
    ) {
        $horario = HorariosTrabajo::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'tipo_jornada' => 'required|string|max:50',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida' => 'required|date_format:H:i',
            'horas_diarias' => 'required|numeric|min:1',
            'horas_semanales' => 'required|numeric|min:1',
            'tolerancia_minutos' => 'nullable|integer|min:0',
        ]);

        if (
            strtotime($data['hora_salida']) <=
            strtotime($data['hora_entrada'])
        ) {
            return back()->withErrors([
                'hora_salida' => 'La hora de salida debe ser posterior a la hora de entrada.'
            ]);
        }

        if (
            $data['tipo_jornada'] === 'JORNADA_COMPLETA' &&
            $data['horas_diarias'] > 8
        ) {
            return back()->withErrors([
                'horas_diarias' => 'La jornada completa no puede superar 8 horas diarias.'
            ]);
        }

        if (
            $data['tipo_jornada'] === 'MEDIA_JORNADA' &&
            $data['horas_diarias'] > 4
        ) {
            return back()->withErrors([
                'horas_diarias' => 'La media jornada no puede superar 4 horas diarias.'
            ]);
        }

        if ($data['horas_semanales'] > 48) {
            return back()->withErrors([
                'horas_semanales' => 'No puede superar 48 horas semanales.'
            ]);
        }

        $action->execute(
            $horario,
            $data
        );

        return redirect()->route('horarios.index');
    }

    public function destroy(
        $id,
        EliminarHorarioTrabajoAction $action
    ) {
        $horario = HorariosTrabajo::findOrFail($id);

        $action->execute($horario);

        return redirect()->route('horarios.index');
    }
}