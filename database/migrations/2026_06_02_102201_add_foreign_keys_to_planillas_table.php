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
        Schema::table('planillas', function (Blueprint $table) {
            $table->foreign(['generado_por'], 'planillas_generado_por_fkey')->references(['id'])->on('usuarios')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_organizacion'], 'planillas_id_organizacion_fkey')->references(['id'])->on('organizaciones')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('planillas', function (Blueprint $table) {
            $table->dropForeign('planillas_generado_por_fkey');
            $table->dropForeign('planillas_id_organizacion_fkey');
        });
    }
};
