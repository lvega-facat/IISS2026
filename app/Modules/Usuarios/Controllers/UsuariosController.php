<?php

namespace App\Modules\Usuarios\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Modules\Usuarios\Actions\CrearUsuarioAction;
use App\Modules\Usuarios\Actions\ActualizarUsuarioAction;
use App\Modules\Usuarios\Actions\CambiarPasswordUsuarioAction;
use App\Modules\Usuarios\Actions\SoftELiminarUsuarioAction;
use App\Modules\Usuarios\Actions\ActivarUsuario;

class UsuariosController extends Controller
{
    public function __construct(
        protected CrearUsuarioAction $crearUsuarioAction,
        protected ActualizarUsuarioAction $actualizarUsuarioAction,
        protected CambiarPasswordUsuarioAction $cambiarPasswordUsuarioAction,
        protected SoftELiminarUsuarioAction $softEliminarUsuarioAction,
        protected ActivarUsuario $activarUsuarioAction,
    ) {}

    /**
     * Listado
     */
    public function index()
    {
        return view('Modules.Usuarios.index');
    }

    /**
     * Formulario alta
     */
    public function create()
    {
        return view('Modules.Usuarios.form');
    }

    /**
     * Formulario edición
     */
    public function edit(int $id)
    {
        $usuario = Usuarios::findOrFail($id);

        return view('Modules.Usuarios.form', compact('usuario'));
    }

    /**
     * Crear usuario
     */
    public function store(Request $request)
    {
        try {

            $this->crearUsuarioAction->execute(
                $request->all()
            );

            return redirect()
                ->route('usuarios.index')
                ->with('success', 'Usuario creado correctamente');
        } catch (ValidationException $e) {

            return back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Throwable $e) {

            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, int $id)
    {
        try {

            $usuario = Usuarios::findOrFail($id);

            $this->actualizarUsuarioAction->execute(
                $usuario,
                $request->all()
            );

            return redirect()
                ->route('usuarios.index')
                ->with('success', 'Usuario actualizado correctamente');
        } catch (ModelNotFoundException $e) {

            return redirect()
                ->route('usuarios.index')
                ->with('error', 'Usuario no encontrado');
        } catch (ValidationException $e) {

            return back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Throwable $e) {

            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Baja lógica
     */
    public function destroy(int $id)
    {
        try {

            $usuario = Usuarios::findOrFail($id);

            $this->softEliminarUsuarioAction->execute(
                $usuario
            );

            return redirect()
                ->route('usuarios.index')
                ->with('success', 'Usuario desactivado correctamente');
        } catch (ModelNotFoundException $e) {

            return redirect()
                ->route('usuarios.index')
                ->with('error', 'Usuario no encontrado');
        } catch (\Throwable $e) {

            return redirect()
                ->route('usuarios.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Activar usuario
     */
    public function activar(int $id)
    {
        try {

            $this->activarUsuarioAction->execute($id);

            return redirect()
                ->route('usuarios.index')
                ->with('success', 'Usuario activado correctamente');
        } catch (ModelNotFoundException $e) {

            return redirect()
                ->route('usuarios.index')
                ->with('error', 'Usuario no encontrado');
        } catch (\Throwable $e) {

            return redirect()
                ->route('usuarios.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Pantalla cambio password
     */
    public function editPassword(int $id)
    {
        $usuario = Usuarios::findOrFail($id);

        return view(
            'Modules.Usuarios.password',
            compact('usuario')
        );
    }

    /**
     * Guardar password
     */
    public function updatePassword(Request $request, int $id)
    {
        try {

            $usuario = Usuarios::findOrFail($id);

            $this->cambiarPasswordUsuarioAction->execute(
                $usuario,
                $request->password,
                $request->password_confirmation
            );

            return redirect()
                ->route('usuarios.index')
                ->with(
                    'success',
                    'Contraseña actualizada correctamente'
                );
        } catch (ValidationException $e) {

            return back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (ModelNotFoundException $e) {

            return redirect()
                ->route('usuarios.index')
                ->with('error', 'Usuario no encontrado');
        } catch (\Throwable $e) {

            return back()
                ->with('error', $e->getMessage());
        }
    }
}