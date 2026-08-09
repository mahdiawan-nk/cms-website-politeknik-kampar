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
        Schema::create('achivement_stats', function (Blueprint $table) {
            $table->id();
            $table->integer('value'); // Contoh: 120
            $table->string('suffix', 10)->nullable(); // Contoh: '+'
            $table->string('color_theme')->default('emerald');

            // Kolom Multi-Bahasa Menggunakan JSONB
            $table->jsonb('label'); // Contoh: {"id": "Juara Internasional", "en": "International Champions"}

            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achivement_stats');
    }
};
