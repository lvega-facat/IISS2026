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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_empleado');
            $table->integer('id_contrato');
            $table->integer('id_estado_asistencia');
            $table->date('fecha_entrada');
            $table->time('hora_entrada')->nullable();
            $table->time('hora_salida')->nullable();
            $table->integer('minutos_tardanza')->nullable()->default(0);
            $table->decimal('horas_trabajadas', 5)->nullable();
            $table->decimal('horas_extra', 5)->nullable();
            $table->decimal('horas_ausentes', 5)->nullable();
            $table->boolean('tiene_justificativo')->nullable()->default(false);
            $table->timestamp('created_at')->nullable()->default(DB::raw("now()"));
            $table->timestamp('updated_at')->nullable();

            $table->unique(['id_empleado', 'fecha_entrada'], 'asistencias_id_empleado_fecha_entrada_key');
            $table->index(['id_contrato', 'fecha_entrada'], 'idx_asistencias_contrato_fecha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
