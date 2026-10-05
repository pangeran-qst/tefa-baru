<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portofolios', function (Blueprint $table) {
            if (!Schema::hasColumn('portofolios', 'id_produk')) {
                $table->unsignedBigInteger('id_produk')->after('id_portofolio');
                $table->foreign('id_produk')->references('id_produk')->on('tefas')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('portofolios', function (Blueprint $table) {
            $table->dropForeign(['id_produk']);
            $table->dropColumn('id_produk');
        });
    }
};