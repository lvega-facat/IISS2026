<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Modulos
 * 
 * @property int $id
 * @property string $nombre
 * @property string $slug
 * 
 * @property Collection|Permisos[] $permisos
 * @property Collection|CambiosPermisos[] $cambios_permisos
 *
 * @package App\Models
 */
class Modulos extends Model
{
	protected $table = 'modulos';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'slug'
	];

	public function permisos()
	{
		return $this->hasMany(Permisos::class, 'id_modulo');
	}

	public function cambios_permisos()
	{
		return $this->hasMany(CambiosPermisos::class, 'id_modulo');
	}
}
