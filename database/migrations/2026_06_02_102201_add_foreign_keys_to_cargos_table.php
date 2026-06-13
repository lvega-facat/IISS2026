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
        Schema::table('cargos', function (Blueprint $table) {
            $table->foreign(['id_cargo_padre'], 'cargos_id_cargo_padre_fkey')->references(['id'])->on('cargos')->onUpdate('no action')->onDelete('set null');
            $table->foreign(['id_departamento'], 'cargos_id_departamento_fkey')->references(['id'])->on('departamentos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cargos', function (Blueprint $table) {
            $table->dropForeign('cargos_id_cargo_padre_fkey');
            $table->dropForeign('cargos_id_departamento_fkey');
        });
    }
};
