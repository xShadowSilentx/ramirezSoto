<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('roles_id')->constrained('roles');
            $table->timestamps();
        });
        DB::unprepared('
                        CREATE TRIGGER after_user_insert
                        AFTER INSERT ON users
                        FOR EACH ROW
                        BEGIN
                            DECLARE cnt INT;
                            SELECT COUNT(*) INTO cnt FROM users_roles WHERE roles_id = 1;
                    
                            IF cnt = 0 THEN
                                INSERT INTO users_roles (users_id, roles_id, created_at)
                                VALUES (NEW.id, 1, NOW());
                            ELSE
                                INSERT INTO users_roles (users_id, roles_id, created_at)
                                VALUES (NEW.id, 2, NOW());
                            END IF;
                        END
                    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_user_insert');

        Schema::dropIfExists('users_roles');
    }
};
