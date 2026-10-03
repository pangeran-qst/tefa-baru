<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE pesanans
            MODIFY status ENUM(
                'pending',
                'diproses',
                'ditugaskan',
                'pengerjaan',
                'review',
                'selesai',
                'ditolak'
            ) DEFAULT 'pending'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE pesanans
            MODIFY status ENUM(
                'pending',
                'in_progress',
                'completed',
                'cancelled'
            ) DEFAULT 'pending'
        ");
    }
};