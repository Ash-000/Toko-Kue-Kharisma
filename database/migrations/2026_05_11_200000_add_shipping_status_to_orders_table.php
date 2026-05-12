<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(
            "ALTER TABLE `orders` MODIFY `status` ENUM('pending','in_progress','shipping','completed','cancelled','paid','verified') NOT NULL DEFAULT 'pending'"
        );
    }

    public function down(): void
    {
        DB::statement(
            "ALTER TABLE `orders` MODIFY `status` ENUM('pending','verified','in_progress','completed','cancelled','paid') NOT NULL DEFAULT 'pending'"
        );
    }
};
