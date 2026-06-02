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
        Schema::table('empleados', function (Blueprint $table) {
            $table->foreign(['id_cargo'], 'empleados_id_cargo_fkey')->references(['id'])->on('cargos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_departamento'], 'empleados_id_departamento_fkey')->references(['id'])->on('departamentos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_profesion'], 'empleados_id_profesion_fkey')->references(['id'])->on('profesiones')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropForeign('empleados_id_cargo_fkey');
            $table->dropForeign('empleados_id_departamento_fkey');
            $table->dropForeign('empleados_id_profesion_fkey');
        });
    }
};
