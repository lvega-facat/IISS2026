<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AuditoriaLog
 * 
 * @property int $id
 * @property int|null $id_usuario
 * @property string $modulo
 * @property string $accion
 * @property string|null $valor_anterior
 * @property string|null $valor_nuevo
 * @property string|null $ip_origen
 * @property string|null $ruta
 * @property Carbon $timestamp
 * 
 * @property Usuarios|null $usuarios
 *
 * @package App\Models
 */
class AuditoriaLog extends Model
{
	protected $table = 'auditoria_log';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'timestamp' => 'datetime'
	];

	protected $fillable = [
		'id_usuario',
		'modulo',
		'accion',
		'valor_anterior',
		'valor_nuevo',
		'ip_origen',
		'ruta',
		'timestamp'
	];

	public function usuarios()
	{
		return $this->belongsTo(Usuarios::class, 'id_usuario');
	}
}
