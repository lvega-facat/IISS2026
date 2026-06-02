<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contratos
 * 
 * @property int $id
 * @property int $id_empleado
 * @property int $id_tipo_contrato
 * @property float $monto_base
 * @property Carbon $fecha_inicio
 * @property int $id_tipo_pago
 * @property int $id_frecuencia_pago
 * @property Carbon|null $fecha_fin
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Empleados $empleados
 * @property TiposContrato $tipos_contrato
 * @property TiposPago $tipos_pago
 * @property FrecuenciasPago $frecuencias_pago
 * @property Collection|Asistencias[] $asistencias
 * @property Collection|PlanillaDetalles[] $planilla_detalles
 *
 * @package App\Models
 */
class Contratos extends Model
{
	protected $table = 'contratos';

	protected $casts = [
		'id_empleado' => 'int',
		'id_tipo_contrato' => 'int',
		'monto_base' => 'float',
		'fecha_inicio' => 'datetime',
		'id_tipo_pago' => 'int',
		'id_frecuencia_pago' => 'int',
		'fecha_fin' => 'datetime',
		'estado' => 'bool'
	];

	protected $fillable = [
		'id_empleado',
		'id_tipo_contrato',
		'monto_base',
		'fecha_inicio',
		'id_tipo_pago',
		'id_frecuencia_pago',
		'fecha_fin',
		'estado'
	];

	public function empleados()
	{
		return $this->belongsTo(Empleados::class, 'id_empleado');
	}

	public function tipos_contrato()
	{
		return $this->belongsTo(TiposContrato::class, 'id_tipo_contrato');
	}

	public function tipos_pago()
	{
		return $this->belongsTo(TiposPago::class, 'id_tipo_pago');
	}

	public function frecuencias_pago()
	{
		return $this->belongsTo(FrecuenciasPago::class, 'id_frecuencia_pago');
	}

	public function asistencias()
	{
		return $this->hasMany(Asistencias::class, 'id_contrato');
	}

	public function planilla_detalles()
	{
		return $this->hasMany(PlanillaDetalles::class, 'id_contrato');
	}
}
