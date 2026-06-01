<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Planillas
 * 
 * @property int $id
 * @property int $id_organizacion
 * @property Carbon $periodo_inicio
 * @property Carbon $periodo_fin
 * @property string $estado
 * @property int $generado_por
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Organizaciones $organizaciones
 * @property Usuarios $usuarios
 * @property Collection|PlanillaDetalles[] $planilla_detalles
 *
 * @package App\Models
 */
class Planillas extends Model
{
	protected $table = 'planillas';

	protected $casts = [
		'id_organizacion' => 'int',
		'periodo_inicio' => 'datetime',
		'periodo_fin' => 'datetime',
		'generado_por' => 'int'
	];

	protected $fillable = [
		'id_organizacion',
		'periodo_inicio',
		'periodo_fin',
		'estado',
		'generado_por'
	];

	public function organizaciones()
	{
		return $this->belongsTo(Organizaciones::class, 'id_organizacion');
	}

	public function usuarios()
	{
		return $this->belongsTo(Usuarios::class, 'generado_por');
	}

	public function planilla_detalles()
	{
		return $this->hasMany(PlanillaDetalles::class, 'id_planilla');
	}
}
