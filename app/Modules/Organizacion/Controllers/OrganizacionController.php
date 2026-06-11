<?php

namespace App\Modules\Organizacion\Controllers;
use App\Http\Controllers\Controller;

class OrganizacionController extends Controller
{
    public function show()
    {
        $organizacion = (object) [
            'nombre' => 'Demo',
            'ruc' => '000',
            'fecha_registro' => now(),
            'direccion' => '',
            'pais' => '',
            'email' => '',
            'telefono' => '',
            'sector' => '',
            'logo_url' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        return view('Modules.organizacion.show', compact('organizacion'));
    }

    public function form()
    {
        return view('Modules.organizacion.form');
    }
}