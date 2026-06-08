<?php

namespace App\Modules\Contratos\Horarios\Controllers;

use App\Http\Controllers\Controller;

class HorariosController extends Controller
{
    public function index()
    {
        return view('Modules.Contratos.Horarios.index');
    }
    public function create()
    {
        return view('Modules.Contratos.Horarios.form');
        // Lógica para mostrar el formulario de creación
    }
    public function edit($id){
        return view('Modules.Contratos.Horarios.form');
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
