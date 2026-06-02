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
        Schema::table('planilla_detalles', function (Blueprint $table) {
            $table->foreign(['id_contrato'], 'planilla_detalles_id_contrato_fkey')->references(['id'])->on('contratos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_empleado'], 'planilla_detalles_id_empleado_fkey')->references(['id'])->on('empleados')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_planilla'], 'planilla_detalles_id_planilla_fkey')->references(['id'])->on('planillas')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('planilla_detalles', function (Blueprint $table) {
            $table->dropForeign('planilla_detalles_id_contrato_fkey');
            $table->dropForeign('planilla_detalles_id_empleado_fkey');
            $table->dropForeign('planilla_detalles_id_planilla_fkey');
        });
    }
};
