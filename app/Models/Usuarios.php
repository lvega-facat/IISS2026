<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuarios
 * 
 * @property int $id
 * @property int|null $id_empleado
 * @property int $id_rol
 * @property int $id_organizacion
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $password_hash
 * @property string|null $foto_url
 * @property bool $estado
 * @property int|null $intentos_fallidos
 * @property Carbon|null $bloqueado_hasta
 * @property Carbon|null $ultimo_acceso
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Empleados|null $empleados
 * @property Roles $roles
 * @property Organizaciones $organizaciones
 * @property Collection|CambiosPermisos[] $cambios_permisos
 * @property Collection|Sesiones[] $sesiones
 * @property Collection|Justificativos[] $justificativos
 * @property Collection|Planillas[] $planillas
 * @property Collection|AuditoriaLog[] $auditoria_logs
 *
 * @package App\Models
 */
class Usuarios extends Model
{
	protected $table = 'usuarios';

	protected $casts = [
		'id_empleado' => 'int',
		'id_rol' => 'int',
		'id_organizacion' => 'int',
		'estado' => 'bool',
		'intentos_fallidos' => 'int',
		'bloqueado_hasta' => 'datetime',
		'ultimo_acceso' => 'datetime'
	];

	protected $fillable = [
		'id_empleado',
		'id_rol',
		'id_organizacion',
		'nombre',
		'apellido',
		'email',
		'password_hash',
		'foto_url',
		'estado',
		'intentos_fallidos',
		'bloqueado_hasta',
		'ultimo_acceso'
	];

	public function empleados()
	{
		return $this->belongsTo(Empleados::class, 'id_empleado');
	}

	public function roles()
	{
		return $this->belongsTo(Roles::class, 'id_rol');
	}

	public function organizaciones()
	{
		return $this->belongsTo(Organizaciones::class, 'id_organizacion');
	}

	public function cambios_permisos()
	{
		return $this->hasMany(CambiosPermisos::class, 'id_usuario');
	}

	public function sesiones()
	{
		return $this->hasMany(Sesiones::class, 'id_usuario');
	}

	public function justificativos()
	{
		return $this->hasMany(Justificativos::class, 'id_aprobador');
	}

	public function planillas()
	{
		return $this->hasMany(Planillas::class, 'generado_por');
	}

	public function auditoria_logs()
	{
		return $this->hasMany(AuditoriaLog::class, 'id_usuario');
	}
}
