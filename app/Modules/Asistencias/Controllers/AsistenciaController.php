<?php

namespace App\Modules\Asistencias\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Contratos;
use App\Models\Asistencias;
use App\Models\Empleados;
use App\Http\Controllers\Controller;

use App\Modules\Asistencias\Actions\CrearAsistenciaAction;
use App\Modules\Asistencias\Actions\ActualizarAsistenciaAction;
use App\Modules\Asistencias\Actions\CrearAusenciaAction;

class AsistenciaController extends Controller
{
    private const ESTADO_PRESENTE = 1;
    private const ESTADO_AUSENTE = 2;
    private const ESTADO_TARDANZA = 3;



    public function index()
    {
        return view('Modules.Asistencias.index');
    }
    public function edit(int $id)
    {
        return view('Modules.Asistencias.form');
    }
    public function update(
        Request $request,
        int $id,
        ActualizarAsistenciaAction $action
    ) {

        $data = $request->validate([
            'hora_entrada' => ['nullable'],
            'hora_salida' => ['nullable'],
            'id_estado_asistencia' => [
                'required',
                'exists:cat_estados_asistencia,id'
            ],
            'minutos_tardanza' => ['nullable'],
            'horas_trabajadas' => ['nullable'],
            'horas_extra' => ['nullable'],
            'horas_ausentes' => ['nullable'],
            'tiene_justificativo' => ['boolean']
        ]);

        $asistencia = Asistencias::findOrFail($id);

        $action->execute(
            $asistencia,
            $data
        );

        return redirect()
            ->route('asistencias.index');
    }

    public function registrarEntrada(
        Request $request,
        CrearAsistenciaAction $action
    ) {

        $data = $request->validate([
            'id_empleado' => [
                'required',
                'exists:empleados,id'
            ]
        ]);

        $contrato = Contratos::where(
            'id_empleado',
            $data['id_empleado']
        )
            ->where('estado', true)
            ->firstOrFail();

        $yaMarco = Asistencias::where(
            'id_empleado',
            $data['id_empleado']
        )
            ->whereDate(
                'fecha_entrada',
                today()
            )
            ->exists();

        if ($yaMarco) {

            return back()->withErrors([
                'asistencia' =>
                'El empleado ya registró asistencia hoy.'
            ]);
        }

        $horario = $contrato
            ->tipos_contrato
            ->horarios_trabajo;

        $horaActual = Carbon::now();

        $horaEntradaHorario = Carbon::parse(
            $horario->hora_entrada
        );

        $limite = $horaEntradaHorario
            ->copy()
            ->addMinutes(
                $horario->tolerancia_minutos
            );

        $estado = self::ESTADO_PRESENTE;
        $tardanza = 0;

        if ($horaActual->gt($limite)) {

            $estado = self::ESTADO_TARDANZA;

            $tardanza =
                $limite->diffInMinutes(
                    $horaActual
                );
        }

        $action->execute([
            'id_empleado' => $contrato->id_empleado,
            'id_contrato' => $contrato->id,
            'id_estado_asistencia' => $estado,
            'fecha_entrada' => today(),
            'hora_entrada' => now()->format('H:i:s'),
            'minutos_tardanza' => $tardanza,
            'tiene_justificativo' => false,
        ]);

        return redirect()
            ->route('asistencias.index');
    }

    public function registrarSalida(
        int $id,
        ActualizarAsistenciaAction $action
    ) {

        $asistencia = Asistencias::findOrFail($id);

        $horario = $asistencia
            ->contratos
            ->tipos_contrato
            ->horarios_trabajo;

        $entrada = Carbon::parse(
            $asistencia->hora_entrada
        );

        $salida = Carbon::now();

        $horasTrabajadas =
            $entrada->diffInMinutes(
                $salida
            ) / 60;

        $salidaHorario = Carbon::parse(
            $horario->hora_salida
        );

        $horasExtra = 0;

        if ($salida->gt($salidaHorario)) {

            $horasExtra =
                $salidaHorario
                ->diffInMinutes(
                    $salida
                ) / 60;
        }

        $action->execute(
            $asistencia,
            [
                'hora_salida' =>
                $salida->format('H:i:s'),

                'horas_trabajadas' =>
                $horasTrabajadas,

                'horas_extra' =>
                $horasExtra
            ]
        );

        return redirect()
            ->route('asistencias.index');
    }

    public function generarAusencias(
        CrearAusenciaAction $action
    ) {

        $empleados = Empleados::where(
            'estado',
            true
        )->get();

        foreach ($empleados as $empleado) {

            $contrato = Contratos::where(
                'id_empleado',
                $empleado->id
            )
                ->where('estado', true)
                ->first();

            if (!$contrato) {
                continue;
            }

            $existe = Asistencias::where(
                'id_empleado',
                $empleado->id
            )
                ->whereDate(
                    'fecha_entrada',
                    today()
                )
                ->exists();

            if ($existe) {
                continue;
            }

            $horario = $contrato
                ->tipos_contrato
                ->horarios_trabajo;

            $action->execute([
                'id_empleado' => $empleado->id,
                'id_contrato' => $contrato->id,
                'id_estado_asistencia' => self::ESTADO_AUSENTE,
                'fecha_entrada' => today(),
                'horas_ausentes' =>
                $horario->horas_diarias,
                'tiene_justificativo' => false,
            ]);
        }

        return back();
    }
}
