<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portofolios', function (Blueprint $table) {
            // Cek dulu, kalau kolom belum ada baru buat
            if (!Schema::hasColumn('portofolios', 'galeri_screenshot')) {
                $table->json('galeri_screenshot')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('portofolios', function (Blueprint $table) {
            $table->dropColumn('galeri_screenshot');
        });
    }
};
