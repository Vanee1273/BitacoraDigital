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
        DB::unprepared("
            CREATE TRIGGER insert_users_after_maestros_insert
            AFTER INSERT ON maestros
            FOR EACH ROW
            BEGIN
                INSERT INTO users (email, password, created_at, updated_at)
                VALUES (NEW.Correo, NEW.Password, NOW(), NOW());
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS insert_users_after_maestros_insert");
    }
};