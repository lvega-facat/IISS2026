<?php

namespace App\Modules\Profesiones\Actions;

use App\Models\AuditoriaLog;
use App\Models\Profesiones;
use Illuminate\Support\Facades\Auth;

class DesactivarProfesionAction
{
    public function __invoke(Profesiones $profesion): void
    {
        $valoresAnteriores = ['estado' => $profesion->estado];

        $profesion->update(['estado' => false]);

        AuditoriaLog::create([
            'id_usuario' => Auth::id(),
            'modulo' => 'profesiones',
            'accion' => 'desactivar',
            'valor_anterior' => json_encode($valoresAnteriores, JSON_UNESCAPED_UNICODE),
            'valor_nuevo' => json_encode(['estado' => false], JSON_UNESCAPED_UNICODE),
            'ip_origen' => request()->ip(),
            'ruta' => request()->path(),
            'timestamp' => now(),
        ]);
    }
}
