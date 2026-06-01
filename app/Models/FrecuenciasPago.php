<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FrecuenciasPago
 * 
 * @property int $id
 * @property string $nombre
 * @property int $dias
 * @property bool $estado
 * @property Carbon|null $created_at
 * 
 * @property Collection|Contratos[] $contratos
 *
 * @package App\Models
 */
class FrecuenciasPago extends Model
{
	protected $table = 'frecuencias_pago';
	public $timestamps = false;

	protected $casts = [
		'dias' => 'int',
		'estado' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'dias',
		'estado'
	];

	public function contratos()
	{
		return $this->hasMany(Contratos::class, 'id_frecuencia_pago');
	}
}
