<?php

namespace Tests\Feature;

use App\Models\Usuarios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['logging.default' => 'errorlog']);
    }
    public function test_login_successful_authenticates_user(): void
    {
        $user = new Usuarios([
            'id' => 1,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'Ana',
            'apellido' => 'Perez',
            'email' => 'ana@example.com',
            'password_hash' => Hash::make('secret123'),
            'estado' => true,
        ]);

        $mockLoginAction = new class($user) extends \App\Modules\Autenticacion\Actions\LoginAction {
            private $user;
            public function __construct($user) { $this->user = $user; }
            public function attempt(string $email, string $password, ?string $ipAddress = null, ?string $userAgent = null, ?string $ruta = null): array {
                \Illuminate\Support\Facades\Auth::login($this->user);
                return ['status' => 'success', 'message' => 'OK', 'user' => $this->user];
            }
        };

        $this->app->instance(\App\Modules\Autenticacion\Actions\LoginAction::class, $mockLoginAction);

        $response = $this->post('/login', [
            'email' => 'ana@example.com',
            'password' => 'secret123',
        ]);

        $response->assertRedirect('/');
        $this->assertTrue(Auth::check());
    }

    public function test_invalid_password_triggers_failed_attempt_handler(): void
    {
        $user = new Usuarios([
            'id' => 2,
            'id_rol' => 1,
            'id_organizacion' => 1,
            'nombre' => 'Luis',
            'apellido' => 'Garcia',
            'email' => 'luis@example.com',
            'password_hash' => Hash::make('secret123'),
            'estado' => true,
        ]);

        $mockLoginAction = new class($user) extends \App\Modules\Autenticacion\Actions\LoginAction {
            private $user;
            public function __construct($user) { $this->user = $user; }
            public function attempt(string $email, string $password, ?string $ipAddress = null, ?string $userAgent = null, ?string $ruta = null): array {
                return ['status' => 'invalid_credentials', 'message' => 'invalid', 'user' => $this->user];
            }
        };

        $mockGestion = new class extends \App\Modules\Autenticacion\Actions\GestionarIntentoFallidoAction {
            public $called = false;
            public function handle(\App\Models\Usuarios $user, ?string $ipAddress = null, ?string $ruta = null): void { $this->called = true; }
        };

        $this->app->instance(\App\Modules\Autenticacion\Actions\LoginAction::class, $mockLoginAction);
        $this->app->instance(\App\Modules\Autenticacion\Actions\GestionarIntentoFallidoAction::class, $mockGestion);

        $response = $this->from('/login')->post('/login', [
            'email' => 'luis@example.com',
            'password' => 'wrong',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors(['email']);
        $this->assertFalse(Auth::check());
        $this->assertTrue($mockGestion->called, 'Failed attempt handler was not called');
    }

    public function test_blocked_user_gets_error_and_is_not_authenticated(): void
    {
        $user = new Usuarios(['email' => 'blocked@example.com']);

        $mockLoginAction = new class($user) extends \App\Modules\Autenticacion\Actions\LoginAction {
            private $user;
            public function __construct($user) { $this->user = $user; }
            public function attempt(string $email, string $password, ?string $ipAddress = null, ?string $userAgent = null, ?string $ruta = null): array {
                return ['status' => 'blocked', 'message' => 'blocked', 'user' => $this->user];
            }
        };

        $this->app->instance(\App\Modules\Autenticacion\Actions\LoginAction::class, $mockLoginAction);

        $response = $this->from('/login')->post('/login', [
            'email' => 'blocked@example.com',
            'password' => 'any',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors(['email']);
        $this->assertFalse(Auth::check());
    }

    public function test_expired_lock_allows_login_when_login_action_handles_cleanup(): void
    {
        $user = new Usuarios(['email' => 'exp@example.com']);

        $mockLoginAction = new class($user) extends \App\Modules\Autenticacion\Actions\LoginAction {
            private $user;
            public function __construct($user) { $this->user = $user; }
            public function attempt(string $email, string $password, ?string $ipAddress = null, ?string $userAgent = null, ?string $ruta = null): array {
                \Illuminate\Support\Facades\Auth::login($this->user);
                return ['status' => 'success', 'message' => 'OK', 'user' => $this->user];
            }
        };

        $this->app->instance(\App\Modules\Autenticacion\Actions\LoginAction::class, $mockLoginAction);

        $response = $this->post('/login', [
            'email' => 'exp@example.com',
            'password' => 'secret',
        ]);

        $response->assertRedirect('/');
        $this->assertTrue(Auth::check());
    }
}
