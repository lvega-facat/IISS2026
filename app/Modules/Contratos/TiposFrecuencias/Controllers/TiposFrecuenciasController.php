<?php

namespace App\Modules\Contratos\TiposFrecuencias\Controllers;

use App\Http\Controllers\Controller;

class TiposFrecuenciasController extends Controller
{
    public function index()
    {
        return view('Modules.Contratos.TiposFrecuencias.index');
    }
    public function create()
    {
        return view('Modules.Contratos.TiposFrecuencias.form');
        // Lógica para mostrar el formulario de creación
    }
    public function edit($id){
        return view('Modules.Contratos.TiposFrecuencias.form');
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
