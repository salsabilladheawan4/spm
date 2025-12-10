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
        Schema::create('kategori_pengaduan', function (Blueprint $table) {
            $table->bigIncrements('kategori_id');
            $table->string('nama');
            $table->integer('sla_hari')->comment('Estimasi hari pengerjaan');
            $table->string('prioritas')->default('sedang'); // rendah, sedang, tinggi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_pengaduan');
    }
};
