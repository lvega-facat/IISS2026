<?php

namespace Tests\Feature\Asistencias;

use Tests\TestCase;
use App\Models\Asistencias;
use App\Models\Contratos;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Modules\Asistencias\Actions\CrearAsistenciaAction;
use App\Modules\Asistencias\Actions\ActualizarAsistenciaAction;
use App\Modules\Asistencias\Actions\CrearAusenciaAction;

class AsistenciaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_crear_asistencia()
    {
        $contrato = Contratos::firstOrFail();

        $action = new CrearAsistenciaAction();

        $asistencia = $action->execute([
            'id_empleado' => $contrato->id_empleado,
            'id_contrato' => $contrato->id,
            'id_estado_asistencia' => 1,
            'fecha_entrada' => now()->addDays(10),
            'hora_entrada' => '08:00:00',
            'minutos_tardanza' => 0,
            'tiene_justificativo' => false,
        ]);

        $this->assertInstanceOf(
            Asistencias::class,
            $asistencia
        );

        $this->assertDatabaseHas(
            'asistencias',
            [
                'id' => $asistencia->id,
                'id_empleado' => $contrato->id_empleado,
            ]
        );
    }

    public function test_actualizar_asistencia()
    {
        $contrato = Contratos::firstOrFail();

        $asistencia = Asistencias::create([
            'id_empleado' => $contrato->id_empleado,
            'id_contrato' => $contrato->id,
            'id_estado_asistencia' => 1,
            'fecha_entrada' => now()->addDays(20),
            'hora_entrada' => '08:00:00',
            'tiene_justificativo' => false,
        ]);

        $action = new ActualizarAsistenciaAction();

        $actualizada = $action->execute(
            $asistencia,
            [
                'hora_salida' => '17:00:00',
                'horas_trabajadas' => 8,
                'horas_extra' => 1,
            ]
        );

        $this->assertEquals(
            8,
            $actualizada->horas_trabajadas
        );

        $this->assertDatabaseHas(
            'asistencias',
            [
                'id' => $asistencia->id,
                'horas_trabajadas' => 8,
                'horas_extra' => 1,
            ]
        );
    }

    public function test_crear_ausencia()
    {
        $contrato = Contratos::firstOrFail();

        $action = new CrearAusenciaAction();

        $ausencia = $action->execute([
            'id_empleado' => $contrato->id_empleado,
            'id_contrato' => $contrato->id,
            'id_estado_asistencia' => 3,
            'fecha_entrada' => now()->addDays(30),
            'horas_ausentes' => 8,
            'tiene_justificativo' => false,
        ]);

        $this->assertInstanceOf(
            Asistencias::class,
            $ausencia
        );

        $this->assertDatabaseHas(
            'asistencias',
            [
                'id' => $ausencia->id,
                'id_estado_asistencia' => 3,
                'horas_ausentes' => 8,
            ]
        );
    }
}