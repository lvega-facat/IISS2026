<?php

namespace Tests\Feature\Cargos;

use Tests\TestCase;
use App\Models\Cargos;
use App\Models\Empleados;
use App\Models\Usuarios;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Cargos\Actions\CrearCargosAction;
use App\Modules\Cargos\Actions\ActualizarCargosAction;
use App\Modules\Cargos\Actions\ToggleEstadoAction;

class CargosTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_crear_cargo()
    {
        $action = new CrearCargosAction();

        $cargo = $action->execute([
            'id_departamento' => 1,
            'id_cargo_padre' => null,
            'nombre' => 'Gerente General',
        ]);

        $this->assertInstanceOf(Cargos::class, $cargo);
        $this->assertTrue($cargo->estado);

        $this->assertDatabaseHas('cargos', [
            'id' => $cargo->id,
            'nombre' => 'Gerente General',
            'id_departamento' => 1,
        ]);
    }

    public function test_crear_cargo_con_padre()
    {
        $padre = Cargos::firstOrFail();

        $action = new CrearCargosAction();

        $cargo = $action->execute([
            'id_departamento' => $padre->id_departamento,
            'id_cargo_padre' => $padre->id,
            'nombre' => 'Subgerente',
        ]);

        $this->assertDatabaseHas('cargos', [
            'id' => $cargo->id,
            'nombre' => 'Subgerente',
            'id_cargo_padre' => $padre->id,
        ]);
    }

    public function test_actualizar_cargo()
    {
        $cargo = Cargos::first();

        $action = new ActualizarCargosAction();

        $actualizado = $action->execute($cargo, [
            'id_departamento' => $cargo->id_departamento,
            'id_cargo_padre' => null,
            'nombre' => 'Gerente Actualizado',
        ]);

        $this->assertEquals('Gerente Actualizado', $actualizado->nombre);
        $this->assertDatabaseHas('cargos', [
            'id' => $cargo->id,
            'nombre' => 'Gerente Actualizado',
        ]);
    }

    public function test_activar_cargo()
    {
        $cargo = Cargos::first();
        $cargo->estado = false;
        $cargo->save();

        $action = new ToggleEstadoAction();
        $action->activar($cargo);

        $cargo->refresh();
        $this->assertTrue($cargo->estado);
    }

    public function test_desactivar_cargo()
    {
        $cargo = Cargos::create([
            'id_departamento' => 1,
            'id_cargo_padre' => null,
            'nombre' => 'Temporal',
            'estado' => true,
        ]);

        $action = new ToggleEstadoAction();
        $action->desactivar($cargo);

        $cargo->refresh();
        $this->assertFalse($cargo->estado);
    }

    private function adminUser(): Usuarios
    {
        return Usuarios::where('email', 'admin@empresademo.com')->firstOrFail();
    }

    public function test_store_rechaza_nombre_duplicado_en_mismo_departamento()
    {
        $existente = Cargos::first();

        $response = $this->actingAs($this->adminUser())
            ->post(route('cargos.store'), [
                'id_departamento' => $existente->id_departamento,
                'id_cargo_padre' => null,
                'nombre' => $existente->nombre,
            ]);

        $response->assertSessionHasErrors('nombre');
    }

    public function test_store_crea_cargo_con_datos_validos()
    {
        $response = $this->actingAs($this->adminUser())
            ->post(route('cargos.store'), [
                'id_departamento' => 1,
                'id_cargo_padre' => null,
                'nombre' => 'Analista Senior',
            ]);

        $response->assertRedirect(route('cargos.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('cargos', ['nombre' => 'Analista Senior']);
    }

    public function test_store_requiere_campos_obligatorios()
    {
        $response = $this->actingAs($this->adminUser())
            ->post(route('cargos.store'), []);

        $response->assertSessionHasErrors(['id_departamento', 'nombre']);
    }

    public function test_update_rechaza_nombre_duplicado_en_mismo_departamento()
    {
        $cargos = Cargos::where('id_departamento', 1)->take(2)->get();

        if ($cargos->count() < 2) {
            $this->markTestSkipped('No hay suficientes cargos en el departamento 1');
        }

        $primero = $cargos[0];
        $segundo = $cargos[1];

        $response = $this->actingAs($this->adminUser())
            ->put(route('cargos.update', $segundo->id), [
                'id_departamento' => $segundo->id_departamento,
                'id_cargo_padre' => $segundo->id_cargo_padre,
                'nombre' => $primero->nombre,
            ]);

        $response->assertSessionHasErrors('nombre');
    }

    public function test_update_permite_guardar_sin_cambiar_nombre()
    {
        $cargo = Cargos::first();

        $response = $this->actingAs($this->adminUser())
            ->put(route('cargos.update', $cargo->id), [
                'id_departamento' => $cargo->id_departamento,
                'id_cargo_padre' => $cargo->id_cargo_padre,
                'nombre' => $cargo->nombre,
            ]);

        $response->assertRedirect(route('cargos.index'));
        $response->assertSessionHas('success');
    }

    public function test_desactivar_falla_si_tiene_empleados_activos()
    {
        $cargo = Cargos::first();

        $empleadoActivo = $cargo->empleados()
            ->where('estado', true)
            ->first();

        if (!$empleadoActivo) {
            $this->markTestSkipped('No hay empleados activos en este cargo');
        }

        $response = $this->actingAs($this->adminUser())
            ->patch(route('cargos.desactivar', $cargo->id));

        $response->assertRedirect(route('cargos.index'));
        $response->assertSessionHas('error', 'No se puede desactivar porque tiene empleados asociados');

        $this->assertTrue($cargo->fresh()->estado);
    }

    public function test_desactivar_falla_si_tiene_cargos_hijos()
    {
        $cargoConHijos = Cargos::whereHas('cargos', function ($query) {
            $query->where('estado', true);
        })->first();

        if (!$cargoConHijos) {
            $this->markTestSkipped('No hay cargos con cargos hijos activos');
        }

        Empleados::where('id_cargo', $cargoConHijos->id)->update(['estado' => false]);

        $response = $this->actingAs($this->adminUser())
            ->patch(route('cargos.desactivar', $cargoConHijos->id));

        $response->assertRedirect(route('cargos.index'));
        $response->assertSessionHas('error', 'No se puede desactivar porque tiene cargos dependientes');

        $this->assertTrue($cargoConHijos->fresh()->estado);
    }

    public function test_desactivar_exitoso_cuando_no_tiene_restricciones()
    {
        $cargo = Cargos::create([
            'id_departamento' => 1,
            'id_cargo_padre' => null,
            'nombre' => 'Cargo Temporal Libre',
            'estado' => true,
        ]);

        $response = $this->actingAs($this->adminUser())
            ->patch(route('cargos.desactivar', $cargo->id));

        $response->assertRedirect(route('cargos.index'));
        $response->assertSessionHas('success');
        $this->assertFalse($cargo->fresh()->estado);
    }

    public function test_activar_cargo_via_http()
    {
        $cargo = Cargos::create([
            'id_departamento' => 1,
            'id_cargo_padre' => null,
            'nombre' => 'Cargo Inactivo',
            'estado' => false,
        ]);

        $response = $this->actingAs($this->adminUser())
            ->patch(route('cargos.activar', $cargo->id));

        $response->assertRedirect(route('cargos.index'));
        $response->assertSessionHas('success');
        $this->assertTrue($cargo->fresh()->estado);
    }

    public function test_index_lista_cargos()
    {
        $response = $this->actingAs($this->adminUser())
            ->get(route('cargos.index'));

        $response->assertOk();
    }
}
