<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Asistencias
 * 
 * @property int $id
 * @property int $id_empleado
 * @property int $id_contrato
 * @property int $id_estado_asistencia
 * @property Carbon $fecha_entrada
 * @property time without time zone|null $hora_entrada
 * @property time without time zone|null $hora_salida
 * @property int|null $minutos_tardanza
 * @property float|null $horas_trabajadas
 * @property float|null $horas_extra
 * @property float|null $horas_ausentes
 * @property bool|null $tiene_justificativo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Empleados $empleados
 * @property Contratos $contratos
 * @property CatEstadosAsistencia $cat_estados_asistencia
 * @property Collection|Justificativos[] $justificativos
 *
 * @package App\Models
 */
class Asistencias extends Model
{
	protected $table = 'asistencias';

	protected $casts = [
		'id_empleado' => 'int',
		'id_contrato' => 'int',
		'id_estado_asistencia' => 'int',
		'fecha_entrada' => 'datetime',
		'hora_entrada' => 'time without time zone',
		'hora_salida' => 'time without time zone',
		'minutos_tardanza' => 'int',
		'horas_trabajadas' => 'float',
		'horas_extra' => 'float',
		'horas_ausentes' => 'float',
		'tiene_justificativo' => 'bool'
	];

	protected $fillable = [
		'id_empleado',
		'id_contrato',
		'id_estado_asistencia',
		'fecha_entrada',
		'hora_entrada',
		'hora_salida',
		'minutos_tardanza',
		'horas_trabajadas',
		'horas_extra',
		'horas_ausentes',
		'tiene_justificativo'
	];

	public function empleados()
	{
		return $this->belongsTo(Empleados::class, 'id_empleado');
	}

	public function contratos()
	{
		return $this->belongsTo(Contratos::class, 'id_contrato');
	}

	public function cat_estados_asistencia()
	{
		return $this->belongsTo(CatEstadosAsistencia::class, 'id_estado_asistencia');
	}

	public function justificativos()
	{
		return $this->hasMany(Justificativos::class, 'id_asistencia');
	}
}
