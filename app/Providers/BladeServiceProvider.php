<?php
// app/Providers/BladeServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Modules\RolesPermisos\Actions\ObtenerPermisosUsuarioAction;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 🏆 ULTRA OPTIMIZADO: Singleton en el contenedor
        $this->app->singleton('permisos.usuario', function ($app) {
            return function ($usuarioId) use ($app) {
                return $app->make(ObtenerPermisosUsuarioAction::class)->execute($usuarioId);
            };
        });
        
        // Directiva que usa el singleton
        Blade::directive('can', function ($expression) {
            return "<?php 
                if (!function_exists('checkUserPermission')) {
                    function checkUserPermission(\$permiso, \$usuarioId) {
                        static \$permisosCache = [];
                        if (!isset(\$permisosCache[\$usuarioId])) {
                            \$permisosCache[\$usuarioId] = app('permisos.usuario')(\$usuarioId);
                        }
                        return in_array(strtolower(\$permiso), \$permisosCache[\$usuarioId]);
                    }
                }
                if (checkUserPermission({$expression}, auth()->id())):
            ?>";
        });
        
        Blade::directive('endcan', function () {
            return "<?php endif; ?>";
        });
    }
}