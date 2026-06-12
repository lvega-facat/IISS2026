<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModuleRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $modulesPath = app_path('Modules');

        foreach (File::directories($modulesPath) as $module) {

            $webRoutes = File::exists($module . '/Routes/web.php')
                ? $module . '/Routes/web.php'
                : $module . '/routes/web.php';

            if (File::exists($webRoutes)) {
                Route::middleware('web')
                    ->group($webRoutes);
            }

            $apiRoutes = File::exists($module . '/Routes/api.php')
                ? $module . '/Routes/api.php'
                : $module . '/routes/api.php';

            if (File::exists($apiRoutes)) {
                Route::prefix('api')
                    ->middleware('api')
                    ->group($apiRoutes);
            }
        }
    }
}