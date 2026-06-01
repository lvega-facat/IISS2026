<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profesiones
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TiposContrato[] $tipos_contratos
 * @property Collection|Empleados[] $empleados
 *
 * @package App\Models
 */
class Profesiones extends Model
{
	protected $table = 'profesiones';

	protected $casts = [
		'estado' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'estado'
	];

	public function tipos_contratos()
	{
		return $this->hasMany(TiposContrato::class, 'id_profesion');
	}

	public function empleados()
	{
		return $this->hasMany(Empleados::class, 'id_profesion');
	}
}
