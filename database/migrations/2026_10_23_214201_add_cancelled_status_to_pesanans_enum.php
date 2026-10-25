
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
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
                'ditolak',
                'cancelled'
            ) NOT NULL DEFAULT 'pending'
        ");
    }

    public function down(): void
    {
        // Sengaja tidak menghapus cancelled agar data
        // pesanan yang dibatalkan tetap aman.
    }
};
