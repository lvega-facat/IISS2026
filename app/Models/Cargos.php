<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cargos
 * 
 * @property int $id
 * @property int $id_departamento
 * @property int|null $id_cargo_padre
 * @property string $nombre
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Departamentos $departamentos
 * @property Collection|Cargos[] $cargos
 * @property Collection|Empleados[] $empleados
 *
 * @package App\Models
 */
class Cargos extends Model
{
	protected $table = 'cargos';

	protected $casts = [
		'id_departamento' => 'int',
		'id_cargo_padre' => 'int',
		'estado' => 'bool'
	];

	protected $fillable = [
		'id_departamento',
		'id_cargo_padre',
		'nombre',
		'estado'
	];

	public function departamentos()
	{
		return $this->belongsTo(Departamentos::class, 'id_departamento');
	}

	public function cargos()
	{
		return $this->hasMany(Cargos::class, 'id_cargo_padre');
	}

	public function empleados()
	{
		return $this->hasMany(Empleados::class, 'id_cargo');
	}
}
