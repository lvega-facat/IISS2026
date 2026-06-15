<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HorariosTrabajo
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string $tipo_jornada
 * @property time without time zone $hora_entrada
 * @property time without time zone $hora_salida
 * @property float|null $horas_diarias
 * @property float|null $horas_semanales
 * @property int|null $tolerancia_minutos
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TiposContrato[] $tipos_contratos
 *
 * @package App\Models
 */
class HorariosTrabajo extends Model
{
	protected $table = 'horarios_trabajo';

	protected $fillable = [
		'nombre',
		'descripcion',
		'tipo_jornada',
		'hora_entrada',
		'hora_salida',
		'horas_diarias',
		'horas_semanales',
		'tolerancia_minutos',
		'estado'
	];

	public function tipos_contratos()
	{
		return $this->hasMany(TiposContrato::class, 'id_horario');
	}
}
