<?php

namespace App\Modules\Empleados\ViewModels;

use App\Models\Empleados;
use Illuminate\Http\Request;

class EmpleadosTableViewModel
{
    private Request $request;
    private int $perPage;

    public function __construct(Request $request, int $perPage = 15)
    {
        $this->request = $request;
        $this->perPage = $perPage;
    }

    public function empleados()
    {
        $query = Empleados::with([
            'departamentos',
            'cargos',
            'contratos.tipos_contrato',
            'contratos.frecuencias_pago',
            'contratos.tipos_pago',
        ]);

        $this->aplicarFiltros($query);
        $this->aplicarOrdenamiento($query);

        return $query->paginate($this->perPage)->withQueryString();
    }

    public function filtros(): array
    {
        return [
            'nombre' => $this->request->input('nombre'),
            'apellido'=> $this->request->input('apellido'),
            'email'=> $this->request->input('email'),
            'dni_ci'  => $this->request->input('dni_ci'),
            'id_departamento'=> $this->request->input('id_departamento'),
            'id_cargo'  => $this->request->input('id_cargo'),
            'estado'  => $this->request->input('estado'),
            'orden_campo' => $this->request->input('orden_campo', 'nombre'),
            'orden_dir'  => $this->request->input('orden_dir', 'asc'),
        ];
    }

    public function detalleEmpleado(int $empleadoId): ?array
    {
        $empleado = Empleados::with([
            'departamentos',
            'cargos',
            'contratos.tipos_contrato',
            'contratos.frecuencias_pago',
            'contratos.tipos_pago',
        ])->find($empleadoId);

        if (!$empleado) {
            return null;
        }

        return [
            'id'=> $empleado->id,
            'nombre' => $empleado->nombre,
            'apellido' => $empleado->apellido,
            'email'=> $empleado->email,
            'dni_ci'=> $empleado->dni_ci,
            'telefono' => $empleado->telefono,
            'tipo_trabajo'=> $empleado->tipo_trabajo,
            'fecha_registro'=> $empleado->fecha_registro?->format('d/m/Y'),
            'estado' => $empleado->estado,
            'departamento' => $empleado->departamentos?->nombre,
            'cargo' => $empleado->cargos?->nombre,
            'contrato_activo' => $this->contratoActivo($empleadoId),
        ];
    }

    public function contratoActivo(int $empleadoId): ?array
    {
        $empleado = Empleados::with([
            'contratos.tipos_contrato',
            'contratos.frecuencias_pago',
            'contratos.tipos_pago',
        ])->find($empleadoId);

        if (!$empleado) {
            return null;
        }

        $contrato = $empleado->contratos
            ->where('estado', true)
            ->first();

        if (!$contrato) {
            return null;
        }

        return [
            'id'=> $contrato->id,
            'tipo_contrato'=> $contrato->tipos_contrato?->nombre,
            'monto_base'=> $contrato->monto_base,
            'fecha_inicio'  => $contrato->fecha_inicio?->format('d/m/Y'),
            'fecha_fin' => $contrato->fecha_fin?->format('d/m/Y'),
            'tipo_pago' => $contrato->tipos_pago?->nombre,
            'frecuencia_pago'=> $contrato->frecuencias_pago?->nombre,
        ];
    }

    public function toArray(): array
    {
        $empleadosPaginados = $this->empleados();

        return [
            'empleados'  => $empleadosPaginados->items(),
            'filtros'    => $this->filtros(),
            'paginacion' => [
                'total'=> $empleadosPaginados->total(),
                'por_pagina'=> $empleadosPaginados->perPage(),
                'pagina_actual'=> $empleadosPaginados->currentPage(),
                'ultima_pagina'=> $empleadosPaginados->lastPage(),
                'desde' => $empleadosPaginados->firstItem(),
                'hasta' => $empleadosPaginados->lastItem(),
                'links'=> $empleadosPaginados->linkCollection()->toArray(),
            ],
        ];
    }

    private function aplicarFiltros($query): void
    {
        $filtros = $this->filtros();

        if (!empty($filtros['nombre'])) {
            $query->where('nombre', 'like', '%' . $filtros['nombre'] . '%');
        }

        if (!empty($filtros['apellido'])) {
            $query->where('apellido', 'like', '%' . $filtros['apellido'] . '%');
        }

        if (!empty($filtros['email'])) {
            $query->where('email', 'like', '%' . $filtros['email'] . '%');
        }

        if (!empty($filtros['dni_ci'])) {
            $query->where('dni_ci', 'like', '%' . $filtros['dni_ci'] . '%');
        }

        if (!empty($filtros['id_departamento'])) {
            $query->where('id_departamento', $filtros['id_departamento']);
        }

        if (!empty($filtros['id_cargo'])) {
            $query->where('id_cargo', $filtros['id_cargo']);
        }

        if ($filtros['estado'] !== null && $filtros['estado'] !== '') {
            $query->where('estado', (bool) $filtros['estado']);
        }
    }

    private function aplicarOrdenamiento($query): void
    {
        $camposPermitidos = ['nombre', 'apellido', 'fecha_registro'];
        $campo = $this->request->input('orden_campo', 'nombre');
        $direccion = $this->request->input('orden_dir', 'asc');

        if (!in_array($campo, $camposPermitidos)) {
            $campo = 'nombre';
        }

        if (!in_array($direccion, ['asc', 'desc'])) {
            $direccion = 'asc';
        }

        $query->orderBy($campo, $direccion);
    }
}
