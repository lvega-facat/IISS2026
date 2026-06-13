<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Roles
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|RolPermiso[] $rol_permisos
 * @property Collection|Usuarios[] $usuarios
 * @property Collection|CambiosPermisos[] $cambios_permisos
 *
 * @package App\Models
 */
class Roles extends Model
{
	protected $table = 'roles';

	protected $casts = [
		'estado' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'estado'
	];

	public function rol_permisos()
	{
		return $this->hasMany(RolPermiso::class, 'id_rol');
	}

	public function usuarios()
	{
		return $this->hasMany(Usuarios::class, 'id_rol');
	}

	public function cambios_permisos()
	{
		return $this->hasMany(CambiosPermisos::class, 'id_rol');
	}
}
