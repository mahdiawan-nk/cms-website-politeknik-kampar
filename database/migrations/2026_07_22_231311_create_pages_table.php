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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->jsonb('title'); // Multi-bahasa (contoh: {"id": "Beranda", "en": "Home"})
            $table->jsonb('slug'); // URL spesifik per bahasa
            $table->jsonb('content')->nullable(); // JSON struktur blok komponen Filament Builder
            $table->jsonb('seo')->nullable();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
