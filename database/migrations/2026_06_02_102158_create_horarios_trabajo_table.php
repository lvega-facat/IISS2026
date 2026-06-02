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
        Schema::create('horarios_trabajo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->string('tipo_jornada', 50);
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->decimal('horas_diarias', 5)->nullable();
            $table->decimal('horas_semanales', 5)->nullable();
            $table->integer('tolerancia_minutos')->nullable()->default(0);
            $table->boolean('estado')->default(true);
            $table->timestamp('created_at')->nullable()->default(DB::raw("now()"));
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_trabajo');
    }
};
