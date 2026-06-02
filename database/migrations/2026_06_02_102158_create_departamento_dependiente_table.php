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
        Schema::create('departamento_dependiente', function (Blueprint $table) {
            $table->increments('id_dependencia');
            $table->integer('id_departamento_padre');
            $table->integer('id_departamento_hijo');
            $table->string('tipo_dependencia', 50)->nullable();

            $table->unique(['id_departamento_padre', 'id_departamento_hijo'], 'unique_padre_hijo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamento_dependiente');
    }
};
