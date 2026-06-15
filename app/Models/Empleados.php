<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Empleados
 * 
 * @property int $id
 * @property int $id_departamento
 * @property int|null $id_cargo
 * @property int|null $id_profesion
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $dni_ci
 * @property string|null $telefono
 * @property string|null $tipo_trabajo
 * @property Carbon $fecha_registro
 * @property string|null $descripcion
 * @property string|null $foto_url
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Departamentos $departamentos
 * @property Cargos|null $cargos
 * @property Profesiones|null $profesiones
 * @property Collection|Asistencias[] $asistencias
 * @property Collection|Contratos[] $contratos
 * @property Collection|PlanillaDetalles[] $planilla_detalles
 * @property Collection|Usuarios[] $usuarios
 *
 * @package App\Models
 */
class Empleados extends Model
{
	use SoftDeletes;

	protected $table = 'empleados';

	protected $casts = [
		'id_departamento' => 'int',
		'id_cargo' => 'int',
		'id_profesion' => 'int',
		'fecha_registro' => 'datetime',
		'estado' => 'bool'
	];

	protected $fillable = [
		'id_departamento',
		'id_cargo',
		'id_profesion',
		'nombre',
		'apellido',
		'email',
		'dni_ci',
		'telefono',
		'tipo_trabajo',
		'fecha_registro',
		'descripcion',
		'foto_url',
		'estado'
	];

	public function departamentos()
	{
		return $this->belongsTo(Departamentos::class, 'id_departamento');
	}

	public function cargos()
	{
		return $this->belongsTo(Cargos::class, 'id_cargo');
	}

	public function profesiones()
	{
		return $this->belongsTo(Profesiones::class, 'id_profesion');
	}

	public function asistencias()
	{
		return $this->hasMany(Asistencias::class, 'id_empleado');
	}

	public function contratos()
	{
		return $this->hasMany(Contratos::class, 'id_empleado');
	}

	public function planilla_detalles()
	{
		return $this->hasMany(PlanillaDetalles::class, 'id_empleado');
	}

	public function usuarios()
	{
		return $this->hasMany(Usuarios::class, 'id_empleado');
	}
}
