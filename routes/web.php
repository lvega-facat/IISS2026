<?php

use App\Modules\RolesPermisos\Actions\ObtenerPermisosPorModuloAction;
use App\Modules\RolesPermisos\Actions\ObtenerRolesAction;
use App\Modules\RolesPermisos\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Usuarios\Controllers\UsuariosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-roles', function (
    Request $request,
    ObtenerRolesAction $obtenerRolesAction,
    ObtenerPermisosPorModuloAction $obtenerPermisosPorModuloAction
) {
    $roleId = $request->query('id_rol');
    $roleId = $roleId !== null ? (int) $roleId : null;

    return response()->json([
        'roles' => $obtenerRolesAction->handle(),
        'detalle' => $roleId ? $obtenerRolesAction->handle($roleId) : null,
        'permisos_por_modulo' => $obtenerPermisosPorModuloAction->handle($roleId),
    ]);
});

Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::get('permisos/por-modulo', [RoleController::class, 'permisosPorModulo']);
    Route::get('{id}', [RoleController::class, 'show'])->whereNumber('id');
    Route::post('/', [RoleController::class, 'store']);
    Route::put('{id}', [RoleController::class, 'update'])->whereNumber('id');
    Route::delete('{id}', [RoleController::class, 'destroy'])->whereNumber('id');
    Route::post('{id}/permisos', [RoleController::class, 'asignarPermisos'])->whereNumber('id');
});
