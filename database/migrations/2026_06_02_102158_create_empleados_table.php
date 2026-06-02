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
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_departamento');
            $table->integer('id_cargo')->nullable();
            $table->integer('id_profesion')->nullable();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email', 150)->unique('empleados_email_key');
            $table->string('dni_ci', 30)->unique('empleados_dni_ci_key');
            $table->string('telefono', 30)->nullable();
            $table->string('tipo_trabajo', 30)->nullable();
            $table->date('fecha_registro');
            $table->text('descripcion')->nullable();
            $table->string('foto_url', 500)->nullable();
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
        Schema::dropIfExists('empleados');
    }
};
