<?php

namespace App\Modules\Justificativos\ViewModels;

use App\Models\Justificativos;
use App\Models\Empleados;
use Illuminate\Support\Collection;

class JustificativoViewModel
{
    public function justificativosPendientes()
    {
        return $this->obtenerJustificativos('Pendiente');
    }

    public function justificativosAprobados()
    {
        return $this->obtenerJustificativos('Aprobado');
    }

    public function justificativosRechazados()
    {
        return $this->obtenerJustificativos('Rechazado');
    }

    private function obtenerJustificativos(string $estado)
    {
        $datos = Justificativos::where('estado_aprobacion', $estado)
            ->with([
                'asistencias.cat_estados_asistencia',
                'asistencias.empleados.departamentos',
                'asistencias.empleados.cargos',
                'usuarios'
            ])
            ->get();

        return $this->formatearJustificativos($datos);
    }

    private function formatearJustificativos(Collection $justificativos)
    {
        return $justificativos->map(function ($justificativo) {
            $asistencia = $justificativo->asistencias;
            $empleado = $asistencia?->empleados;
            $departamento = $empleado?->departamentos;
            $cargo = $empleado?->cargos;
            $estadoAsistencia = $asistencia?->cat_estados_asistencia;
            $aprobador = $justificativo->usuarios;

            return [
                'id' => $justificativo->id,

                'empleado' => [
                    'id' => $empleado?->id,
                    'nombre' => trim(($empleado?->nombre ?? '') . ' ' . ($empleado?->apellido ?? '')) ?: 'N/A',
                    'email' => $empleado?->email,
                    'departamento' => $departamento?->nombre ?? 'N/A',
                    'cargo' => $cargo?->nombre ?? 'N/A'
                ],

                'asistencia' => [
                    'id' => $asistencia?->id,
                    'fecha' => $this->formatearFecha($asistencia?->fecha_entrada, 'Y-m-d'),
                    'hora_entrada' => $asistencia?->hora_entrada,
                    'hora_salida' => $asistencia?->hora_salida,
                    'estado' => $estadoAsistencia?->nombre ?? 'N/A',
                    'tiene_justificativo' => $asistencia?->tiene_justificativo
                ],

                'justificativo' => [
                    'tipo' => $justificativo->tipo_justificativo,
                    'descripcion' => $justificativo->descripcion,
                    'archivo_url' => $justificativo->archivo_url,
                    'estado' => $justificativo->estado_aprobacion,
                    'fecha_aprobacion' => $this->formatearFecha($justificativo->fecha_aprobacion, 'Y-m-d H:i:s')
                ],

                'aprobador' => $aprobador ? [
                    'id' => $aprobador->id,
                    'nombre' => trim($aprobador->nombre . ' ' . $aprobador->apellido)
                ] : null
            ];
        })->toArray();
    }

    public function empleados()
    {
        $empleados = Empleados::with([
            'departamentos',
            'cargos'
        ])->get();

        return $empleados->map(function ($empleado) {
            return [
                'id' => $empleado->id,
                'nombre' => trim($empleado->nombre . ' ' . $empleado->apellido),
                'email' => $empleado->email,
                'departamento' => $empleado->departamentos?->nombre ?? 'N/A',
                'cargo' => $empleado->cargos?->nombre ?? 'N/A'
            ];
        })->toArray();
    }


    public function opcionesAprobacion()
    {
        return [
            'Pendiente',
            'Aprobado',
            'Rechazado'
        ];
    }

    public function detalleJustificativo(int $id)
    {
        $justificativo = Justificativos::with([
            'asistencias.cat_estados_asistencia',
            'asistencias.empleados.departamentos',
            'asistencias.empleados.cargos',
            'usuarios'
        ])->find($id);

        if (!$justificativo) {
            return null;
        }

        $resultado = $this->formatearJustificativos(collect([$justificativo]));

        return reset($resultado);
    }

    public function toArray()
    {
        return [
            'justificativos' => $this->justificativosPendientes(),
            'opcionesAprobacion' => $this->opcionesAprobacion(),
            'empleados' => $this->empleados()
        ];
    }

    private function formatearFecha($fecha, string $formato)
    {
        if (!$fecha) {
            return null;
        }

        if (is_string($fecha)) {
            return date($formato, strtotime($fecha));
        }

        return $fecha->format($formato);
    }
}