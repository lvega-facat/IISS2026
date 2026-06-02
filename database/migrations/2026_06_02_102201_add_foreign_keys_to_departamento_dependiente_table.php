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
        Schema::table('departamento_dependiente', function (Blueprint $table) {
            $table->foreign(['id_departamento_hijo'], 'departamento_dependiente_id_departamento_hijo_fkey')->references(['id'])->on('departamentos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_departamento_padre'], 'departamento_dependiente_id_departamento_padre_fkey')->references(['id'])->on('departamentos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departamento_dependiente', function (Blueprint $table) {
            $table->dropForeign('departamento_dependiente_id_departamento_hijo_fkey');
            $table->dropForeign('departamento_dependiente_id_departamento_padre_fkey');
        });
    }
};
