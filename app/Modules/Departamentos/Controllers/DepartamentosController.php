<?php

namespace App\Modules\Departamentos\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartamentosController extends Controller
{
    public function index()
    {
        // MOCK / O SERVICIO REAL
        $departamentos = []; // aquí luego va tu query paginada

        return view('Modules.Departamentos.index', compact('departamentos'));
    }

    public function create()
    {
        $departamentosPadre = []; // luego viene del modelo

        return view('Modules.Departamentos.form', compact('departamentosPadre'));
    }

    public function edit($id)
    {
        $departamento = null; // luego: Departamento::findOrFail($id)
        $departamentosPadre = []; // lista para el select

        return view('Modules.Departamentos.form', compact(
            'departamento',
            'departamentosPadre'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required',
            'funcion_principal' => 'required',
        ]);

        // lógica de creación

        return redirect()
            ->route('departamentos.index')
            ->with('success', 'Departamento creado correctamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required',
            'funcion_principal' => 'required',
        ]);

        // lógica de actualización

        return redirect()
            ->route('departamentos.index')
            ->with('success', 'Departamento actualizado correctamente');
    }

    public function destroy($id)
    {
        // lógica eliminar o activar/desactivar

        return redirect()
            ->route('departamentos.index')
            ->with('success', 'Acción realizada correctamente');
    }
}