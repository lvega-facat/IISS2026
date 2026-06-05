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
Schema::create('sesiones', function (Blueprint $table) {
    $table->id();

    $table->integer('id_usuario');
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->text('payload')->nullable();
    $table->integer('last_activity')->nullable();
    $table->timestamp('fecha_inicio')->nullable()->useCurrent();
    $table->timestamp('fecha_fin')->nullable();
    $table->boolean('estado')->default(true);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesiones');
    }
};
