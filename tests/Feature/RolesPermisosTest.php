<?php

namespace Tests\Feature;

use App\Models\Modulos;
use App\Models\Organizaciones;
use App\Models\Permisos;
use App\Models\Roles;
use App\Models\Usuarios;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolesPermisosTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_rol(): void
    {
        $response = $this->postJson('/roles', [
            'nombre' => 'Administrador QA',
            'descripcion' => 'Rol principal',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('roles', [
            'nombre' => 'Administrador QA',
            'estado' => true,
        ]);

        $this->assertDatabaseHas('auditoria_log', [
            'modulo' => 'roles',
            'accion' => 'crear',
        ]);
    }

    public function test_crear_rol_con_permisos_del_seed(): void
    {
        $this->seed();

        $modulo = Modulos::query()->where('slug', 'empleados')->firstOrFail();
        $permisoVer = Permisos::query()
            ->where('id_modulo', $modulo->id)
            ->where('accion', 'ver')
            ->firstOrFail();

        $response = $this->postJson('/roles', [
            'nombre' => 'Soporte',
            'descripcion' => 'Rol con permisos asignados al crear',
            'permisos' => [$permisoVer->id],
        ]);

        $response->assertStatus(201);

        $role = Roles::query()->where('nombre', 'Soporte')->firstOrFail();

        $this->assertDatabaseHas('rol_permiso', [
            'id_rol' => $role->id,
            'id_permiso' => $permisoVer->id,
        ]);
    }

    public function test_no_se_pueden_asignar_permisos_inexistentes(): void
    {
        $role = Roles::create([
            'nombre' => 'RolPrueba',
            'descripcion' => 'Test',
            'estado' => true,
        ]);

        $response = $this->postJson('/roles', [
            'nombre' => 'Rol inválido',
            'permisos' => [99999],
        ]);

        $response->assertStatus(422);
    }

    public function test_actualizar_rol(): void
    {
        $role = Roles::create([
            'nombre' => 'Supervisor',
            'descripcion' => 'Rol temporal',
            'estado' => true,
        ]);

        $response = $this->putJson("/roles/{$role->id}", [
            'nombre' => 'Supervisor Actualizado',
            'descripcion' => 'Rol actualizado',
            'estado' => false,
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'nombre' => 'Supervisor Actualizado',
            'estado' => 0,
        ]);

        $this->assertDatabaseHas('auditoria_log', [
            'modulo' => 'roles',
            'accion' => 'actualizar',
        ]);
    }

    public function test_eliminar_rol_es_softdelete(): void
    {
        $role = Roles::create([
            'nombre' => 'Temporal',
            'descripcion' => 'Se desactivará',
            'estado' => true,
        ]);

        $response = $this->deleteJson("/roles/{$role->id}");

        $response->assertOk();

        // El rol sigue en la DB pero con estado = false (soft delete)
        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'estado' => 0,
        ]);

        $this->assertDatabaseHas('auditoria_log', [
            'modulo' => 'roles',
            'accion' => 'eliminar',
        ]);
    }

    public function test_rol_eliminado_no_aparece_en_listado(): void
    {
        Roles::create(['nombre' => 'Activo', 'descripcion' => '', 'estado' => true]);
        $inactivo = Roles::create(['nombre' => 'Inactivo', 'descripcion' => '', 'estado' => false]);

        $response = $this->getJson('/roles');

        $response->assertOk();
        $nombres = collect($response->json())->pluck('nombre');
        $this->assertTrue($nombres->contains('Activo'));
        $this->assertFalse($nombres->contains('Inactivo'));
    }

    public function test_asignar_permisos_a_rol(): void
    {
        $this->seed();

        $role = Roles::create([
            'nombre' => 'Operador',
            'descripcion' => 'Rol con permisos',
            'estado' => true,
        ]);

        $organizacion = Organizaciones::create([
            'nombre' => 'Org test',
            'ruc' => '1234567890',
            'fecha_registro' => now()->toDateString(),
            'direccion' => 'Av. Central',
            'pais' => 'HN',
            'email' => 'org@example.com',
            'telefono' => '5555-5555',
            'sector' => 'Servicios',
            'logo_url' => null,
            'estado' => true,
        ]);

        $usuario = Usuarios::create([
            'id_empleado' => null,
            'id_rol' => $role->id,
            'id_organizacion' => $organizacion->id,
            'nombre' => 'Mario',
            'apellido' => 'Perez',
            'email' => 'mario@example.com',
            'password_hash' => 'hashed',
            'foto_url' => null,
            'estado' => true,
            'intentos_fallidos' => 0,
            'bloqueado_hasta' => null,
            'ultimo_acceso' => null,
        ]);

        // Los permisos vienen del seed — no se crean en el test
        $modulo = Modulos::query()->where('slug', 'empleados')->firstOrFail();
        $permisoVer = Permisos::query()
            ->where('id_modulo', $modulo->id)
            ->where('accion', 'ver')
            ->firstOrFail();

        $response = $this->postJson("/roles/{$role->id}/permisos", [
            'permisos' => [$permisoVer->id],
            'id_usuario' => $usuario->id,
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('rol_permiso', [
            'id_rol' => $role->id,
            'id_permiso' => $permisoVer->id,
        ]);

        $this->assertDatabaseHas('cambios_permisos', [
            'id_rol' => $role->id,
            'id_modulo' => $modulo->id,
        ]);

        $this->assertDatabaseHas('auditoria_log', [
            'modulo' => 'roles_permisos',
            'accion' => 'asignar_permisos',
        ]);
    }
}
