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
        Schema::create('justificativos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_asistencia')->unique('justificativos_id_asistencia_key');
            $table->integer('id_aprobador')->nullable();
            $table->string('tipo_justificativo', 100);
            $table->text('descripcion')->nullable();
            $table->string('archivo_url', 500)->nullable();
            $table->string('estado_aprobacion', 20)->default('Pendiente');
            $table->timestamp('fecha_aprobacion')->nullable();
            $table->timestamp('created_at')->nullable()->default(DB::raw("now()"));
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('justificativos');
    }
};
