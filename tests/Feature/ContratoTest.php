<?php

namespace Tests\Feature\Contratos;

use Tests\TestCase;
use App\Models\Contratos;
use App\Models\Empleados;
use App\Models\TiposContrato;
use App\Models\TiposPago;
use App\Models\FrecuenciasPago;

use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Modules\Contratos\Actions\CrearContratoAction;
use App\Modules\Contratos\Actions\ActualizarContratoAction;
use App\Modules\Contratos\Actions\FinalizarContratoAction;

class ContratoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_crear_contrato()
    {
        $empleado = Empleados::firstOrFail();

        $tipoContrato = TiposContrato::firstOrFail();
        $tipoPago = TiposPago::firstOrFail();
        $frecuencia = FrecuenciasPago::firstOrFail();

        $action = new CrearContratoAction();

        $contrato = $action->execute([
            'id_empleado' => $empleado->id,
            'id_tipo_contrato' => $tipoContrato->id,
            'monto_base' => 5000000,
            'fecha_inicio' => now(),
            'id_tipo_pago' => $tipoPago->id,
            'id_frecuencia_pago' => $frecuencia->id,
        ]);

        $this->assertInstanceOf(
            Contratos::class,
            $contrato
        );

        $this->assertDatabaseHas('contratos', [
            'id' => $contrato->id,
            'id_empleado' => $empleado->id,
        ]);
    }


    public function test_actualizar_contrato()
    {
        $contrato = Contratos::firstOrFail();

        $action = new ActualizarContratoAction();

        $actualizado = $action->execute(
            $contrato,
            [
                'id_tipo_contrato' => $contrato->id_tipo_contrato,
                'monto_base' => 7500000,
                'fecha_inicio' => $contrato->fecha_inicio,
                'id_tipo_pago' => $contrato->id_tipo_pago,
                'id_frecuencia_pago' => $contrato->id_frecuencia_pago,
                'fecha_fin' => null,
            ]
        );

        $this->assertEquals(
            7500000,
            $actualizado->monto_base
        );

        $this->assertDatabaseHas('contratos', [
            'id' => $contrato->id,
            'monto_base' => 7500000,
        ]);
    }

    public function test_finalizar_contrato()
    {
        $contrato = Contratos::firstOrFail();

        $action = new FinalizarContratoAction();

        $resultado = $action->execute(
            $contrato,
            now()->toDateString()
        );

        $this->assertFalse(
            $resultado->estado
        );

        $this->assertDatabaseHas('contratos', [
            'id' => $contrato->id,
            'estado' => false,
        ]);
    }

    public function test_finalizar_contrato_asigna_fecha_fin()
    {
        $contrato = Contratos::firstOrFail();

        $fechaFin = '2026-06-30';

        $action = new FinalizarContratoAction();

        $action->execute(
            $contrato,
            $fechaFin
        );

        $this->assertDatabaseHas('contratos', [
            'id' => $contrato->id,
            'estado' => false,
        ]);

        $this->assertEquals(
            $fechaFin,
            $contrato->fresh()
                ->fecha_fin
                ->format('Y-m-d')
        );
    }
}