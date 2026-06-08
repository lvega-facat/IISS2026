<?php

namespace App\Modules\Departamentos\Controllers;

use App\Http\Controllers\Controller;

class DepartamentosController extends Controller
{
    public function index()
    {
        return view('Modules.Departamentos.index');
    }
    public function create()
    {
        return view('Modules.Departamentos.form');
        // Lógica para mostrar el formulario de creación
    }
    public function edit($id)
    {
        return view('Modules.Departamentos.form');
        // Lógica para mostrar el formulario de edición
    }

    public function store()
    {
        // Lógica para crear
    }

    public function update()
    {
        // Lógica para actualizar
    }

    public function destroy()
    {
        // Lógica para eliminar
    }
}
