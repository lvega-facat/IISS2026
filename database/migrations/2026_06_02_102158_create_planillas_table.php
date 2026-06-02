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
        Schema::create('planillas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_organizacion');
            $table->date('periodo_inicio');
            $table->date('periodo_fin');
            $table->string('estado', 30)->default('En_proceso');
            $table->integer('generado_por');
            $table->timestamp('created_at')->nullable()->default(DB::raw("now()"));
            $table->timestamp('updated_at')->nullable();

            $table->index(['id_organizacion', 'periodo_inicio', 'periodo_fin'], 'idx_planillas_org_periodo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planillas');
    }
};
