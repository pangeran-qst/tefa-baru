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
        Schema::create('progress_pesanans', function (Blueprint $table) {

            $table->id('id_progress');

            $table->foreignId('id_pesanan')
                ->constrained('pesanans', 'id_pesanan')
                ->cascadeOnDelete();

            $table->foreignId('id_user')
                ->constrained('users', 'id_user')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('progress')
                ->default(0);

            $table->string('tahap', 100);

            $table->text('catatan')->nullable();

            $table->timestamp('tanggal_progress')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_pesanans');
    }
};