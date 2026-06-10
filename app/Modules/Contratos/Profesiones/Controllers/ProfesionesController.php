<?php

namespace App\Modules\Profesiones\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profesiones;
use App\Modules\Profesiones\Actions\ActualizarProfesionAction;
use App\Modules\Profesiones\Actions\CrearProfesionAction;
use App\Modules\Profesiones\Actions\DesactivarProfesionAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ProfesionesController extends Controller
{
    public function index()
    {
        try {
            $profesiones = Profesiones::where('estado', true)->get();

            return response()->json([
                'success' => true,
                'data' => $profesiones,
                'message' => 'Profesiones obtenidas exitosamente',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener profesiones',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
        //return view('Modules.Profesiones.index');
    }

    public function create()
    {
        return response()->json([
            'success' => true,
            'message' => 'Formulario para crear profesión',
        ]);
        //return view('Modules.Contratos.Profesiones.form');
    }

    public function store()
    {
        try {
            $validado = $this->validate(request(), [
                'nombre' => 'required|string|max:255|unique:profesiones,nombre',
                'descripcion' => 'nullable|string|max:1000',
            ], [
                'nombre.required' => 'El nombre es obligatorio',
                'nombre.unique' => 'El nombre ya existe',
                'nombre.max' => 'El nombre no puede exceder 255 caracteres',
                'descripcion.max' => 'La descripción no puede exceder 1000 caracteres',
            ]);

            $profesion = (new CrearProfesionAction())($validado);

            return response()->json([
                'success' => true,
                'data' => $profesion,
                'message' => 'Profesión creada exitosamente',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'Datos inválidos',
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear profesión',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
        //return view('Modules.Contratos.Profesiones.index');
    }

    public function show($id)
    {
        try {
            $profesion = Profesiones::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $profesion,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Profesión no encontrada',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener profesión',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $profesion = Profesiones::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $profesion,
                'message' => 'Formulario para editar profesión',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Profesión no encontrada',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener profesión',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function update($id)
    {
        try {
            $profesion = Profesiones::findOrFail($id);

            $validado = $this->validate(request(), [
                'nombre' => 'required|string|max:255|unique:profesiones,nombre,' . $id,
                'descripcion' => 'nullable|string|max:1000',
                'estado' => 'required|boolean',
            ], [
                'nombre.required' => 'El nombre es obligatorio',
                'nombre.unique' => 'El nombre ya existe',
                'nombre.max' => 'El nombre no puede exceder 255 caracteres',
                'descripcion.max' => 'La descripción no puede exceder 1000 caracteres',
                'estado.required' => 'El estado es obligatorio',
                'estado.boolean' => 'El estado debe ser verdadero o falso',
            ]);

            $profesion = (new ActualizarProfesionAction())($profesion, $validado);

            return response()->json([
                'success' => true,
                'data' => $profesion,
                'message' => 'Profesión actualizada exitosamente',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Profesión no encontrada',
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'Datos inválidos',
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar profesión',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $profesion = Profesiones::findOrFail($id);

            (new DesactivarProfesionAction())($profesion);

            return response()->json([
                'success' => true,
                'message' => 'Profesión desactivada exitosamente',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Profesión no encontrada',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al desactivar profesión',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
