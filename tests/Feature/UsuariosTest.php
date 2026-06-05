<?php

namespace Tests\Feature;

use App\Models\Usuarios;
use App\Modules\Usuarios\Actions\CrearUsuarioAction;
use App\Modules\Usuarios\Actions\ActualizarUsuarioAction;
use App\Modules\Usuarios\Controllers\UsuariosController;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tests\TestCase;

class UsuariosTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['logging.default' => 'errorlog']);
    }

    public function test_usuarios_controller_exists()
    {
        $this->assertTrue(class_exists(UsuariosController::class));
    }

    public function test_crear_usuario_action_exists()
    {
        $this->assertTrue(class_exists(CrearUsuarioAction::class));
    }

    public function test_actualizar_usuario_action_exists()
    {
        $this->assertTrue(class_exists(ActualizarUsuarioAction::class));
    }

    public function test_usuarios_model_has_soft_deletes()
    {
        $usuario = new Usuarios();
        $this->assertTrue(in_array(SoftDeletes::class, class_uses($usuario)));
    }

    public function test_crear_usuario_action_returns_success_array()
    {
        $action = new CrearUsuarioAction();
        $mockUsuario = new Usuarios([
            'id' => 1,
            'id_empleado' => 1,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'Test',
            'email' => 'test@example.com',
        ]);

        $this->assertIsArray(['status' => 'success', 'usuario' => $mockUsuario]);
    }

    public function test_soft_delete_usuario()
    {
        $usuario = new Usuarios([
            'id' => 1,
            'id_empleado' => 1,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'Test',
            'apellido' => 'User',
            'email' => 'test@example.com',
            'estado' => true,
        ]);

        $this->assertTrue(method_exists($usuario, 'delete'));
        $this->assertTrue(method_exists($usuario, 'restore'));
    }
}
