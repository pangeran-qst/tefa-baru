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
            $table->id('id_portofolio');
            
            // Foreign Key relasi ke tabel tefas
            $table->unsignedBigInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('tefas')->onDelete('cascade');

            $table->string('jurusan'); 
            $table->string('judul_karya');
            $table->text('deskripsi');
            $table->string('klien')->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('gambar')->nullable(); // Thumbnail Utama
            $table->string('link_proyek')->nullable(); // Link Live App / Demo Video / Drive
            
            // Opsional untuk screenshot tambahan (Galeri)
            $table->json('galeri_screenshot')->nullable(); 

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