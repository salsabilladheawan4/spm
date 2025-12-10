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
       Schema::create('pengaduan', function (Blueprint $table) {
            $table->bigIncrements('pengaduan_id');
            $table->string('nomor_tiket')->unique(); // Contoh: TIKET-202501-001

            // Relasi ke Warga
            $table->unsignedBigInteger('warga_id');
            $table->foreign('warga_id')->references('warga_id')->on('wargas')->onDelete('cascade');

            // Relasi ke Kategori
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori_pengaduan');

            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('status', ['pending', 'verifikasi', 'proses', 'selesai', 'ditolak'])->default('pending');

            // Lokasi
            $table->string('lokasi_text')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
