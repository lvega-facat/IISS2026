<?php

namespace Tests\Feature;

use App\Models\Profesiones;
use App\Modules\Profesiones\Actions\ActualizarProfesionAction;
use App\Modules\Profesiones\Actions\CrearProfesionAction;
use App\Modules\Profesiones\Actions\EliminarProfesionAction;
use App\Modules\Profesiones\Actions\ObtenerProfesionesAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfesionesTest extends TestCase
{
    use RefreshDatabase;

    // CrearProfesionAction

    public function test_crear_profesion_correctamente(): void
    {
        $profesion = (new CrearProfesionAction())->execute([
            'nombre'      => 'Ingeniería de Software',
            'descripcion' => 'Desarrollo y mantenimiento de software',
        ]);

        $this->assertInstanceOf(Profesiones::class, $profesion);
        $this->assertSame('Ingeniería de Software', $profesion->nombre);
        $this->assertSame('Desarrollo y mantenimiento de software', $profesion->descripcion);
        $this->assertTrue($profesion->estado);
        $this->assertDatabaseHas('profesiones', [
            'nombre' => 'Ingeniería de Software',
            'estado' => true,
        ]);
    }

    public function test_crear_profesion_sin_descripcion_queda_null(): void
    {
        $profesion = (new CrearProfesionAction())->execute(['nombre' => 'Derecho']);

        $this->assertNull($profesion->descripcion);
        $this->assertTrue($profesion->estado);
    }

    public function test_crear_profesion_fuerza_estado_true(): void
    {
        $profesion = (new CrearProfesionAction())->execute(['nombre' => 'Medicina']);

        $this->assertTrue($profesion->estado);
    }


    // ActualizarProfesionAction


    public function test_actualizar_nombre_y_descripcion(): void
    {
        $profesion = Profesiones::create(['nombre' => 'Contabilidad', 'estado' => true]);

        $actualizada = (new ActualizarProfesionAction())->execute($profesion, [
            'nombre'      => 'Contabilidad Avanzada',
            'descripcion' => 'Gestión financiera',
        ]);

        $this->assertSame('Contabilidad Avanzada', $actualizada->nombre);
        $this->assertSame('Gestión financiera', $actualizada->descripcion);
        $this->assertDatabaseHas('profesiones', [
            'id'     => $profesion->id,
            'nombre' => 'Contabilidad Avanzada',
        ]);
    }

    public function test_actualizar_sin_descripcion_conserva_la_anterior(): void
    {
        $profesion = Profesiones::create([
            'nombre'      => 'Psicología',
            'descripcion' => 'Ciencia del comportamiento',
            'estado'      => true,
        ]);

        $actualizada = (new ActualizarProfesionAction())->execute($profesion, [
            'nombre' => 'Psicología Clínica',
        ]);

        $this->assertSame('Ciencia del comportamiento', $actualizada->descripcion);
    }

    // EliminarProfesionAction  (soft delete lógico)


    public function test_eliminar_cambia_estado_a_false(): void
    {
        $profesion = Profesiones::create(['nombre' => 'Arquitectura', 'estado' => true]);

        (new EliminarProfesionAction())->execute($profesion);

        $this->assertDatabaseHas('profesiones', [
            'id'     => $profesion->id,
            'estado' => false,
        ]);
    }

    public function test_eliminar_no_borra_el_registro_fisicamente(): void
    {
        $profesion = Profesiones::create(['nombre' => 'Odontología', 'estado' => true]);

        (new EliminarProfesionAction())->execute($profesion);

        $this->assertDatabaseHas('profesiones', ['id' => $profesion->id]);
    }
    // ObtenerProfesionesAction

    public function test_obtener_solo_retorna_profesiones_activas(): void
    {
        Profesiones::create(['nombre' => 'Activa', 'estado' => true]);
        Profesiones::create(['nombre' => 'Inactiva', 'estado' => false]);

        $resultado = (new ObtenerProfesionesAction())->execute();

        $this->assertCount(1, $resultado);
        $this->assertSame('Activa', $resultado->first()->nombre);
    }

    public function test_obtener_retorna_ordenado_por_nombre_ascendente(): void
    {
        Profesiones::create(['nombre' => 'Marmolero', 'estado' => true]);
        Profesiones::create(['nombre' => 'Tecnico1', 'estado' => true]);
        Profesiones::create(['nombre' => 'Recursos Humanos', 'estado' => true]);

        $resultado = (new ObtenerProfesionesAction())->execute();

        $this->assertSame('Marmolero', $resultado->get(0)->nombre);
        $this->assertSame('Recursos Humanos',  $resultado->get(1)->nombre);
        $this->assertSame('Tecnico1', $resultado->get(2)->nombre);
    }

    public function test_obtener_no_aparece_profesion_eliminada(): void
    {
        $profesion = Profesiones::create(['nombre' => 'Veterinaria', 'estado' => true]);

        (new EliminarProfesionAction())->execute($profesion);

        $resultado = (new ObtenerProfesionesAction())->execute();

        $this->assertEmpty($resultado->where('nombre', 'Veterinaria'));
    }
}
