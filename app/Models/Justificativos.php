<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Justificativos
 * 
 * @property int $id
 * @property int $id_asistencia
 * @property int|null $id_aprobador
 * @property string $tipo_justificativo
 * @property string|null $descripcion
 * @property string|null $archivo_url
 * @property string $estado_aprobacion
 * @property Carbon|null $fecha_aprobacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Asistencias $asistencias
 * @property Usuarios|null $usuarios
 *
 * @package App\Models
 */
class Justificativos extends Model
{
	protected $table = 'justificativos';

	protected $casts = [
		'id_asistencia' => 'int',
		'id_aprobador' => 'int',
		'fecha_aprobacion' => 'datetime'
	];

	protected $fillable = [
		'id_asistencia',
		'id_aprobador',
		'tipo_justificativo',
		'descripcion',
		'archivo_url',
		'estado_aprobacion',
		'fecha_aprobacion'
	];

	public function asistencias()
	{
		return $this->belongsTo(Asistencias::class, 'id_asistencia');
	}

	public function usuarios()
	{
		return $this->belongsTo(Usuarios::class, 'id_aprobador');
	}
}
