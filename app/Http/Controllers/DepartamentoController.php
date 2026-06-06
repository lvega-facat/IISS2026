<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    // Mostrar vista principal
    public function index()
    {
        return view('modules.departamento.index');
    }

    // Guardar nuevo departamento (CREATE)
    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'nombre' => 'required|string|max:255',
            'departamento_padre_id' => 'nullable|integer',
            'empleados' => 'required|integer|min:0',
            'estado' => 'required|string'
        ]);

        
        dd($request->all());
    }
}