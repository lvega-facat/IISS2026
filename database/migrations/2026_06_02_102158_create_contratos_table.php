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
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_empleado');
            $table->integer('id_tipo_contrato');
            $table->decimal('monto_base', 12);
            $table->date('fecha_inicio');
            $table->integer('id_tipo_pago');
            $table->integer('id_frecuencia_pago');
            $table->date('fecha_fin')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamp('created_at')->nullable()->default(DB::raw("now()"));
            $table->timestamp('updated_at')->nullable();

            $table->index(['id_empleado', 'estado'], 'idx_contratos_empleado_estado');
            $table->index(['id_empleado', 'fecha_inicio'], 'idx_contratos_empleado_inicio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
