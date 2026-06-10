<?php

namespace App\Modules\Contratos\Profesiones\Controllers;

use App\Http\Controllers\Controller;

class ProfesionesController extends Controller
{
    public function index()
    {
        return view('Modules.Contratos.Profesiones.index');
    }
    public function create()
    {
        return view('Modules.Contratos.Profesiones.form');
        // Lógica para mostrar el formulario de creación
    }
    public function edit($id){
        return view('Modules.Contratos.Profesiones.form');
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
