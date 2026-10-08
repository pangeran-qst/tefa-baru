<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->integer('harga_final')
                ->nullable()
                ->after('total_harga');

            $table->enum('status_pembayaran', [
                'belum_bayar',
                'dp',
                'lunas',
            ])
                ->default('belum_bayar')
                ->after('harga_final');

            $table->integer('nominal_dibayar')
                ->default(0)
                ->after('status_pembayaran');

            $table->string('metode_pembayaran')
                ->nullable()
                ->after('nominal_dibayar');

            $table->date('tanggal_pembayaran')
                ->nullable()
                ->after('metode_pembayaran');

            $table->text('catatan_pembayaran')
                ->nullable()
                ->after('tanggal_pembayaran');
        });
    }

    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn([
                'harga_final',
                'status_pembayaran',
                'nominal_dibayar',
                'metode_pembayaran',
                'tanggal_pembayaran',
                'catatan_pembayaran',
            ]);
        });
    }
};