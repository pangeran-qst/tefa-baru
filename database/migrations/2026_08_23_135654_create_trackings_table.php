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
        Schema::create('trackings', function (Blueprint $table) {

            $table->id('id_tracking');

            // Ticket yang sedang dilacak
            $table->string('no_ticket');

            $table->foreign('no_ticket')
                ->references('no_ticket')
                ->on('tickets')
                ->cascadeOnDelete();

            // User yang melakukan update tracking
            $table->foreignId('id_user_petugas')
                ->constrained('users', 'id_user')
                ->cascadeOnDelete();

            $table->timestamp('tanggal_waktu')->useCurrent();

            $table->string('status');

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }
};
