<?php

namespace Tests\Feature\HorariosTrabajo;

use Tests\TestCase;
use App\Models\HorariosTrabajo;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Modules\Contratos\HorariosTrabajo\Actions\CrearHorarioTrabajoAction;
use App\Modules\Contratos\HorariosTrabajo\Actions\ActualizarHorarioTrabajoAction;
use App\Modules\Contratos\HorariosTrabajo\Actions\EliminarHorarioTrabajoAction;

class HorarioTrabajoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_crear_horario_trabajo()
    {
        $action = new CrearHorarioTrabajoAction();

        $horario = $action->execute([
            'nombre' => 'Horario Administrativo',
            'descripcion' => 'Lunes a viernes',
            'tipo_jornada' => 'JORNADA_COMPLETA',
            'hora_entrada' => '08:00',
            'hora_salida' => '17:00',
            'horas_diarias' => 8,
            'horas_semanales' => 40,
            'tolerancia_minutos' => 10,
        ]);

        $this->assertInstanceOf(
            HorariosTrabajo::class,
            $horario
        );

        $this->assertDatabaseHas(
            'horarios_trabajo',
            [
                'id' => $horario->id,
                'nombre' => 'Horario Administrativo',
                'estado' => true,
            ]
        );
    }

    public function test_actualizar_horario_trabajo()
    {
        $horario = HorariosTrabajo::create([
            'nombre' => 'Horario Original',
            'descripcion' => 'Descripción',
            'tipo_jornada' => 'JORNADA_COMPLETA',
            'hora_entrada' => '08:00',
            'hora_salida' => '17:00',
            'horas_diarias' => 8,
            'horas_semanales' => 40,
            'tolerancia_minutos' => 10,
            'estado' => true,
        ]);

        $action = new ActualizarHorarioTrabajoAction();

        $actualizado = $action->execute(
            $horario,
            [
                'nombre' => 'Horario Actualizado',
                'descripcion' => 'Nueva descripción',
                'tipo_jornada' => 'MEDIA_JORNADA',
                'hora_entrada' => '08:00',
                'hora_salida' => '12:00',
                'horas_diarias' => 4,
                'horas_semanales' => 20,
                'tolerancia_minutos' => 5,
            ]
        );

        $this->assertEquals(
            'Horario Actualizado',
            $actualizado->nombre
        );

        $this->assertDatabaseHas(
            'horarios_trabajo',
            [
                'id' => $horario->id,
                'nombre' => 'Horario Actualizado',
                'tipo_jornada' => 'MEDIA_JORNADA',
            ]
        );
    }

    public function test_eliminar_horario_trabajo()
    {
        $horario = HorariosTrabajo::create([
            'nombre' => 'Horario Temporal',
            'descripcion' => null,
            'tipo_jornada' => 'JORNADA_COMPLETA',
            'hora_entrada' => '08:00',
            'hora_salida' => '17:00',
            'horas_diarias' => 8,
            'horas_semanales' => 40,
            'tolerancia_minutos' => 10,
            'estado' => true,
        ]);

        $action = new EliminarHorarioTrabajoAction();

        $resultado = $action->execute(
            $horario
        );

        $this->assertFalse(
            $resultado->estado
        );

        $this->assertDatabaseHas(
            'horarios_trabajo',
            [
                'id' => $horario->id,
                'estado' => false,
            ]
        );
    }

    public function test_eliminacion_es_logica()
    {
        $horario = HorariosTrabajo::create([
            'nombre' => 'Horario Activo',
            'descripcion' => null,
            'tipo_jornada' => 'JORNADA_COMPLETA',
            'hora_entrada' => '08:00',
            'hora_salida' => '17:00',
            'horas_diarias' => 8,
            'horas_semanales' => 40,
            'tolerancia_minutos' => 10,
            'estado' => true,
        ]);

        (new EliminarHorarioTrabajoAction())
            ->execute($horario);


        $this->assertDatabaseHas(
            'horarios_trabajo',
            [
                'id' => $horario->id,
                'estado' => false,
            ]
        );
    }
}