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
        Schema::create('portofolios', function (Blueprint $table) {
            // Primary key sesuai yang dipakai di controller
            $table->id('id_portofolio'); 
            
            // Kolom Jurusan ('RPL', 'TKJ', 'DKV', 'PSPT', 'GIM', 'ANIMASI')
            $table->string('jurusan'); 
            
            // Detail Portofolio
            $table->string('judul_karya');
            $table->text('deskripsi');
            $table->string('klien')->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('gambar')->nullable();
            $table->string('link_proyek')->nullable();
            
            // Status untuk memfilter karya aktif (dipakai di controller)
            $table->boolean('status_aktif')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolios');
    }
};