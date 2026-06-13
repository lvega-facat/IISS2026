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
        Schema::table('rol_permiso', function (Blueprint $table) {
            $table->foreign(['id_permiso'], 'rol_permiso_id_permiso_fkey')->references(['id'])->on('permisos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_rol'], 'rol_permiso_id_rol_fkey')->references(['id'])->on('roles')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rol_permiso', function (Blueprint $table) {
            $table->dropForeign('rol_permiso_id_permiso_fkey');
            $table->dropForeign('rol_permiso_id_rol_fkey');
        });
    }
};
