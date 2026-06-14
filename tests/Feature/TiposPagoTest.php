<?php

namespace Tests\Feature\TiposPagos;

use Tests\TestCase;
use App\Models\TiposPago;
use App\Models\Usuarios;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TiposPagoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    private function adminUser(): Usuarios
    {
        return Usuarios::where('email', 'admin@empresademo.com')->firstOrFail();
    }

    private function tipoPago(array $overrides = []): TiposPago
    {
        $tipoPago = TiposPago::where('codigo', 'MEN')->first();
        if ($overrides) {
            $tipoPago->update($overrides);
        }
        return $tipoPago;
    }

    public function test_crear_tipo_pago()
    {
        $response = $this->actingAs($this->adminUser())
            ->post(route('tipos-pago.store'), [
                'nombre' => 'Por Hora',
                'codigo' => 'HOR',
                'unidad_calculo' => 'hora',
            ]);

        $response->assertRedirect(route('tipos-pago.index'));
        $this->assertDatabaseHas('tipos_pago', ['nombre' => 'Por Hora', 'codigo' => 'HOR']);
    }

    public function test_editar_tipo_pago()
    {
        $tipoPago = $this->tipoPago();

        $response = $this->actingAs($this->adminUser())
            ->put(route('tipos-pago.update', $tipoPago->id), [
                'nombre' => 'Mensual Editado',
                'codigo' => 'MENE',
                'unidad_calculo' => 'salario',
            ]);

        $response->assertRedirect(route('tipos-pago.index'));
        $this->assertDatabaseHas('tipos_pago', ['id' => $tipoPago->id, 'nombre' => 'Mensual Editado']);
    }

    public function test_activar_tipo_pago()
    {
        $tipoPago = $this->tipoPago(['estado' => false]);

        $response = $this->actingAs($this->adminUser())
            ->patch(route('tipos-pago.activar', $tipoPago->id));

        $response->assertRedirect(route('tipos-pago.index'));
        $this->assertTrue($tipoPago->fresh()->estado);
    }

    public function test_desactivar_tipo_pago()
    {
        $tipoPago = $this->tipoPago(['estado' => true]);

        $response = $this->actingAs($this->adminUser())
            ->patch(route('tipos-pago.desactivar', $tipoPago->id));

        $response->assertRedirect(route('tipos-pago.index'));
        $this->assertFalse($tipoPago->fresh()->estado);
    }
}
