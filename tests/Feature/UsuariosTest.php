<?php

namespace Tests\Feature\Usuarios;

use Tests\TestCase;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use App\Modules\Usuarios\Actions\CrearUsuarioAction;
use App\Modules\Usuarios\Actions\ActualizarUsuarioAction;
use App\Modules\Usuarios\Actions\CambiarPasswordUsuarioAction;
use App\Modules\Usuarios\Actions\SoftELiminarUsuarioAction;
use App\Modules\Usuarios\Actions\ActivarUsuario;

class UsuariosTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_crear_usuario()
    {
        $action = new CrearUsuarioAction();

        $usuario = $action->execute([
            'id_empleado' => null,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'Jesus',
            'apellido' => 'Baez',
            'email' => 'jesus@test.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'estado' => true,
        ]);

        $this->assertInstanceOf(
            Usuarios::class,
            $usuario
        );

        $this->assertDatabaseHas(
            'usuarios',
            [
                'email' => 'jesus@test.com',
                'nombre' => 'Jesus',
                'apellido' => 'Baez',
            ]
        );

        $this->assertTrue(
            Hash::check(
                'Password123!',
                $usuario->password_hash
            )
        );
    }

    public function test_actualizar_usuario()
    {
        $usuario = Usuarios::create([
            'id_empleado' => null,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'Original',
            'apellido' => 'Original',
            'email' => 'original@test.com',
            'password_hash' => Hash::make('Password123!'),
            'estado' => true,
        ]);

        $action = new ActualizarUsuarioAction();

        $actualizado = $action->execute(
            $usuario,
            [
                'id_empleado' => null,
                'id_rol' => 1,
                'id_organizacion' => 1,
                'nombre' => 'Actualizado',
                'apellido' => 'Baez',
                'email' => 'actualizado@test.com',
                'estado' => true,
            ]
        );

        $this->assertEquals(
            'Actualizado',
            $actualizado->nombre
        );

        $this->assertDatabaseHas(
            'usuarios',
            [
                'id' => $usuario->id,
                'nombre' => 'Actualizado',
                'email' => 'actualizado@test.com',
            ]
        );
    }

    public function test_cambiar_password()
    {
        $usuario = Usuarios::create([
            'id_empleado' => null,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'Test',
            'apellido' => 'User',
            'email' => 'password@test.com',
            'password_hash' => Hash::make('ViejaPassword123!'),
            'estado' => true,
        ]);

        $action = new CambiarPasswordUsuarioAction();

        $resultado = $action->execute(
            $usuario,
            'NuevaPassword123!',
            'NuevaPassword123!'
        );

        $usuario->refresh();

        $this->assertTrue($resultado);

        $this->assertTrue(
            Hash::check(
                'NuevaPassword123!',
                $usuario->password_hash
            )
        );
    }

    public function test_desactivar_usuario()
    {
        $usuario = Usuarios::create([
            'id_empleado' => null,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'Activo',
            'apellido' => 'User',
            'email' => 'activo@test.com',
            'password_hash' => Hash::make('Password123!'),
            'estado' => true,
        ]);

        $action = new SoftELiminarUsuarioAction();

        $resultado = $action->execute($usuario);

        $usuario->refresh();

        $this->assertTrue($resultado);

        $this->assertFalse(
            $usuario->estado
        );
    }

    public function test_activar_usuario()
    {
        $usuario = Usuarios::create([
            'id_empleado' => null,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'Inactivo',
            'apellido' => 'User',
            'email' => 'inactivo@test.com',
            'password_hash' => Hash::make('Password123!'),
            'estado' => false,
        ]);

        $action = new ActivarUsuario();

        $resultado = $action->execute(
            $usuario->id
        );

        $usuario->refresh();

        $this->assertTrue($resultado);

        $this->assertTrue(
            $usuario->estado
        );
    }
    public function test_no_permite_crear_dos_usuarios_para_el_mismo_empleado()
    {
        $idEmpleadoLibre = 2;

        Usuarios::create([
            'id_empleado' => $idEmpleadoLibre,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'Usuario 1',
            'apellido' => 'Test',
            'email' => 'u1@test.com',
            'password_hash' => Hash::make('Password123!')
        ]);

        $this->expectException(
            ValidationException::class
        );

        (new CrearUsuarioAction())->execute([
            'id_empleado' => $idEmpleadoLibre,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'Usuario 2',
            'apellido' => 'Test',
            'email' => 'u2@test.com',
            'password' => 'Password123!'
        ]);
    }
    public function test_no_permite_asignar_empleado_de_otro_usuario()
    {
        $idEmpleadoLibre = 2;

        $usuario1 = Usuarios::create([
            'id_empleado' => $idEmpleadoLibre,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'A',
            'apellido' => 'A',
            'email' => 'a@test.com',
            'password_hash' => Hash::make('Password123!')
        ]);

        $usuario2 = Usuarios::create([
            'id_empleado' => null,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'B',
            'apellido' => 'B',
            'email' => 'b@test.com',
            'password_hash' => Hash::make('Password123!')
        ]);

        $this->expectException(
            ValidationException::class
        );

        (new ActualizarUsuarioAction())->execute(
            $usuario2,
            [
                'id_empleado' => $idEmpleadoLibre,
                'id_rol' => 1,
                'id_organizacion' => 1,
                'nombre' => 'B',
                'apellido' => 'B',
                'email' => 'b@test.com',
            ]
        );
    }
    public function test_lanza_excepcion_si_usuario_no_existe()
    {
        $this->expectException(
            ModelNotFoundException::class
        );

        $action = new ActivarUsuario();

        $action->execute(999999);
    }
}
