<?php

namespace Tests\Feature\Profesiones;

use Tests\TestCase;
use App\Models\Profesiones;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Modules\Contratos\Profesiones\Actions\CrearProfesionAction;
use App\Modules\Contratos\Profesiones\Actions\ActualizarProfesionAction;
use App\Modules\Contratos\Profesiones\Actions\DesactivarProfesionAction;

class ProfesionesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_crear_profesion()
    {
        $action = new CrearProfesionAction();

        $profesion = $action([
            'nombre' => 'Arquitectura',
            'descripcion' => 'Diseño y construcción',
        ]);

        $this->assertInstanceOf(
            Profesiones::class,
            $profesion
        );

        $this->assertDatabaseHas('profesiones', [
            'nombre' => 'Arquitectura',
            'descripcion' => 'Diseño y construcción',
            'estado' => true,
        ]);
    }

    public function test_actualizar_profesion()
    {
        $profesion = Profesiones::firstOrFail();

        $action = new ActualizarProfesionAction();

        $actualizada = $action(
            $profesion,
            [
                'nombre' => 'Ingeniería Actualizada',
                'descripcion' => 'Descripción actualizada',
                'estado' => false,
            ]
        );

        $this->assertEquals(
            'Ingeniería Actualizada',
            $actualizada->nombre
        );

        $this->assertEquals(
            'Descripción actualizada',
            $actualizada->descripcion
        );

        $this->assertFalse(
            $actualizada->estado
        );

        $this->assertDatabaseHas('profesiones', [
            'id' => $profesion->id,
            'nombre' => 'Ingeniería Actualizada',
            'descripcion' => 'Descripción actualizada',
            'estado' => false,
        ]);
    }

    public function test_desactivar_profesion()
    {
        $profesion = Profesiones::firstOrFail();

        $this->assertTrue(
            (bool) $profesion->estado
        );

        $action = new DesactivarProfesionAction();

        $action($profesion);

        $profesion->refresh();

        $this->assertFalse(
            (bool) $profesion->estado
        );

        $this->assertDatabaseHas('profesiones', [
            'id' => $profesion->id,
            'estado' => false,
        ]);
    }
}