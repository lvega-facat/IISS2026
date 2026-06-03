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
            'nombre' => 'Administrador',
            'descripcion' => 'Rol principal',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('roles', [
            'nombre' => 'Administrador',
        ]);

        $this->assertDatabaseHas('auditoria_log', [
            'modulo' => 'roles',
            'accion' => 'crear',
        ]);
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

    public function test_eliminar_rol(): void
    {
        $role = Roles::create([
            'nombre' => 'Temporal',
            'descripcion' => 'Se eliminará',
            'estado' => true,
        ]);

        $response = $this->deleteJson("/roles/{$role->id}");

        $response->assertOk();

        $this->assertDatabaseMissing('roles', [
            'id' => $role->id,
        ]);

        $this->assertDatabaseHas('auditoria_log', [
            'modulo' => 'roles',
            'accion' => 'eliminar',
        ]);
    }

    public function test_asignar_permisos_a_rol(): void
    {
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

        $modulo = Modulos::create([
            'nombre' => 'Empleados',
            'slug' => 'empleados',
        ]);

        $permisoVer = Permisos::create([
            'id_modulo' => $modulo->id,
            'accion' => 'Ver',
        ]);

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
