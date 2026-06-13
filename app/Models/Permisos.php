<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permisos
 * 
 * @property int $id
 * @property int $id_modulo
 * @property string $accion
 * 
 * @property Modulos $modulos
 * @property Collection|RolPermiso[] $rol_permisos
 *
 * @package App\Models
 */
class Permisos extends Model
{
	protected $table = 'permisos';
	public $timestamps = false;

	protected $casts = [
		'id_modulo' => 'int'
	];

	protected $fillable = [
		'id_modulo',
		'accion'
	];

	public function modulos()
	{
		return $this->belongsTo(Modulos::class, 'id_modulo');
	}

	public function rol_permisos()
	{
		return $this->hasMany(RolPermiso::class, 'id_permiso');
	}
}
