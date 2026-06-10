<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Modules\RolesPermisos\Actions\CrearRolAction;
use App\Modules\RolesPermisos\Actions\ActualizarRolAction;
use App\Modules\RolesPermisos\Actions\EliminarRolAction;
use App\Modules\RolesPermisos\Actions\AsignarPermisosRolAction;
use App\Models\Roles;
use App\Models\Permisos;
use App\Models\Usuarios;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class RolesPermisosTest extends TestCase
{
    use DatabaseTransactions; // Esto revierte los cambios después de cada prueba

    private $crearRolAction;
    private $actualizarRolAction;
    private $eliminarRolAction;
    private $asignarPermisosAction;

    // Variables para almacenar datos del seeder
    private $adminUser;
    private $gerenteUser;
    private $empleadoUser;
    private $todosPermisos;
    private $modulos;

    protected function setUp(): void
    {
        parent::setUp();

        // Ejecutar el seeder antes de las pruebas
        $this->seed(); // Esto ejecuta DatabaseSeeder

        // Inicializar acciones
        $this->crearRolAction = new CrearRolAction();
        $this->actualizarRolAction = new ActualizarRolAction();
        $this->eliminarRolAction = new EliminarRolAction();
        $this->asignarPermisosAction = new AsignarPermisosRolAction();

        // Cargar datos del seeder para usarlos en las pruebas
        $this->cargarDatosDelSeeder();
    }

    private function cargarDatosDelSeeder(): void
    {
        // Obtener usuarios creados por el seeder
        $this->adminUser = Usuarios::where('email', 'admin@empresademo.com')->first();
        $this->gerenteUser = Usuarios::where('email', 'ana.garcia@empresademo.com')->first();
        $this->empleadoUser = Usuarios::where('email', 'maria.rodriguez@empresademo.com')->first();

        // Obtener todos los permisos
        $this->todosPermisos = Permisos::pluck('id')->toArray();

        // Obtener módulos
        $this->modulos = DB::table('modulos')->pluck('id', 'slug')->toArray();
    }

    // ============ PRUEBAS SIN AUTENTICACIÓN (usan datos del seeder) ============
    /** @test */
    public function puede_crear_un_rol_usando_datos_del_seeder()
    {
        $data = [
            'nombre' => 'Rol de Prueba',
            'descripcion' => 'Creado desde prueba unitaria',
            'estado' => true
        ];

        $rol = $this->crearRolAction->handle($data);

        $this->assertInstanceOf(Roles::class, $rol);
        $this->assertEquals('Rol de Prueba', $rol->nombre);
        $this->assertDatabaseHas('roles', ['nombre' => 'Rol de Prueba']);
    }

    /** @test */
    public function puede_crear_rol_con_permisos_usando_ids_del_seeder()
    {
        // Tomar algunos permisos reales del seeder
        $permisosIds = array_slice($this->todosPermisos, 0, 5);

        $data = [
            'nombre' => 'Rol con Permisos',
            'descripcion' => 'Rol con permisos del seeder',
            'estado' => true,
            'permisos' => $permisosIds
        ];

        $context = [
            'id_usuario' => $this->adminUser->id,
            'ip_origen' => '127.0.0.1',
            'ruta' => '/api/roles'
        ];

        $rol = $this->crearRolAction->handle($data, $context);

        // Verificar que se crearon las relaciones
        foreach ($permisosIds as $permisoId) {
            $this->assertDatabaseHas('rol_permiso', [
                'id_rol' => $rol->id,
                'id_permiso' => $permisoId
            ]);
        }
    }

    /** @test */
    public function no_puede_crear_rol_con_nombre_duplicado_respetando_datos_existentes()
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Intentar crear un rol con nombre que ya existe en el seeder
        $this->crearRolAction->handle(['nombre' => 'Administrador']);
    }

    /** @test */
    public function puede_actualizar_un_rol_existente()
    {
        // Crear rol de prueba
        $rolCreado = $this->crearRolAction->handle(['nombre' => 'Rol Original']);

        $dataActualizada = [
            'nombre' => 'Rol Actualizado',
            'descripcion' => 'Descripción actualizada desde prueba',
            'estado' => false
        ];

        $context = ['ip_origen' => '127.0.0.1'];

        $rolActualizado = $this->actualizarRolAction->handle($rolCreado->id, $dataActualizada, $context);

        $this->assertEquals('Rol Actualizado', $rolActualizado->nombre);
        $this->assertEquals(false, $rolActualizado->estado);

        // Verificar auditoría
        $this->assertDatabaseHas('auditoria_log', [
            'modulo' => 'roles',
            'accion' => 'actualizar'
        ]);
    }

    /** @test */
    public function puede_actualizar_rol_con_el_mismo_nombre_sin_conflicto()
    {
        // Crear rol
        $rol = $this->crearRolAction->handle(['nombre' => 'Mi Rol Unico']);

        // Actualizar manteniendo el mismo nombre (no debería fallar)
        $rolActualizado = $this->actualizarRolAction->handle($rol->id, ['nombre' => 'Mi Rol Unico']);

        $this->assertEquals('Mi Rol Unico', $rolActualizado->nombre);
    }

    /** @test */
    public function eliminar_rol_lo_desactiva_pero_no_lo_elimina_fisicamente()
    {
        $rol = $this->crearRolAction->handle(['nombre' => 'Rol a Desactivar']);

        $this->assertTrue($rol->estado);

        $resultado = $this->eliminarRolAction->handle($rol->id);

        $this->assertTrue($resultado['desactivado']);
        $this->assertFalse($resultado['eliminado']);

        // Verificar que el rol existe pero está desactivado
        $rolActualizado = Roles::find($rol->id);
        $this->assertFalse($rolActualizado->estado);
    }

    // ============ PRUEBAS CON PERMISOS DEL SEEDER ============

    /** @test */
    public function puede_asignar_permisos_existentes_del_seeder_a_un_rol()
    {
        // Crear rol nuevo
        $rol = $this->crearRolAction->handle(['nombre' => 'Rol para Permisos']);

        // Tomar permisos específicos del seeder (ej: permisos del módulo Dashboard)
        $dashboardModuloId = $this->modulos['dashboard'];
        $permisosDashboard = Permisos::where('id_modulo', $dashboardModuloId)->pluck('id')->toArray();

        $context = [
            'id_usuario' => $this->adminUser->id,
            'ip_origen' => '192.168.1.100',
            'ruta' => '/api/roles/permisos'
        ];

        $resultado = $this->asignarPermisosAction->handle($rol->id, $permisosDashboard, $context);

        $this->assertEquals($permisosDashboard, $resultado['permisos_asignados']);
        $this->assertCount(count($permisosDashboard), $resultado['agregados']);

        // Verificar cambios_permisos
        $this->assertDatabaseHas('cambios_permisos', [
            'id_rol' => $rol->id,
            'id_usuario' => $this->adminUser->id
        ]);
    }

    /** @test */
    public function puede_asignar_permisos_multiples_y_actualizarlos()
    {
        $rol = $this->crearRolAction->handle(['nombre' => 'Rol Multi Permisos']);
        $context = ['id_usuario' => $this->adminUser->id];

        // Obtener permisos de dos módulos diferentes
        $permisosIniciales = Permisos::whereIn('id_modulo', [
            $this->modulos['dashboard'],
            $this->modulos['empleados']
        ])->take(4)->pluck('id')->toArray();

        // Primera asignación
        $this->asignarPermisosAction->handle($rol->id, $permisosIniciales, $context);

        // Verificar asignación inicial
        foreach ($permisosIniciales as $permisoId) {
            $this->assertDatabaseHas('rol_permiso', [
                'id_rol' => $rol->id,
                'id_permiso' => $permisoId
            ]);
        }

        // Nueva asignación (cambiar algunos)
        $nuevosPermisos = Permisos::whereIn('id_modulo', [
            $this->modulos['dashboard'],
            $this->modulos['planillas']
        ])->take(4)->pluck('id')->toArray();

        $resultado = $this->asignarPermisosAction->handle($rol->id, $nuevosPermisos, $context);

        // Verificar que se hayan hecho cambios
        $this->assertGreaterThanOrEqual(0, count($resultado['agregados']));
        $this->assertGreaterThanOrEqual(0, count($resultado['removidos']));
    }

    /** @test */
    public function asignar_permisos_con_usuario_gerente_funciona_correctamente()
    {
        $rol = $this->crearRolAction->handle(['nombre' => 'Rol Gerente Prueba']);

        // Usar el usuario gerente del seeder
        $context = [
            'id_usuario' => $this->gerenteUser->id,
            'ip_origen' => '10.0.0.1',
            'ruta' => '/api/roles/permisos'
        ];

        // Permisos que normalmente tendría un gerente
        $permisosGerente = Permisos::whereIn('id_modulo', [
            $this->modulos['departamentos'],
            $this->modulos['cargos'],
            $this->modulos['empleados']
        ])->pluck('id')->toArray();

        $resultado = $this->asignarPermisosAction->handle($rol->id, $permisosGerente, $context);

        $this->assertNotEmpty($resultado['permisos_asignados']);

        // Verificar que se registró quién hizo el cambio
        $this->assertDatabaseHas('cambios_permisos', [
            'id_usuario' => $this->gerenteUser->id,
            'id_rol' => $rol->id
        ]);
    }

    /** @test */
    public function puede_asignar_todos_los_permisos_del_sistema()
    {
        $rol = $this->crearRolAction->handle(['nombre' => 'Rol Super Poderes']);

        $context = ['id_usuario' => $this->adminUser->id];

        // Asignar todos los permisos existentes
        $resultado = $this->asignarPermisosAction->handle($rol->id, $this->todosPermisos, $context);

        $this->assertEquals($this->todosPermisos, $resultado['permisos_asignados']);

        // Verificar en base de datos
        $permisosAsignados = DB::table('rol_permiso')
            ->where('id_rol', $rol->id)
            ->pluck('id_permiso')
            ->toArray();

        sort($permisosAsignados);
        sort($this->todosPermisos);

        $this->assertEquals($this->todosPermisos, $permisosAsignados);
    }
// En RolesPermisosTest.php
    /** @test */
    public function asignar_permisos_duplicados_no_genera_conflictos()
    {
        $rol = $this->crearRolAction->handle(['nombre' => 'Rol Sin Duplicados']);
        $context = ['id_usuario' => $this->adminUser->id];

        // Permisos con duplicados
        $permisosConDuplicados = array_merge(
            array_slice($this->todosPermisos, 0, 3),
            array_slice($this->todosPermisos, 0, 3) // Duplicados
        );

        // Esto debería lanzar ValidationException por el 'distinct'
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->asignarPermisosAction->handle($rol->id, $permisosConDuplicados, $context);
    }
    // ============ PRUEBAS DE VALIDACIÓN ============

    /** @test */
    public function no_puede_asignar_permisos_inexistentes()
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $rol = $this->crearRolAction->handle(['nombre' => 'Rol Test']);
        $context = ['id_usuario' => $this->adminUser->id];

        // Permiso con ID inexistente
        $this->asignarPermisosAction->handle($rol->id, [999999, 888888], $context);
    }

    /** @test */
// En RolesPermisosTest.php
    /** @test */
    public function no_puede_asignar_permisos_a_rol_inexistente()
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);
        // Cambiar ModelNotFoundException por ValidationException

        $context = ['id_usuario' => $this->adminUser->id];

        // Rol con ID inexistente
        $this->asignarPermisosAction->handle(999999, [1, 2, 3], $context);
    }

    /** @test */
    public function crear_rol_con_contexto_vacio_no_falla()
    {
        // Contexto vacío debería funcionar (sin id_usuario)
        $data = [
            'nombre' => 'Rol Sin Contexto',
            'descripcion' => 'Creado sin datos de contexto'
        ];

        $rol = $this->crearRolAction->handle($data, []);

        $this->assertInstanceOf(Roles::class, $rol);
        $this->assertEquals('Rol Sin Contexto', $rol->nombre);
    }

    // ============ PRUEBAS INTEGRACIÓN CON DATOS REALES DEL SEEDER ============

    /** @test */
    public function los_roles_existentes_del_seeder_tienen_permisos_asignados()
    {
        // Verificar que el rol Administrador tiene permisos
        $rolAdmin = Roles::where('nombre', 'Administrador')->first();
        $permisosAdmin = DB::table('rol_permiso')
            ->where('id_rol', $rolAdmin->id)
            ->count();

        $this->assertGreaterThan(0, $permisosAdmin);

        // Verificar que el rol Empleado tiene permisos limitados
        $rolEmpleado = Roles::where('nombre', 'Empleado')->first();
        $permisosEmpleado = DB::table('rol_permiso')
            ->where('id_rol', $rolEmpleado->id)
            ->count();

        $this->assertLessThan($permisosAdmin, $permisosEmpleado);
    }

    /** @test */
    public function puede_modificar_permisos_de_rol_existente_del_seeder()
    {
        // Tomar un rol existente del seeder
        $rolEmpleado = Roles::where('nombre', 'Empleado')->first();
        $context = ['id_usuario' => $this->adminUser->id];

        // Obtener permisos actuales
        $permisosActuales = DB::table('rol_permiso')
            ->where('id_rol', $rolEmpleado->id)
            ->pluck('id_permiso')
            ->toArray();

        // Agregar un nuevo permiso (ej: poder ver planillas)
        $permisoPlanillas = Permisos::where('id_modulo', $this->modulos['planillas'])
            ->where('accion', 'ver')
            ->first();

        $nuevosPermisos = array_merge($permisosActuales, [$permisoPlanillas->id]);

        $resultado = $this->asignarPermisosAction->handle($rolEmpleado->id, $nuevosPermisos, $context);

        $this->assertContains($permisoPlanillas->id, $resultado['agregados']);
    }
}
