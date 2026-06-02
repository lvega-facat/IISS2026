<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sesiones
 * 
 * @property int $id
 * @property int $id_usuario
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $payload
 * @property int|null $last_activity
 * @property Carbon|null $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property bool|null $estado
 * 
 * @property Usuarios $usuarios
 *
 * @package App\Models
 */
class Sesiones extends Model
{
	protected $table = 'sesiones';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'id_usuario' => 'int',
		'last_activity' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime',
		'estado' => 'bool'
	];

	protected $fillable = [
		'id_usuario',
		'ip_address',
		'user_agent',
		'payload',
		'last_activity',
		'fecha_inicio',
		'fecha_fin',
		'estado'
	];

	public function usuarios()
	{
		return $this->belongsTo(Usuarios::class, 'id_usuario');
	}
}
