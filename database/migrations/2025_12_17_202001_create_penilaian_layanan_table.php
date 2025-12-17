<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian_layanan', function (Blueprint $table) {
            $table->id('penilaian_id'); // PK
            $table->unsignedBigInteger('pengaduan_id'); // FK
            $table->tinyInteger('rating'); // 1–5
            $table->text('komentar')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('pengaduan_id')
                  ->references('pengaduan_id')
                  ->on('pengaduan')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian_layanan');
    }
};
