<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tindak_lanjut', function (Blueprint $table) {
            $table->bigIncrements('tindak_id'); // Sesuai gambar skema: tindak_id (PK)

            // Foreign Key ke tabel pengaduan
            $table->unsignedBigInteger('pengaduan_id');
            $table->foreign('pengaduan_id')->references('pengaduan_id')->on('pengaduan')->onDelete('cascade');

            // Petugas (bisa string nama manual atau FK ke user, sesuaikan kebutuhan)
            // Di sini saya buat string sesuai skema gambar 'petugas'
            $table->string('petugas')->nullable();

            $table->string('aksi'); // Tindakan yang dilakukan
            $table->text('catatan')->nullable(); // Catatan tambahan

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjut');
    }
};
