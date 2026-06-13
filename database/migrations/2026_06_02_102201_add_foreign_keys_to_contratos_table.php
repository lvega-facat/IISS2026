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
        Schema::table('contratos', function (Blueprint $table) {
            $table->foreign(['id_empleado'], 'contratos_id_empleado_fkey')->references(['id'])->on('empleados')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_frecuencia_pago'], 'contratos_id_frecuencia_pago_fkey')->references(['id'])->on('frecuencias_pago')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_tipo_contrato'], 'contratos_id_tipo_contrato_fkey')->references(['id'])->on('tipos_contrato')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_tipo_pago'], 'contratos_id_tipo_pago_fkey')->references(['id'])->on('tipos_pago')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropForeign('contratos_id_empleado_fkey');
            $table->dropForeign('contratos_id_frecuencia_pago_fkey');
            $table->dropForeign('contratos_id_tipo_contrato_fkey');
            $table->dropForeign('contratos_id_tipo_pago_fkey');
        });
    }
};
