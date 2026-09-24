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
        Schema::create('tickets', function (Blueprint $table) {

            // Contoh: TCK-RPL-20260823-001
            $table->string('no_ticket')->primary();

            // Satu pesanan hanya memiliki satu ticket
            $table->foreignId('id_pesanan')
                ->unique()
                ->constrained('pesanans', 'id_pesanan')
                ->cascadeOnDelete();

            $table->timestamp('tanggal_buat')->useCurrent();

            $table->timestamps();
        });
    }
};
