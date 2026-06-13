<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('planilla_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_planilla');
            $table->integer('id_empleado');
            $table->integer('id_contrato')->index('idx_planilla_detalles_contrato');
            $table->decimal('salario_base_aplicado', 12);
            $table->decimal('horas_trabajadas', 7)->nullable();
            $table->decimal('horas_extra', 7)->nullable();
            $table->decimal('total_horas_extra_monto', 12)->nullable()->default(0);
            $table->decimal('bonos', 12)->nullable()->default(0);
            $table->decimal('descuentos', 12)->nullable()->default(0);
            $table->decimal('total_bruto', 12);
            $table->decimal('total_pagar', 12);
            $table->string('estado_pago', 20)->nullable()->default('Pendiente');
            $table->string('unidad_calculo_aplicada', 20)->nullable();
            $table->integer('frecuencia_dias_aplicada')->nullable();
            $table->decimal('horas_diarias_aplicadas', 5)->nullable();
            $table->timestamp('created_at')->nullable()->default(DB::raw("now()"));

            $table->unique(['id_planilla', 'id_empleado'], 'planilla_detalles_id_planilla_id_empleado_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planilla_detalles');
    }
};
