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
        Schema::table('tipos_contrato', function (Blueprint $table) {
            $table->foreign(['id_horario'], 'tipos_contrato_id_horario_fkey')->references(['id'])->on('horarios_trabajo')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_profesion'], 'tipos_contrato_id_profesion_fkey')->references(['id'])->on('profesiones')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipos_contrato', function (Blueprint $table) {
            $table->dropForeign('tipos_contrato_id_horario_fkey');
            $table->dropForeign('tipos_contrato_id_profesion_fkey');
        });
    }
};
