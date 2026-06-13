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
        Schema::table('auditoria_log', function (Blueprint $table) {
            $table->foreign(['id_usuario'], 'auditoria_log_id_usuario_fkey')->references(['id'])->on('usuarios')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auditoria_log', function (Blueprint $table) {
            $table->dropForeign('auditoria_log_id_usuario_fkey');
        });
    }
};
