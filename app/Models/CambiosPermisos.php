<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CambiosPermisos
 * 
 * @property int $id
 * @property int $id_usuario
 * @property int $id_rol
 * @property int $id_modulo
 * @property string|null $accion
 * @property Carbon|null $timestamp
 * 
 * @property Usuarios $usuarios
 * @property Roles $roles
 * @property Modulos $modulos
 *
 * @package App\Models
 */
class CambiosPermisos extends Model
{
	protected $table = 'cambios_permisos';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'id_rol' => 'int',
		'id_modulo' => 'int',
		'timestamp' => 'datetime'
	];

	protected $fillable = [
		'id_usuario',
		'id_rol',
		'id_modulo',
		'accion',
		'timestamp'
	];

	public function usuarios()
	{
		return $this->belongsTo(Usuarios::class, 'id_usuario');
	}

	public function roles()
	{
		return $this->belongsTo(Roles::class, 'id_rol');
	}

	public function modulos()
	{
		return $this->belongsTo(Modulos::class, 'id_modulo');
	}
}
