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
            DB::unprepared('CREATE TRIGGER ins_user_to_log BEFORE DELETE ON `users` FOR EACH ROW BEGIN INSERT INTO log_users_non_aktif (`name`, `email`, `google_id`,`email_verified_at`, `address`, `phone`,  `avatar`, `password`)
                VALUES (old.name,old.email,old.google_id,old.email_verified_at,old.address,old.phone,old.avatar,old.password);
                END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER `ins_user_to_log`');
    }
};
