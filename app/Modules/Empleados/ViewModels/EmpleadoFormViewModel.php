<?php

namespace App\Modules\Empleados\ViewModels;

use App\Models\Departamentos;
use App\Models\Cargos;
use App\Models\Profesiones;
use App\Models\HorariosTrabajo;
use App\Models\TiposContrato;
use App\Models\DepartamentoDependiente;

class EmpleadoFormViewModel
{
    public function departamentos()
    {
        return Departamentos::where('estado', true)
            ->get(['id', 'nombre', 'estado']);
    }

    public function departamentosJerarquicos()
    {
        $departamentos = Departamentos::where('estado', true)
            ->get(['id', 'nombre', 'estado'])
            ->keyBy('id');

        $departamentosIds = $departamentos->keys();

        $dependencias = DepartamentoDependiente::whereIn('id_departamento_padre', $departamentosIds)
            ->whereIn('id_departamento_hijo', $departamentosIds)
            ->get([
                'id_departamento_padre',
                'id_departamento_hijo',
                'tipo_dependencia'
            ]);

        $mapaPadreHijos = [];

        foreach ($dependencias as $dep) {
            $mapaPadreHijos[$dep->id_departamento_padre][] = $dep->id_departamento_hijo;
        }

        $hijosIds = $dependencias->pluck('id_departamento_hijo')->unique();

        $raices = $departamentos->whereNotIn('id', $hijosIds)->values();

        $construirArbol = function ($padreId) use (&$construirArbol, &$mapaPadreHijos, &$departamentos) {
            $hijos = [];

            if (isset($mapaPadreHijos[$padreId])) {
                foreach ($mapaPadreHijos[$padreId] as $hijoId) {
                    if (isset($departamentos[$hijoId])) {
                        $hijo = $departamentos[$hijoId];
                        $hijo->departamentos_hijo = $construirArbol($hijoId);
                        $hijos[] = $hijo;
                    }
                }
            }

            return $hijos;
        };

        foreach ($raices as $raiz) {
            $raiz->departamentos_hijo = $construirArbol($raiz->id);
        }

        return $raices;
    }

    public function cargos()
    {
        return Cargos::where('estado', true)
            ->get(['id', 'nombre', 'id_departamento']);
    }

    public function profesiones()
    {
        return Profesiones::where('estado', true)
            ->get(['id', 'nombre']);
    }

    public function horarios()
    {
        return HorariosTrabajo::where('estado', true)
            ->get(['id', 'nombre', 'tipo_jornada', 'hora_entrada', 'hora_salida']);
    }

    public function tiposContrato()
    {
        return TiposContrato::where('estado', true)
            ->get(['id', 'nombre', 'id_profesion', 'id_horario']);
    }

    public function toArray()
    {
        return [
            'departamentos' => $this->departamentos(),
            'departamentosJerarquicos' => $this->departamentosJerarquicos(),
            'cargos' => $this->cargos(),
            'profesiones' => $this->profesiones(),
            'horarios' => $this->horarios(),
            'tiposContrato' => $this->tiposContrato(),
        ];
    }
}