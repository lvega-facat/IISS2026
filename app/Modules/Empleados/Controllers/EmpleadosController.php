<?php

namespace App\Modules\Empleados\Controllers;

use App\Http\Controllers\Controller;

class EmpleadosController extends Controller
{
    public function index()
    {
        return view('Modules.Empleados.index');
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
