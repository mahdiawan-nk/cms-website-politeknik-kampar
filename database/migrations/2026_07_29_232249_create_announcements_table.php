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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            // Kolom Multi-Bahasa (JSON)
            $table->jsonb('title');                  // Judul Pengumuman
            $table->jsonb('badge')->nullable();      // Label/Kategori (misal: Akademik, PMB)
            $table->jsonb('content')->nullable();    // Isi detail pengumuman (opsional)

            // Kolom Atribut
            $table->boolean('is_important')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('published');

            $table->timestamps();

            // Indexing untuk performa
            $table->index(['status', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
