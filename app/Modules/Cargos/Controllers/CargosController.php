<?php

namespace App\Modules\Cargos\Controllers;

use App\Http\Controllers\Controller;

class CargosController extends Controller
{
    public function index()
    {
        return view('Modules.Cargos.index');
    }
    public function create()
    {
        return view('Modules.Cargos.form');
        // Lógica para mostrar el formulario de creación
    }
    public function edit($id){
        return view('Modules.Cargos.form');
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
