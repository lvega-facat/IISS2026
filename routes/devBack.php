<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

//test de permisos
Route::get('/test-permisos', function () {
    return 'OK';
})->middleware('auth');


Route::get('/cache-test', function () {

    Cache::put(
        'usuario:3:permisos',
        [
            'empleados.ver',
            'empleados.crear'
        ],
        now()->addHour()
    );

    return response()->json([
        'driver' => config('cache.default'),
        'existe' => Cache::has('usuario:3:permisos'),
        'valor' => Cache::get('usuario:3:permisos'),
    ]);
});
