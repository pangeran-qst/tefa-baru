<?php

use App\Models\Pesanan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            // Role: admin_tefa, admin_jurusan, worker (siswa), client
            $table->enum('role', ['admin_tefa', 'admin_jurusan', 'worker', 'client'])->default('client');
            // Jurusan khusus admin_jurusan dan worker
            $table->enum('jurusan', ['RPL', 'TKJ', 'GIM', 'DKV', 'PSPT', 'ANIMASI'])->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }

    public function pesananSebagaiWorker()
    {
        return $this->hasMany(
            Pesanan::class,
            'id_user_worker',
            'id_user'
        );
    }
};