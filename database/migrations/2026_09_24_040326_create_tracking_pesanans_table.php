<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracking_pesanans', function (Blueprint $table) {
            $table->id('id_tracking');

            $table->foreignId('id_pesanan')
                ->constrained('pesanans', 'id_pesanan')
                ->cascadeOnDelete();

            $table->timestamp('tanggal_tracking')->useCurrent();

            $table->enum('status', [
                'pending',
                'in_progress',
                'completed',
                'cancelled'
            ]);

            $table->text('keterangan')->nullable();

            $table->string('lokasi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracking_pesanans');
    }
};
