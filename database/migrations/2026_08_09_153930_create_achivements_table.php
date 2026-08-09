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
        Schema::create('achivements', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->year('year');
            // Kolom Jenis/Tipe Prestasi
            $table->string('type')->default('kompetisi');
            // Nilai: 'kompetisi', 'hibah_penelitian', 'paten_hki', 'publikasi', 'penghargaan'

            // Kolom Skala/Tingkat
            $table->enum('level', ['internasional', 'nasional', 'regional', 'lokal'])->nullable();

            // Kolom Multi-Bahasa Menggunakan JSONB
            $table->jsonb('title');       // Contoh: {"id": "Juara 1 World AI Hackathon", "en": "1st Winner World AI Hackathon"}
            $table->jsonb('category');    // Contoh: {"id": "AKADEMIK", "en": "ACADEMIC"}
            $table->jsonb('description'); // Contoh: {"id": "Tim Robotics berhasil...", "en": "Robotics team won..."}
            $table->jsonb('organizer');   // Contoh: {"id": "Teknik Informatika", "en": "Informatics Engineering"}

            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achivements');
    }
};
