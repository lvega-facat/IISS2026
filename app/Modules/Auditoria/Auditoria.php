<?php

namespace App\Modules\Auditoria;
use App\Models\AuditoriaLog;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
/**
 * 	protected $fillable = [
		'id_usuario',
		'modulo',
		'accion',
		'valor_anterior',
		'valor_nuevo',
		'ip_origen',
		'ruta',
		'timestamp'
	];
 * Clase para registrar auditoría de acciones en el sistema.
 */
class Auditoria
{
    /**
     * Registra una acción en el log de auditoría.
     *
     * @param string $modulo El módulo donde ocurrió la acción.
     * @param string $accion La acción realizada (crear, editar, eliminar).
     * @param string|null $valorAnterior El valor anterior (opcional).
     * @param string|null $valorNuevo El valor nuevo (opcional).
     */
    public static function registrarAuditoria(array $context, string $accion, ?array $valorAnterior, ?array $valorNuevo): void
	{
		AuditoriaLog::create([
			'id_usuario' => $context['id_usuario'] ?? null,
			'modulo' => 'roles',
			'accion' => $accion,
			'valor_anterior' => $valorAnterior ? json_encode($valorAnterior) : null,
			'valor_nuevo' => $valorNuevo ? json_encode($valorNuevo) : null,
			'ip_origen' => $context['ip_origen'] ?? null,
			'ruta' => $context['ruta'] ?? null,
			'timestamp' => now(),
		]);
	}
}