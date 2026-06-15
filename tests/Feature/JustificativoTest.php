<?php

namespace Tests\Feature\Justificativos;

use Tests\TestCase;
use App\Models\Justificativos;
use App\Models\Asistencias;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Modules\Justificativos\Actions\CrearJustificativoAction;
use App\Modules\Justificativos\Actions\ActualizarJustificativoAction;
use App\Modules\Justificativos\Actions\RechazarJustificativoAction;

class JustificativoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_crear_justificativo()
    {
        $asistencia = Asistencias::firstOrFail();

        $action = new CrearJustificativoAction();

        $justificativo = $action->execute([
            'id_asistencia' => $asistencia->id,
            'tipo_justificativo' => 'reposo_medico',
            'descripcion' => 'Certificado médico',
            'archivo_url' => 'archivo.pdf',
            'estado_aprobacion' => 'pendiente',
        ]);

        $this->assertInstanceOf(
            Justificativos::class,
            $justificativo
        );

        $this->assertDatabaseHas(
            'justificativos',
            [
                'id' => $justificativo->id,
                'tipo_justificativo' => 'reposo_medico',
                'estado_aprobacion' => 'pendiente',
            ]
        );
    }

    public function test_actualizar_justificativo()
    {
        $asistencia = Asistencias::firstOrFail();

        $justificativo = Justificativos::create([
            'id_asistencia' => $asistencia->id,
            'tipo_justificativo' => 'reposo_medico',
            'descripcion' => 'Original',
            'estado_aprobacion' => 'pendiente',
        ]);

        $action = new ActualizarJustificativoAction();

        $actualizado = $action->execute(
            $justificativo,
            [
                'tipo_justificativo' => 'permiso_personal',
                'descripcion' => 'Actualizado',
                'archivo_url' => 'nuevo.pdf',
            ]
        );

        $this->assertEquals(
            'permiso_personal',
            $actualizado->tipo_justificativo
        );

        $this->assertDatabaseHas(
            'justificativos',
            [
                'id' => $justificativo->id,
                'tipo_justificativo' => 'permiso_personal',
                'descripcion' => 'Actualizado',
            ]
        );
    }

    public function test_rechazar_justificativo()
    {
        $asistencia = Asistencias::firstOrFail();

        $justificativo = Justificativos::create([
            'id_asistencia' => $asistencia->id,
            'tipo_justificativo' => 'reposo_medico',
            'descripcion' => 'Pendiente',
            'estado_aprobacion' => 'pendiente',
        ]);

        $actualizado = (
            new RechazarJustificativoAction()
        )->execute(
            $justificativo,
            1
        );

        $this->assertEquals(
            'rechazado',
            $actualizado->estado_aprobacion
        );

        $this->assertNotNull(
            $actualizado->fecha_aprobacion
        );

        $this->assertDatabaseHas(
            'justificativos',
            [
                'id' => $justificativo->id,
                'estado_aprobacion' => 'rechazado',
                'id_aprobador' => 1,
            ]
        );
    }
}