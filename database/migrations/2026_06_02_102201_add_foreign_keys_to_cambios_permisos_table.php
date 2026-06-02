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
        Schema::table('cambios_permisos', function (Blueprint $table) {
            $table->foreign(['id_modulo'], 'cambios_permisos_id_modulo_fkey')->references(['id'])->on('modulos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_rol'], 'cambios_permisos_id_rol_fkey')->references(['id'])->on('roles')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_usuario'], 'fk_cambios_permisos_usuario')->references(['id'])->on('usuarios')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cambios_permisos', function (Blueprint $table) {
            $table->dropForeign('cambios_permisos_id_modulo_fkey');
            $table->dropForeign('cambios_permisos_id_rol_fkey');
            $table->dropForeign('fk_cambios_permisos_usuario');
        });
    }
};
