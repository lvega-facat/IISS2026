<?php

namespace Tests\Feature\FrecuenciaPagos;

use Tests\TestCase;
use App\Models\FrecuenciasPago;
use App\Models\Usuarios;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FrecuenciaPagoTest extends TestCase
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

    private function frecuencia(array $overrides = []): FrecuenciasPago
    {
        $frecuencia = FrecuenciasPago::first();
        if ($overrides) {
            $frecuencia->update($overrides);
        }
        return $frecuencia;
    }

    public function test_crear_frecuencia_pago()
    {
        $response = $this->actingAs($this->adminUser())
            ->post(route('frecuencias-pago.store'), [
                'nombre' => 'Diario',
                'dias'   => 1,
            ]);

        $response->assertRedirect(route('frecuencias-pago.index'));
        $this->assertDatabaseHas('frecuencias_pago', [
            'nombre' => 'Diario',
            'dias'   => 1,
            'estado' => true,
        ]);
    }

    public function test_editar_frecuencia_pago()
    {
        $frecuencia = $this->frecuencia();

        $response = $this->actingAs($this->adminUser())
            ->put(route('frecuencias-pago.update', $frecuencia->id), [
                'nombre' => 'Mensual Editado',
                'dias'   => 30,
            ]);

        $response->assertRedirect(route('frecuencias-pago.index'));
        $this->assertDatabaseHas('frecuencias_pago', [
            'id'     => $frecuencia->id,
            'nombre' => 'Mensual Editado',
            'dias'   => 30,
        ]);
    }

    public function test_activar_frecuencia_pago()
    {
        $frecuencia = $this->frecuencia(['estado' => false]);

        $response = $this->actingAs($this->adminUser())
            ->patch(route('frecuencias-pago.activar', $frecuencia->id));

        $response->assertRedirect(route('frecuencias-pago.index'));
        $this->assertTrue($frecuencia->fresh()->estado);
    }

    public function test_desactivar_frecuencia_pago()
    {
        $frecuencia = $this->frecuencia(['estado' => true]);

        $response = $this->actingAs($this->adminUser())
            ->patch(route('frecuencias-pago.desactivar', $frecuencia->id));

        $response->assertRedirect(route('frecuencias-pago.index'));
        $this->assertFalse($frecuencia->fresh()->estado);
    }
}
