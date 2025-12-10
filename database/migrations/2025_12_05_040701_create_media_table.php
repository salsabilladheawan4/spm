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
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('media_id');
            $table->string('ref_table'); // nama tabel, misal: 'pengaduan'
            $table->unsignedBigInteger('ref_id'); // ID dari tabel tsb (pengaduan_id)
            $table->string('file_url'); // Path file
            $table->string('caption')->nullable();
            $table->string('mime_type')->nullable(); // image/jpeg, application/pdf
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Index biar query cepat
            $table->index(['ref_table', 'ref_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
