<?php

namespace App\Modules\Usuarios\Controllers;

use App\Models\Usuarios;
use App\Models\Empleados;
use App\Models\Roles;
use App\Modules\Usuarios\Actions\CrearUsuarioAction;
use App\Modules\Usuarios\Actions\ActualizarUsuarioAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsuariosController
{
    public function index(): View
    {
        $usuarios = Usuarios::with(['empleados', 'roles'])->latest()->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create(): View
    {
        $empleados = Empleados::whereNotIn('id', Usuarios::pluck('id_empleado'))->get();
        $roles = Roles::where('estado', true)->get();
        return view('usuarios.create', compact('empleados', 'roles'));
    }

    public function store(
        Request $request,
        CrearUsuarioAction $action
    ): RedirectResponse {
        $validated = $request->validate([
            'id_empleado' => ['required', 'integer', 'exists:empleados,id'],
            'id_rol' => ['required', 'integer', 'exists:roles,id'],
            'email' => ['required', 'email', 'unique:usuarios,email'],
            'password_hash' => ['required', 'string', 'min:8'],
        ]);

        $result = $action->handle($validated);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function show(Usuarios $usuario): View
    {
        $usuario->load(['empleados', 'roles']);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuarios $usuario): View
    {
        $empleados = Empleados::whereNotIn('id', Usuarios::where('id', '!=', $usuario->id)
            ->pluck('id_empleado'))->get();
        $roles = Roles::where('estado', true)->get();
        $usuario->load(['empleados', 'roles']);
        return view('usuarios.edit', compact('usuario', 'empleados', 'roles'));
    }

    public function update(
        Request $request,
        Usuarios $usuario,
        ActualizarUsuarioAction $action
    ): RedirectResponse {
        $validated = $request->validate([
            'id_rol' => ['required', 'integer', 'exists:roles,id'],
            'estado' => ['boolean'],
            'password_hash' => ['nullable', 'string', 'min:8'],
        ]);

        $action->handle($usuario, $validated);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(Usuarios $usuario): RedirectResponse
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
