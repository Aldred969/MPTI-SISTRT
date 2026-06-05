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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->enum('kategori', [
                'surat_pengantar',
                'keamanan',
                'kebersihan',
                'infrastruktur',
                'lainnya'
            ]);

            $table->string('judul');

            $table->text('isi_laporan');

            $table->enum('status', [
                'dikirim',
                'diproses',
                'selesai'
            ])->default('dikirim');

            $table->text('tanggapan_admin')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
