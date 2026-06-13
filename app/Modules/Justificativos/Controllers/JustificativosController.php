<?php

namespace App\Modules\Justificativos\Controllers;

use App\Http\Controllers\Controller;

class JustificativosController extends Controller
{
    public function index()
    {
        return view('Modules.Justificativos.index');
    }
    public function create()
    {
        return view('Modules.Justificativos.form');
        // Lógica para mostrar el formulario de creación
    }
    public function edit($id){
        return view('Modules.Justificativos.form');
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
