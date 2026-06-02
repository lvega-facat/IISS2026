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
        Schema::create('auditoria_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->nullable();
            $table->string('modulo', 100);
            $table->string('accion', 100);
            $table->text('valor_anterior')->nullable();
            $table->text('valor_nuevo')->nullable();
            $table->string('ip_origen', 45)->nullable();
            $table->string('ruta')->nullable();
            $table->timestamp('timestamp')->default(DB::raw("now()"));

            $table->index(['modulo', 'timestamp'], 'idx_auditoria_modulo_ts');
            $table->index(['id_usuario', 'timestamp'], 'idx_auditoria_usuario_ts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditoria_log');
    }
};
