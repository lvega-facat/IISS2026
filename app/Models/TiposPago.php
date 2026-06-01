<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposPago
 * 
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * @property USER-DEFINED $unidad_calculo
 * @property string|null $descripcion
 * @property bool|null $estado
 * @property Carbon|null $created_at
 * 
 * @property Collection|Contratos[] $contratos
 *
 * @package App\Models
 */
class TiposPago extends Model
{
	protected $table = 'tipos_pago';
	public $timestamps = false;

	protected $casts = [
		'unidad_calculo' => 'USER-DEFINED',
		'estado' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'codigo',
		'unidad_calculo',
		'descripcion',
		'estado'
	];

	public function contratos()
	{
		return $this->hasMany(Contratos::class, 'id_tipo_pago');
	}
}
