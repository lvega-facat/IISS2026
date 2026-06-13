#!/bin/bash

# Guarda este archivo como "generar_modulos.sh" y ejecuta: bash generar_modulos.sh

crear_estructura_modulo() {
    local modulo=$1
    local base_path="app/Modules/$modulo"
    
    # Crear estructura de directorios
    mkdir -p "$base_path"/{Actions,Controllers,Routes,ViewModels}
    
    # Crear archivos .gitkeep
    touch "$base_path"/.gitkeep
    touch "$base_path"/Actions/.gitkeep
    touch "$base_path"/Controllers/.gitkeep
    touch "$base_path"/Routes/.gitkeep
    touch "$base_path"/ViewModels/.gitkeep
    
    # Crear controlador básico
    cat > "$base_path/Controllers/${modulo}Controller.php" << EOF
<?php

namespace App\\Modules\\${modulo}\\Controllers;

use App\\Http\\Controllers\\Controller;

class ${modulo}Controller extends Controller
{
    public function index()
    {
        return view('Modules.${modulo}.index');
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
EOF

    # Crear archivo de rutas
    local prefix=$(echo "$modulo" | tr '[:upper:]' '[:lower:]')
    cat > "$base_path/Routes/web.php" << EOF
<?php

use App\\Modules\\${modulo}\\Controllers\\${modulo}Controller;
use Illuminate\\Support\\Facades\\Route;

Route::prefix('${prefix}')->middleware(['auth'])->group(function () {
    Route::get('/', [${modulo}Controller::class, 'index']);
});
EOF

    echo "✓ Módulo $modulo creado"
}

# Lista de módulos principales
modulos=("Asistencias" "Auditoria" "Autenticacion" "Cargos" "Contratos" "Dashboard" "Departamentos" "Empleados" "Justificativos" "Organizacion" "Planillas" "RolesPermisos" "Usuarios")

# Crear módulos principales
for modulo in "${modulos[@]}"; do
    crear_estructura_modulo "$modulo"
done

# Submódulos específicos para Contratos
submodulos=("Profesiones" "Horarios" "TiposPagos" "TiposFrecuencias" "TiposContrato")

for submodulo in "${submodulos[@]}"; do
    base_path="app/Modules/Contratos/$submodulo"
    
    # Crear estructura de submódulo
    mkdir -p "$base_path"/{Actions,Controllers,ViewModels}
    
    # Crear archivos .gitkeep
    touch "$base_path"/.gitkeep
    touch "$base_path"/Actions/.gitkeep
    touch "$base_path"/Controllers/.gitkeep
    touch "$base_path"/ViewModels/.gitkeep
    
    # Crear controlador para submódulo
    cat > "$base_path/Controllers/${submodulo}Controller.php" << EOF
<?php

namespace App\\Modules\\Contratos\\${submodulo}\\Controllers;

use App\\Http\\Controllers\\Controller;

class ${submodulo}Controller extends Controller
{
    public function index()
    {
        return view('Modules.Contratos.${submodulo}.index');
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
EOF

    echo "  ✓ Submódulo $submodulo creado dentro de Contratos"
done

echo "✅ ¡Estructura completada!"