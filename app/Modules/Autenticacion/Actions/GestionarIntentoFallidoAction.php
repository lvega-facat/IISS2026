<?php

namespace App\Modules\Autenticacion\Actions;

use App\Models\AuditoriaLog;
use App\Models\Usuarios;

class GestionarIntentoFallidoAction
{
    public function handle(
        Usuarios $user,
        ?string $ipAddress = null,
        ?string $ruta = null
    ): void {
        $attemptsBefore = (int) ($user->intentos_fallidos ?? 0);
        $maxAttempts = (int) config('autenticacion.max_failed_attempts', 5);
        $attemptsAfter = min($attemptsBefore + 1, $maxAttempts);

        $user->forceFill([
            'intentos_fallidos' => $attemptsAfter,
            'bloqueado_hasta' => $attemptsAfter >= $maxAttempts
                ? now()->addMinutes((int) config('autenticacion.lockout_minutes', 15))
                : $user->bloqueado_hasta,
        ])->save();

        AuditoriaLog::create([
            'id_usuario' => $user->id,
            'modulo' => 'login',
            'accion' => $attemptsAfter >= $maxAttempts ? 'cuenta_bloqueada' : 'intento_fallido',
            'valor_anterior' => json_encode(['intentos_fallidos' => $attemptsBefore], JSON_UNESCAPED_UNICODE),
            'valor_nuevo' => json_encode([
                'intentos_fallidos' => $attemptsAfter,
                'bloqueado_hasta' => $user->bloqueado_hasta?->toDateTimeString(),
            ], JSON_UNESCAPED_UNICODE),
            'ip_origen' => $ipAddress,
            'ruta' => $ruta,
            'timestamp' => now(),
        ]);
    }
}