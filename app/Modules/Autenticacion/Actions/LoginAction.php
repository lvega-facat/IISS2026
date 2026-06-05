<?php

namespace App\Modules\Autenticacion\Actions;

use App\Models\AuditoriaLog;
use App\Models\Sesiones;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAction
{
    public function attempt(
        string $email,
        string $password,
        ?string $ipAddress = null,
        ?string $userAgent = null,
        ?string $ruta = null
    ): array {
        $email = mb_strtolower(trim($email));

        $user = Usuarios::query()->where('email', $email)->first();

        if ($user === null) {
            return [
                'status' => 'invalid_credentials',
                'message' => 'Las credenciales proporcionadas no son válidas.',
                'user' => null,
            ];
        }

        if (! $user->estado) {
            $this->registrarAuditoria(
                $user,
                'login',
                'cuenta_inactiva',
                null,
                json_encode(['email' => $email], JSON_UNESCAPED_UNICODE),
                $ipAddress,
                $ruta,
            );

            return [
                'status' => 'inactive',
                'message' => 'Las credenciales proporcionadas no son válidas.',
                'user' => $user,
            ];
        }

        if ($user->bloqueado_hasta !== null && $user->bloqueado_hasta->isFuture()) {
            $this->registrarAuditoria(
                $user,
                'login',
                'cuenta_bloqueada',
                null,
                json_encode(['bloqueado_hasta' => $user->bloqueado_hasta?->toDateTimeString()], JSON_UNESCAPED_UNICODE),
                $ipAddress,
                $ruta,
            );

            return [
                'status' => 'blocked',
                'message' => 'La cuenta se encuentra bloqueada temporalmente. Intenta nuevamente más tarde.',
                'user' => $user,
            ];
        }

        if ($user->bloqueado_hasta !== null && $user->bloqueado_hasta->isPast()) {
            $user->forceFill([
                'bloqueado_hasta' => null,
                'intentos_fallidos' => 0,
            ])->save();
        }

        if (! Hash::check($password, $user->password_hash)) {
            return [
                'status' => 'invalid_credentials',
                'message' => 'Las credenciales proporcionadas no son válidas.',
                'user' => $user,
            ];
        }

        $previousState = [
            'ultimo_acceso' => $user->ultimo_acceso?->toDateTimeString(),
            'intentos_fallidos' => $user->intentos_fallidos,
            'bloqueado_hasta' => $user->bloqueado_hasta?->toDateTimeString(),
        ];

        Auth::login($user);

        $user->forceFill([
            'ultimo_acceso' => now(),
            'intentos_fallidos' => 0,
            'bloqueado_hasta' => null,
        ])->save();

        $this->registrarAuditoria(
            $user,
            'login',
            'login_exitoso',
            json_encode($previousState, JSON_UNESCAPED_UNICODE),
            json_encode([
                'ultimo_acceso' => $user->ultimo_acceso?->toDateTimeString(),
                'intentos_fallidos' => 0,
                'bloqueado_hasta' => null,
            ], JSON_UNESCAPED_UNICODE),
            $ipAddress,
            $ruta,
        );

        $this->registrarSesion($user, $ipAddress, $userAgent, $ruta);

        return [
            'status' => 'success',
            'message' => 'Autenticación correcta.',
            'user' => $user,
        ];
    }

    private function registrarAuditoria(
        Usuarios $user,
        string $modulo,
        string $accion,
        ?string $valorAnterior,
        ?string $valorNuevo,
        ?string $ipAddress,
        ?string $ruta
    ): void {
        AuditoriaLog::create([
            'id_usuario' => $user->id,
            'modulo' => $modulo,
            'accion' => $accion,
            'valor_anterior' => $valorAnterior,
            'valor_nuevo' => $valorNuevo,
            'ip_origen' => $ipAddress,
            'ruta' => $ruta,
            'timestamp' => now(),
        ]);
    }

    private function registrarSesion(
        Usuarios $user,
        ?string $ipAddress,
        ?string $userAgent,
        ?string $ruta
    ): void {
        $sessionId = random_int(1, 2_147_483_647);

        while (Sesiones::query()->whereKey($sessionId)->exists()) {
            $sessionId = random_int(1, 2_147_483_647);
        }

        Sesiones::create([
            'id' => $sessionId,
            'id_usuario' => $user->id,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'payload' => json_encode([
                'event' => 'login_exitoso',
                'ruta' => $ruta,
                'session_id' => session()->getId(),
            ], JSON_UNESCAPED_UNICODE),
            'last_activity' => now()->timestamp,
            'fecha_inicio' => now(),
            'fecha_fin' => null,
            'estado' => true,
        ]);
    }
}