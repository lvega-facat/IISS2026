<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposContrato
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $id_profesion
 * @property int $id_horario
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Profesiones $profesiones
 * @property HorariosTrabajo $horarios_trabajo
 * @property Collection|Contratos[] $contratos
 *
 * @package App\Models
 */
class TiposContrato extends Model
{
	protected $table = 'tipos_contrato';

	protected $casts = [
		'id_profesion' => 'int',
		'id_horario' => 'int',
		'estado' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'id_profesion',
		'id_horario',
		'estado'
	];

	public function profesiones()
	{
		return $this->belongsTo(Profesiones::class, 'id_profesion');
	}

	public function horarios_trabajo()
	{
		return $this->belongsTo(HorariosTrabajo::class, 'id_horario');
	}

	public function contratos()
	{
		return $this->hasMany(Contratos::class, 'id_tipo_contrato');
	}
}
