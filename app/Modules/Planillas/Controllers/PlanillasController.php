<?php

namespace App\Modules\Planillas\Controllers;

use App\Http\Controllers\Controller;

class PlanillasController extends Controller
{
    public function index()
    {
        return view('Modules.Planillas.index');
    }
    public function create()
    {
        return view('Modules.Planillas.form');
        // Lógica para mostrar el formulario de creación
    }
    public function edit($id){
        return view('Modules.Planillas.form');
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
