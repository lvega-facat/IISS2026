<?php

namespace Tests\Feature\Organizaciones;

use Tests\TestCase;
use App\Models\Organizaciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Modules\Organizaciones\Actions\CrearOrganizacionAction;
use App\Modules\Organizaciones\Actions\ActualizarOrganizacionAction;
use App\Modules\Organizaciones\Actions\EliminarOrganizacionAction;

class OrganizacionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    private function limpiarOrganizaciones(): void
    {
        DB::statement('SET session_replication_role = replica');

        DB::table('planilla_detalles')->truncate();
        DB::table('planillas')->truncate();
        DB::table('justificativos')->truncate();
        DB::table('asistencias')->truncate();
        DB::table('contratos')->truncate();
        DB::table('usuarios')->truncate();
        DB::table('empleados')->truncate();
        DB::table('cargos')->truncate();
        DB::table('departamento_dependiente')->truncate();
        DB::table('departamentos')->truncate();
        DB::table('organizaciones')->truncate();

        DB::statement('SET session_replication_role = DEFAULT');
    }

    public function test_crear_organizacion()
    {
        $this->limpiarOrganizaciones();

        $action = new CrearOrganizacionAction();

        $organizacion = $action->execute([
            'nombre' => 'Mi Empresa',
            'ruc' => '1234567',
            'fecha_registro' => now(),
            'direccion' => 'Asunción',
            'pais' => 'Paraguay',
            'email' => 'empresa@test.com',
            'telefono' => '0981123456',
            'sector' => 'Tecnología',
            'estado' => true,
        ]);

        $this->assertInstanceOf(
            Organizaciones::class,
            $organizacion
        );

        $this->assertDatabaseHas('organizaciones', [
            'ruc' => '1234567',
        ]);
    }

    public function test_no_permite_crear_mas_de_una_organizacion()
    {
        $this->expectException(ValidationException::class);

        $action = new CrearOrganizacionAction();

        $action->execute([
            'nombre' => 'Segunda Empresa',
            'ruc' => '9999999',
            'fecha_registro' => now(),
        ]);
    }

    public function test_no_permite_ruc_duplicado()
    {
        $this->limpiarOrganizaciones();

        Organizaciones::create([
            'nombre' => 'Empresa Uno',
            'ruc' => '123456',
            'fecha_registro' => now(),
            'estado' => true,
        ]);

        $this->expectException(ValidationException::class);

        $action = new CrearOrganizacionAction();

        $action->execute([
            'nombre' => 'Empresa Dos',
            'ruc' => '123456',
            'fecha_registro' => now(),
            'estado' => true,
        ]);
    }

    public function test_actualizar_organizacion()
    {
        $organizacion = Organizaciones::firstOrFail();

        $action = new ActualizarOrganizacionAction();

        $actualizada = $action->execute(
            $organizacion->id,
            [
                'nombre' => 'Empresa Actualizada',
                'ruc' => $organizacion->ruc,
                'fecha_registro' => $organizacion->fecha_registro,
                'direccion' => 'Nueva Dirección',
                'pais' => 'Paraguay',
                'email' => 'nuevo@email.com',
                'telefono' => '0981999999',
                'sector' => 'Servicios',
                'estado' => true,
            ]
        );

        $this->assertEquals(
            'Empresa Actualizada',
            $actualizada->nombre
        );

        $this->assertDatabaseHas('organizaciones', [
            'id' => $organizacion->id,
            'nombre' => 'Empresa Actualizada',
        ]);
    }

    public function test_actualizar_manteniendo_mismo_ruc()
    {
        $organizacion = Organizaciones::firstOrFail();

        $action = new ActualizarOrganizacionAction();

        $actualizada = $action->execute(
            $organizacion->id,
            [
                'nombre' => 'Nombre Nuevo',
                'ruc' => $organizacion->ruc,
                'fecha_registro' => $organizacion->fecha_registro,
            ]
        );

        $this->assertEquals(
            'Nombre Nuevo',
            $actualizada->nombre
        );
    }

    public function test_eliminar_organizacion_sin_dependencias()
    {
        $this->limpiarOrganizaciones();

        $organizacion = Organizaciones::create([
            'nombre' => 'Temporal',
            'ruc' => '777777',
            'fecha_registro' => now(),
            'estado' => true,
        ]);

        $action = new EliminarOrganizacionAction();

        $resultado = $action->execute(
            $organizacion->id
        );

        $this->assertTrue($resultado);

        $this->assertDatabaseMissing(
            'organizaciones',
            [
                'id' => $organizacion->id,
            ]
        );
    }

    public function test_no_elimina_organizacion_con_departamentos()
    {
        $organizacion = Organizaciones::firstOrFail();

        $this->expectException(ValidationException::class);

        (new EliminarOrganizacionAction())
            ->execute($organizacion->id);
    }

    public function test_no_elimina_organizacion_con_usuarios()
    {
        $organizacion = Organizaciones::firstOrFail();

        $this->assertTrue(
            $organizacion->usuarios()->exists()
        );

        $this->expectException(ValidationException::class);

        (new EliminarOrganizacionAction())
            ->execute($organizacion->id);
    }

    public function test_no_elimina_organizacion_con_planillas()
    {
        $organizacion = Organizaciones::firstOrFail();

        $this->assertTrue(
            $organizacion->planillas()->exists()
        );

        $this->expectException(ValidationException::class);

        (new EliminarOrganizacionAction())
            ->execute($organizacion->id);
    }
}