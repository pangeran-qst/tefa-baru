<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tefas', function (Blueprint $table) {
            $table->id('id_produk');
            $table->enum('jurusan', ['RPL', 'TKJ', 'GIM', 'DKV', 'PSPT', 'ANIMASI']);
            $table->string('nama_produk'); // Nama Produk / Jasa
            $table->text('deskripsi');
            $table->integer('harga')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tefas');
    }
};