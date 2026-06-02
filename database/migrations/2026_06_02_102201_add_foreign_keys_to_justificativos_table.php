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
        Schema::table('justificativos', function (Blueprint $table) {
            $table->foreign(['id_aprobador'], 'justificativos_id_aprobador_fkey')->references(['id'])->on('usuarios')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_asistencia'], 'justificativos_id_asistencia_fkey')->references(['id'])->on('asistencias')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('justificativos', function (Blueprint $table) {
            $table->dropForeign('justificativos_id_aprobador_fkey');
            $table->dropForeign('justificativos_id_asistencia_fkey');
        });
    }
};
