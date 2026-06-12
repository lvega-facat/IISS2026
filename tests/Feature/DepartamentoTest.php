<?php

namespace Tests\Feature\Departamentos;

use Tests\TestCase;
use App\Models\Departamentos;
use App\Models\Empleados;
use App\Models\DepartamentoDependiente;
use App\Models\Usuarios;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Modules\Departamentos\Actions\CrearDepartamentoAction;
use App\Modules\Departamentos\Actions\ActualizarDepartamentoAction;
use App\Modules\Departamentos\Actions\ActivarDepartamentoAction;
use App\Modules\Departamentos\Actions\DesactivarDepartamentoAction;

class DepartamentoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    public function test_crear_departamento()
    {
        $action = new CrearDepartamentoAction();

        $departamento = $action->execute([
            'id_organizacion'   => 1,
            'nombre'            => 'Marketing',
            'codigo'            => 'MKT',
            'funcion_principal' => 'Gestión de marca y comunicación',
            'descripcion'       => null,
        ]);

        $this->assertInstanceOf(Departamentos::class, $departamento);
        $this->assertTrue($departamento->estado);

        $this->assertDatabaseHas('departamentos', [
            'id'     => $departamento->id,
            'nombre' => 'Marketing',
            'codigo' => 'MKT',
        ]);

        $this->assertDatabaseMissing('departamento_dependiente', [
            'id_departamento_hijo' => $departamento->id,
        ]);
    }

    public function test_crear_departamento_con_dependencia()
    {
        $padre = Departamentos::firstOrFail();

        $action = new CrearDepartamentoAction();

        $departamento = $action->execute([
            'id_organizacion'        => $padre->id_organizacion,
            'nombre'                 => 'Mesa de Ayuda',
            'codigo'                 => 'HELP',
            'funcion_principal'      => 'Soporte interno',
            'descripcion'            => 'Departamento de soporte',
            'id_departamento_padre'  => $padre->id,
            'tipo_dependencia'       => 'jerarquica',
        ]);

        $this->assertDatabaseHas('departamentos', [
            'id'     => $departamento->id,
            'nombre' => 'Mesa de Ayuda',
        ]);

        $this->assertDatabaseHas('departamento_dependiente', [
            'id_departamento_padre' => $padre->id,
            'id_departamento_hijo'  => $departamento->id,
            'tipo_dependencia'      => 'jerarquica',
        ]);
    }
    public function test_actualizar_departamento()
    {
        $departamento = Departamentos::first();

        $action = new ActualizarDepartamentoAction();

        $actualizado = $action->execute($departamento, [
            'nombre'            => 'Gerencia Actualizada',
            'codigo'            => 'GGA',
            'funcion_principal' => 'Nueva función principal',
            'descripcion'       => 'Descripción actualizada',
        ]);

        $this->assertEquals('Gerencia Actualizada', $actualizado->nombre);
        $this->assertEquals('GGA', $actualizado->codigo);
        $this->assertDatabaseHas('departamentos', [
            'id'     => $departamento->id,
            'nombre' => 'Gerencia Actualizada',
        ]);
    }

    public function test_activar_departamento()
    {
        $departamento = Departamentos::first();
        $departamento->estado = false;
        $departamento->save();

        $action = new ActivarDepartamentoAction();
        $action->execute($departamento);

        $departamento->refresh();
        $this->assertTrue($departamento->estado);
    }

    public function test_desactivar_departamento()
    {
        $departamento = Departamentos::create([
            'id_organizacion'   => 1,
            'nombre'            => 'Temp',
            'codigo'            => 'TMP',
            'funcion_principal' => 'Temporal',
            'estado'            => true,
        ]);

        $action = new DesactivarDepartamentoAction();
        $action->execute($departamento);

        $departamento->refresh();
        $this->assertFalse($departamento->estado);
    }

    private function adminUser(): Usuarios
    {
        return Usuarios::where('email', 'admin@empresademo.com')->firstOrFail();
    }

    public function test_store_rechaza_nombre_duplicado_en_misma_organizacion()
    {
        $existente = Departamentos::first(); // "Gerencia General"

        $response = $this->actingAs($this->adminUser())
            ->post(route('departamentos.store'), [
                'nombre'            => strtoupper($existente->nombre), // mismo nombre, diferente case
                'codigo'            => 'XX',
                'funcion_principal' => 'Duplicado',
            ]);

        $response->assertSessionHasErrors('nombre');
    }

    public function test_store_crea_departamento_con_datos_validos()
    {
        $response = $this->actingAs($this->adminUser())
            ->post(route('departamentos.store'), [
                'nombre'            => 'Legal',
                'codigo'            => 'LEG',
                'funcion_principal' => 'Asesoría jurídica',
            ]);

        $response->assertRedirect(route('departamentos.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('departamentos', ['nombre' => 'Legal']);
    }

    public function test_store_requiere_campos_obligatorios()
    {
        $response = $this->actingAs($this->adminUser())
            ->post(route('departamentos.store'), []);

        $response->assertSessionHasErrors(['nombre', 'codigo', 'funcion_principal']);
    }

    public function test_update_rechaza_nombre_duplicado_en_misma_organizacion()
    {
        $departamentos = Departamentos::take(2)->get();
        $primero  = $departamentos[0];
        $segundo  = $departamentos[1];

        $response = $this->actingAs($this->adminUser())
            ->put(route('departamentos.update', $segundo->id), [
                'nombre'            => $primero->nombre,
                'codigo'            => $segundo->codigo,
                'funcion_principal' => $segundo->funcion_principal,
            ]);

        $response->assertSessionHasErrors('nombre');
    }

    public function test_update_permite_guardar_sin_cambiar_nombre()
    {
        $departamento = Departamentos::first();

        $response = $this->actingAs($this->adminUser())
            ->put(route('departamentos.update', $departamento->id), [
                'nombre'            => $departamento->nombre, // mismo nombre, mismo registro
                'codigo'            => 'NUEVO_COD',
                'funcion_principal' => $departamento->funcion_principal,
            ]);

        $response->assertRedirect(route('departamentos.index'));
        $response->assertSessionHas('success');
    }

    public function test_desactivar_falla_si_tiene_empleados_activos()
    {
        $tecnologia = Departamentos::where('codigo', 'TEC')->firstOrFail();

        $response = $this->actingAs($this->adminUser())
            ->patch(route('departamentos.desactivar', $tecnologia->id));

        $response->assertRedirect(route('departamentos.index'));
        $response->assertSessionHas('error', 'No se puede eliminar el departamento porque tiene empleados asociados.');

        // Confirmar que sigue activo
        $this->assertTrue($tecnologia->fresh()->estado);
    }

    public function test_desactivar_falla_si_tiene_departamentos_hijos()
    {
        $gerencia = Departamentos::where('codigo', 'GG')->firstOrFail();

        Empleados::where('id_departamento', $gerencia->id)->update(['estado' => false]);

        $response = $this->actingAs($this->adminUser())
            ->patch(route('departamentos.desactivar', $gerencia->id));

        $response->assertRedirect(route('departamentos.index'));
        $response->assertSessionHas('error', 'No se puede eliminar el departamento porque tiene departamentos dependientes.');

        $this->assertTrue($gerencia->fresh()->estado);
    }

    public function test_desactivar_exitoso_cuando_no_tiene_restricciones()
    {
        // Crear departamento libre (sin empleados ni hijos)
        $departamento = Departamentos::create([
            'id_organizacion'   => 1,
            'nombre'            => 'Archivo',
            'codigo'            => 'ARC',
            'funcion_principal' => 'Gestión documental',
            'estado'            => true,
        ]);

        $response = $this->actingAs($this->adminUser())
            ->patch(route('departamentos.desactivar', $departamento->id));

        $response->assertRedirect(route('departamentos.index'));
        $response->assertSessionHas('success');
        $this->assertFalse($departamento->fresh()->estado);
    }

    public function test_activar_departamento_via_http()
    {
        $departamento = Departamentos::create([
            'id_organizacion'   => 1,
            'nombre'            => 'Inactivo',
            'codigo'            => 'INA',
            'funcion_principal' => 'Sin función activa',
            'estado'            => false,
        ]);

        $response = $this->actingAs($this->adminUser())
            ->patch(route('departamentos.activar', $departamento->id));

        $response->assertRedirect(route('departamentos.index'));
        $response->assertSessionHas('success');
        $this->assertTrue($departamento->fresh()->estado);
    }

    public function test_index_lista_departamentos()
    {
        $response = $this->actingAs($this->adminUser())
            ->get(route('departamentos.index'));

        $response->assertOk();
        $response->assertViewHas('departamentos');
    }
}
