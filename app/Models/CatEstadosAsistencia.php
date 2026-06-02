<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CatEstadosAsistencia
 * 
 * @property int $id
 * @property string $nombre
 * 
 * @property Collection|Asistencias[] $asistencias
 *
 * @package App\Models
 */
class CatEstadosAsistencia extends Model
{
	protected $table = 'cat_estados_asistencia';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function asistencias()
	{
		return $this->hasMany(Asistencias::class, 'id_estado_asistencia');
	}
}
