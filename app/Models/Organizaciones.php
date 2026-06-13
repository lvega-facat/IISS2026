<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Organizaciones
 * 
 * @property int $id
 * @property string $nombre
 * @property string $ruc
 * @property Carbon $fecha_registro
 * @property string|null $direccion
 * @property string|null $pais
 * @property string|null $email
 * @property string|null $telefono
 * @property string|null $sector
 * @property string|null $logo_url
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Departamentos[] $departamentos
 * @property Collection|Usuarios[] $usuarios
 * @property Collection|Planillas[] $planillas
 *
 * @package App\Models
 */
class Organizaciones extends Model
{
	protected $table = 'organizaciones';

	protected $casts = [
		'fecha_registro' => 'datetime',
		'estado' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'ruc',
		'fecha_registro',
		'direccion',
		'pais',
		'email',
		'telefono',
		'sector',
		'logo_url',
		'estado'
	];

	public function departamentos()
	{
		return $this->hasMany(Departamentos::class, 'id_organizacion');
	}

	public function usuarios()
	{
		return $this->hasMany(Usuarios::class, 'id_organizacion');
	}

	public function planillas()
	{
		return $this->hasMany(Planillas::class, 'id_organizacion');
	}
}
