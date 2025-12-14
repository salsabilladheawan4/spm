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
        Schema::create('pelayanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor_tiket')->unique();

            // Relasi ke Warga
            $table->unsignedBigInteger('warga_id');
            $table->foreign('warga_id')->references('warga_id')->on('wargas')->onDelete('cascade');

            // Relasi ke Kategori Pelayanan
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori_pelayanan');

            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('status', ['pending', 'verifikasi', 'proses', 'selesai', 'ditolak'])->default('pending');
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi'])->default('sedang');

            // Lokasi
            $table->string('lokasi_text')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();

            // Lampiran
            $table->string('lampiran')->nullable();

            // Relasi ke petugas
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->foreign('petugas_id')->references('id')->on('users')->onDelete('set null');

            // Tanggal selesai
            $table->timestamp('tanggal_selesai')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayanan');
    }
};
