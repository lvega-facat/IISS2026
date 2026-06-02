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
        Schema::table('asistencias', function (Blueprint $table) {
            $table->foreign(['id_contrato'], 'asistencias_id_contrato_fkey')->references(['id'])->on('contratos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_empleado'], 'asistencias_id_empleado_fkey')->references(['id'])->on('empleados')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_estado_asistencia'], 'asistencias_id_estado_asistencia_fkey')->references(['id'])->on('cat_estados_asistencia')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asistencias', function (Blueprint $table) {
            $table->dropForeign('asistencias_id_contrato_fkey');
            $table->dropForeign('asistencias_id_empleado_fkey');
            $table->dropForeign('asistencias_id_estado_asistencia_fkey');
        });
    }
};
