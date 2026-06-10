<?php

namespace App\Modules\Profesiones\Actions;

use App\Models\AuditoriaLog;
use App\Models\Profesiones;
use Illuminate\Support\Facades\Auth;

class ActualizarProfesionAction
{
    public function __invoke(Profesiones $profesion, array $datos): Profesiones
    {
        $valoresAnteriores = [];

        if ($profesion->nombre !== $datos['nombre']) {
            $valoresAnteriores['nombre'] = $profesion->nombre;
        }

        if ($profesion->descripcion !== ($datos['descripcion'] ?? null)) {
            $valoresAnteriores['descripcion'] = $profesion->descripcion;
        }

        if ((bool) $profesion->estado !== (bool) $datos['estado']) {
            $valoresAnteriores['estado'] = $profesion->estado;
        }

        $profesion->update([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'] ?? null,
            'estado' => $datos['estado'],
        ]);

        $valoresNuevos = [];
        if (isset($valoresAnteriores['nombre'])) {
            $valoresNuevos['nombre'] = $datos['nombre'];
        }
        if (isset($valoresAnteriores['descripcion'])) {
            $valoresNuevos['descripcion'] = $datos['descripcion'] ?? null;
        }
        if (isset($valoresAnteriores['estado'])) {
            $valoresNuevos['estado'] = $datos['estado'];
        }

        AuditoriaLog::create([
            'id_usuario' => Auth::id(),
            'modulo' => 'profesiones',
            'accion' => 'actualizar',
            'valor_anterior' => count($valoresAnteriores) > 0 ? json_encode($valoresAnteriores, JSON_UNESCAPED_UNICODE) : null,
            'valor_nuevo' => count($valoresNuevos) > 0 ? json_encode($valoresNuevos, JSON_UNESCAPED_UNICODE) : null,
            'ip_origen' => request()->ip(),
            'ruta' => request()->path(),
            'timestamp' => now(),
        ]);

        return $profesion;
    }
}
