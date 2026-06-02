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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_empleado')->nullable()->unique('usuarios_id_empleado_key');
            $table->integer('id_rol');
            $table->integer('id_organizacion');
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email', 150)->unique('usuarios_email_key');
            $table->string('password_hash');
            $table->string('foto_url', 500)->nullable();
            $table->boolean('estado')->default(true);
            $table->integer('intentos_fallidos')->nullable()->default(0);
            $table->timestamp('bloqueado_hasta')->nullable();
            $table->timestamp('ultimo_acceso')->nullable();
            $table->timestamp('created_at')->nullable()->default(DB::raw("now()"));
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
