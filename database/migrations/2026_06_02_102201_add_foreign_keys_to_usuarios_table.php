<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->foreign(['id_empleado'], 'usuarios_id_empleado_fkey')->references(['id'])->on('empleados')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_organizacion'], 'usuarios_id_organizacion_fkey')->references(['id'])->on('organizaciones')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_rol'], 'usuarios_id_rol_fkey')->references(['id'])->on('roles')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign('usuarios_id_empleado_fkey');
            $table->dropForeign('usuarios_id_organizacion_fkey');
            $table->dropForeign('usuarios_id_rol_fkey');
        });
    }
};
