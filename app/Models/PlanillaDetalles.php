<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlanillaDetalles
 * 
 * @property int $id
 * @property int $id_planilla
 * @property int $id_empleado
 * @property int $id_contrato
 * @property float $salario_base_aplicado
 * @property float|null $horas_trabajadas
 * @property float|null $horas_extra
 * @property float|null $total_horas_extra_monto
 * @property float|null $bonos
 * @property float|null $descuentos
 * @property float $total_bruto
 * @property float $total_pagar
 * @property string|null $estado_pago
 * @property string|null $unidad_calculo_aplicada
 * @property int|null $frecuencia_dias_aplicada
 * @property float|null $horas_diarias_aplicadas
 * @property Carbon|null $created_at
 * 
 * @property Planillas $planillas
 * @property Empleados $empleados
 * @property Contratos $contratos
 *
 * @package App\Models
 */
class PlanillaDetalles extends Model
{
	protected $table = 'planilla_detalles';
	public $timestamps = false;

	protected $casts = [
		'id_planilla' => 'int',
		'id_empleado' => 'int',
		'id_contrato' => 'int',
		'salario_base_aplicado' => 'float',
		'horas_trabajadas' => 'float',
		'horas_extra' => 'float',
		'total_horas_extra_monto' => 'float',
		'bonos' => 'float',
		'descuentos' => 'float',
		'total_bruto' => 'float',
		'total_pagar' => 'float',
		'frecuencia_dias_aplicada' => 'int',
		'horas_diarias_aplicadas' => 'float'
	];

	protected $fillable = [
		'id_planilla',
		'id_empleado',
		'id_contrato',
		'salario_base_aplicado',
		'horas_trabajadas',
		'horas_extra',
		'total_horas_extra_monto',
		'bonos',
		'descuentos',
		'total_bruto',
		'total_pagar',
		'estado_pago',
		'unidad_calculo_aplicada',
		'frecuencia_dias_aplicada',
		'horas_diarias_aplicadas'
	];

	public function planillas()
	{
		return $this->belongsTo(Planillas::class, 'id_planilla');
	}

	public function empleados()
	{
		return $this->belongsTo(Empleados::class, 'id_empleado');
	}

	public function contratos()
	{
		return $this->belongsTo(Contratos::class, 'id_contrato');
	}
}
