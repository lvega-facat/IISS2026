<?php

namespace App\Modules\Usuarios\Controllers;

use App\Modules\Usuarios\Actions\CrearUsuarioAction;
use App\Modules\Usuarios\Actions\ActualizarUsuarioAction;
use App\Modules\Usuarios\Actions\SoftEliminarUsuarioAction;
use App\Modules\Usuarios\Actions\ActivarUsuario;
use App\Models\Usuarios; // Ajusta la ruta según tu estructura
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuariosController extends Controller
{
    protected $crearUsuarioAction;
    protected $actualizarUsuarioAction;
    protected $eliminarUsuarioAction;
    protected $cambiarEstadoUsuarioAction;

    public function __construct(
        CrearUsuarioAction $crearUsuarioAction,
        ActualizarUsuarioAction $actualizarUsuarioAction,
        SoftEliminarUsuarioAction $eliminarUsuarioAction,
        ActivarUsuario $cambiarEstadoUsuarioAction,
    ) {
        $this->crearUsuarioAction = $crearUsuarioAction;
        $this->actualizarUsuarioAction = $actualizarUsuarioAction;
        $this->eliminarUsuarioAction = $eliminarUsuarioAction;
        $this->cambiarEstadoUsuarioAction = $cambiarEstadoUsuarioAction;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('Modules.Usuarios.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_empleado' => 'nullable|exists:empleados,id',
            'id_rol' => 'required|exists:roles,id',
            'id_organizacion' => 'required|exists:organizaciones,id',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
            'foto_url' => 'nullable|url|max:255',
            'estado' => 'boolean'
        ]);

        try {
            $usuario = $this->crearUsuarioAction->execute($validated);
            
            return redirect()->route('usuarios.index')->with([
                'exito' => true,
                'mensaje' => 'Usuario creado exitosamente',
                'usuario' => $usuario
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'exito' => false,
                'mensaje' => 'Error al crear el usuario: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'id_empleado' => 'nullable|exists:empleados,id',
            'id_rol' => 'required|exists:roles,id',
            'id_organizacion' => 'required|exists:organizaciones,id',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'foto_url' => 'nullable|url|max:255',
            'estado' => 'boolean'
        ]);

        try {
            $usuario = Usuarios::findOrFail($id);
            $usuarioActualizado = $this->actualizarUsuarioAction->execute($usuario, $validated);
            
            return redirect()->route('usuarios.index')->with([
                'exito' => true,
                'mensaje' => 'Usuario actualizado exitosamente'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with([
                'exito' => false,
                'mensaje' => 'Usuario no encontrado'
            ])->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'exito' => false,
                'mensaje' => 'Error al actualizar el usuario: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $usuario = Usuarios::findOrFail($id);
            $this->eliminarUsuarioAction->execute($usuario);
            
            return redirect()->route('usuarios.index')->with([
                'exito' => true,
                'mensaje' => 'Usuario eliminado exitosamente'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with([
                'exito' => false,
                'mensaje' => 'Usuario no encontrado'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'exito' => false,
                'mensaje' => 'Error al eliminar el usuario: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Change user status (activate/deactivate).
     */
    public function activate(string $id)
    {
        try {
            $usuario = Usuarios::findOrFail($id);
            $usuarioActualizado = $this->cambiarEstadoUsuarioAction->execute($usuario);
            
            $textoEstado = $usuarioActualizado->estado ? 'activado' : 'desactivado';
            
            return redirect()->route('usuarios.index')->with([
                'exito' => true,
                'mensaje' => "Usuario {$textoEstado} exitosamente"
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with([
                'exito' => false,
                'mensaje' => 'Usuario no encontrado'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'exito' => false,
                'mensaje' => 'Error al cambiar el estado del usuario: ' . $e->getMessage()
            ]);
        }
    }
}