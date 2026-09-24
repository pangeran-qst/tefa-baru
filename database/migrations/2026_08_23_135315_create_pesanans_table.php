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
        Schema::create('pesanans', function (Blueprint $table) {

            $table->id('id_pesanan');

            //orang mesan sementara tapi ga perlu login
            $table->foreignId('id_user')
                ->nullable()
                ->constrained('users', 'id_user')
                ->nullOnDelete();


            // Client yang membuat pesanan
            // $table->foreignId('id_user')
            //     ->constrained('users', 'id_user')
            //     ->cascadeOnDelete();

            // Produk / layanan yang dipesan
            $table->foreignId('id_produk')
                ->constrained('tefas', 'id_produk')
                ->cascadeOnDelete();

            // Worker yang mengerjakan pesanan
            $table->foreignId('id_user_worker')
                ->nullable()
                ->constrained('users', 'id_user')
                ->nullOnDelete();

            $table->timestamp('tanggal_pesan')->useCurrent();

            // Data client saat melakukan pemesanan
            $table->string('nama_pemesan');

            $table->string('email_pemesan');

            $table->string('no_hp_pemesan');

            $table->text('catatan_pesanan')->nullable();

            $table->unsignedInteger('total_harga');

            $table->enum('status', [
                'pending',
                'in_progress',
                'completed',
                'cancelled'
            ])->default('pending');

            $table->timestamps();
        });
    }
};
