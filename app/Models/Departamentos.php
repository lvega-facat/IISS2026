<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Departamentos
 * 
 * @property int $id
 * @property int $id_organizacion
 * @property string $nombre
 * @property string|null $descripcion
 * @property string|null $codigo
 * @property string|null $funcion_principal
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Organizaciones $organizaciones
 * @property Collection|Cargos[] $cargos
 * @property Collection|DepartamentoDependiente[] $departamento_dependientes
 * @property Collection|Empleados[] $empleados
 *
 * @package App\Models
 */
class Departamentos extends Model
{
	protected $table = 'departamentos';

	protected $casts = [
		'id_organizacion' => 'int',
		'estado' => 'bool'
	];

	protected $fillable = [
		'id_organizacion',
		'nombre',
		'descripcion',
		'codigo',
		'funcion_principal',
		'estado'
	];

	public function organizaciones()
	{
		return $this->belongsTo(Organizaciones::class, 'id_organizacion');
	}

	public function cargos()
	{
		return $this->hasMany(Cargos::class, 'id_departamento');
	}

	public function departamento_dependientes()
	{
		return $this->hasMany(DepartamentoDependiente::class, 'id_departamento_hijo');
	}

	public function empleados()
	{
		return $this->hasMany(Empleados::class, 'id_departamento');
	}
}
