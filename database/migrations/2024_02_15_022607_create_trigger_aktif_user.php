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
            DB::unprepared('CREATE TRIGGER ins_log_to_user BEFORE DELETE ON `log_users_non_aktif` FOR EACH ROW BEGIN INSERT INTO users (`name`, `email`, `google_id`,`email_verified_at`, `address`, `phone`,  `avatar`, `password`)
                VALUES (old.name,old.email,old.google_id,old.email_verified_at,old.address,old.phone,old.avatar,old.password);

                SET @last_insert_id = LAST_INSERT_ID();
                INSERT INTO model_has_roles (role_id, model_type, model_id) 
                VALUES (2, "App\Models\User", @last_insert_id);
                END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER `ins_log_to_user`');
    }
};
