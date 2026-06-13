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
        Schema::create('tipos_pago', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->string('codigo', 30)->unique('tipos_pago_codigo_key');
            $table->text('descripcion')->nullable();
            $table->boolean('estado')->nullable();
            $table->timestamp('created_at')->nullable()->default(DB::raw("now()"));
        });
        DB::statement("alter table \"tipos_pago\" add column \"unidad_calculo\" unidad_calculo_enum not null");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_pago');
    }
};
