<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
public function up(): void
{
    DB::statement("
        DO $$
        BEGIN
            IF NOT EXISTS (
                SELECT 1
                FROM pg_type
                WHERE typname = 'unidad_calculo_enum'
            ) THEN
                CREATE TYPE unidad_calculo_enum AS ENUM (
                    'salario',
                    'dia',
                    'hora',
                    'porcentaje',
                    'unidad'
                );
            END IF;
        END
        $$;
    ");
}

    public function down(): void
    {
        DB::statement('DROP TYPE IF EXISTS unidad_calculo_enum');
    }
};
