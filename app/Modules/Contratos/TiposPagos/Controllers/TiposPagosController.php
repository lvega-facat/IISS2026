<?php

namespace App\Modules\Contratos\TiposPagos\Controllers;

use App\Http\Controllers\Controller;

class TiposPagosController extends Controller
{
    public function index()
    {
        return view('Modules.Contratos.TiposPagos.index');
    }
    public function create()
    {
        return view('Modules.Contratos.TiposPagos.form');
        // Lógica para mostrar el formulario de creación
    }
    public function edit($id){
        return view('Modules.Contratos.TiposPagos.form');
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
