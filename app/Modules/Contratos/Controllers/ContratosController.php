<?php

namespace App\Modules\Contratos\Controllers;

use App\Http\Controllers\Controller;

class ContratosController extends Controller
{
    public function index()
    {
        return view('Modules.Contratos.index');
    }
    public function create()
    {
        return view('Modules.Contratos.form');
        // Lógica para mostrar el formulario de creación
    }
    public function edit($id){
        return view('Modules.Contratos.form');
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
