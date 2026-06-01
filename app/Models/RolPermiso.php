<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RolPermiso
 * 
 * @property int $id
 * @property int $id_rol
 * @property int $id_permiso
 * 
 * @property Roles $roles
 * @property Permisos $permisos
 *
 * @package App\Models
 */
class RolPermiso extends Model
{
	protected $table = 'rol_permiso';
	public $timestamps = false;

	protected $casts = [
		'id_rol' => 'int',
		'id_permiso' => 'int'
	];

	protected $fillable = [
		'id_rol',
		'id_permiso'
	];

	public function roles()
	{
		return $this->belongsTo(Roles::class, 'id_rol');
	}

	public function permisos()
	{
		return $this->belongsTo(Permisos::class, 'id_permiso');
	}
}
