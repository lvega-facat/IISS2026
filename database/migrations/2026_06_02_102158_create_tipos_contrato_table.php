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
        Schema::create('tipos_contrato', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 150)->unique('tipos_contrato_nombre_key');
            $table->text('descripcion')->nullable();
            $table->integer('id_profesion');
            $table->integer('id_horario');
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
        Schema::dropIfExists('tipos_contrato');
    }
};
