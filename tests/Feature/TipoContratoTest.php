<?php

namespace Tests\Feature\TiposContrato;

use Tests\TestCase;
use App\Models\TiposContrato;
use App\Models\Profesiones;
use App\Models\HorariosTrabajo;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Modules\Contratos\TiposContrato\Actions\CrearTipoContratoAction;
use App\Modules\Contratos\TiposContrato\Actions\ActualizarTipoContratoAction;
use App\Modules\Contratos\TiposContrato\Actions\EliminarTipoContratoAction;

class TipoContratoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_crear_tipo_contrato()
    {
        $profesion = Profesiones::firstOrFail();
        $horario = HorariosTrabajo::firstOrFail();

        $action = new CrearTipoContratoAction();

        $tipoContrato = $action->execute([
            'nombre' => 'Contrato Administrativo',
            'descripcion' => 'Contrato para personal administrativo',
            'id_profesion' => $profesion->id,
            'id_horario' => $horario->id,
        ]);

        $this->assertInstanceOf(
            TiposContrato::class,
            $tipoContrato
        );

        $this->assertDatabaseHas(
            'tipos_contrato',
            [
                'id' => $tipoContrato->id,
                'nombre' => 'Contrato Administrativo',
                'estado' => true,
            ]
        );
    }

    public function test_actualizar_tipo_contrato()
    {
        $tipoContrato = TiposContrato::firstOrFail();

        $profesion = Profesiones::firstOrFail();
        $horario = HorariosTrabajo::firstOrFail();

        $action = new ActualizarTipoContratoAction();

        $actualizado = $action->execute(
            $tipoContrato,
            [
                'nombre' => 'Contrato Actualizado',
                'descripcion' => 'Descripción actualizada',
                'id_profesion' => $profesion->id,
                'id_horario' => $horario->id,
            ]
        );

        $this->assertEquals(
            'Contrato Actualizado',
            $actualizado->nombre
        );

        $this->assertDatabaseHas(
            'tipos_contrato',
            [
                'id' => $tipoContrato->id,
                'nombre' => 'Contrato Actualizado',
            ]
        );
    }

    public function test_eliminar_tipo_contrato()
    {
        $profesion = Profesiones::firstOrFail();
        $horario = HorariosTrabajo::firstOrFail();

        $tipoContrato = TiposContrato::create([
            'nombre' => 'Contrato Temporal',
            'descripcion' => 'Temporal',
            'id_profesion' => $profesion->id,
            'id_horario' => $horario->id,
            'estado' => true,
        ]);

        $action = new EliminarTipoContratoAction();

        $resultado = $action->execute(
            $tipoContrato
        );

        $this->assertFalse(
            $resultado->estado
        );

        $this->assertDatabaseHas(
            'tipos_contrato',
            [
                'id' => $tipoContrato->id,
                'estado' => false,
            ]
        );
    }

    public function test_eliminacion_es_logica()
    {
        $profesion = Profesiones::firstOrFail();
        $horario = HorariosTrabajo::firstOrFail();

        $tipoContrato = TiposContrato::create([
            'nombre' => 'Contrato Prueba',
            'descripcion' => null,
            'id_profesion' => $profesion->id,
            'id_horario' => $horario->id,
            'estado' => true,
        ]);

        (new EliminarTipoContratoAction())
            ->execute($tipoContrato);


        $this->assertDatabaseHas(
            'tipos_contrato',
            [
                'id' => $tipoContrato->id,
                'estado' => false,
            ]
        );
    }
}