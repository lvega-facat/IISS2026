<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DepartamentoDependiente
 * 
 * @property int $id_dependencia
 * @property int $id_departamento_padre
 * @property int $id_departamento_hijo
 * @property string|null $tipo_dependencia
 * 
 * @property Departamentos $departamentos
 *
 * @package App\Models
 */
class DepartamentoDependiente extends Model
{
	protected $table = 'departamento_dependiente';
	protected $primaryKey = 'id_dependencia';
	public $timestamps = false;

	protected $casts = [
		'id_departamento_padre' => 'int',
		'id_departamento_hijo' => 'int'
	];

	protected $fillable = [
		'id_departamento_padre',
		'id_departamento_hijo',
		'tipo_dependencia'
	];

	public function departamentos()
	{
		return $this->belongsTo(Departamentos::class, 'id_departamento_hijo');
	}
}
