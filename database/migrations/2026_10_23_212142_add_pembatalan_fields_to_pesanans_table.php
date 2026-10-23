
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->text('alasan_pembatalan')->nullable();
            $table->timestamp('tanggal_dibatalkan')->nullable();
            $table->unsignedBigInteger('dibatalkan_oleh')->nullable();
            $table->string('status_sebelum_pembatalan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn([
                'alasan_pembatalan',
                'tanggal_dibatalkan',
                'dibatalkan_oleh',
                'status_sebelum_pembatalan',
            ]);
        });
    }
};
