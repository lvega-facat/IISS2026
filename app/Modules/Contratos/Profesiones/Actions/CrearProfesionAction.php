<?php

namespace App\Modules\Profesiones\Actions;

use App\Models\AuditoriaLog;
use App\Models\Profesiones;
use Illuminate\Support\Facades\Auth;

class CrearProfesionAction
{
    public function __invoke(array $datos): Profesiones
    {
        $profesion = Profesiones::create([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'] ?? null,
            'estado' => true,
        ]);

        AuditoriaLog::create([
            'id_usuario' => Auth::id(),
            'modulo' => 'profesiones',
            'accion' => 'crear',
            'valor_anterior' => null,
            'valor_nuevo' => json_encode($profesion->toArray(), JSON_UNESCAPED_UNICODE),
            'ip_origen' => request()->ip(),
            'ruta' => request()->path(),
            'timestamp' => now(),
        ]);

        return $profesion;
    }
}
