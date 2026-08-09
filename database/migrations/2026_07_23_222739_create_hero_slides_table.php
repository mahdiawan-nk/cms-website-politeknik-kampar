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
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');

            // --- Content JSONB (Multi-Language) ---
            $table->jsonb('tagline')->nullable();
            $table->jsonb('title');
            $table->jsonb('description')->nullable();
            $table->jsonb('primary_button_text')->nullable();
            $table->jsonb('secondary_button_text')->nullable();

            // --- URLs ---
            $table->string('primary_button_url')->nullable();
            $table->string('secondary_button_url')->nullable();

            // --- Display Configs (Hide / Show Toggle) ---
            $table->boolean('show_tagline')->default(true);
            $table->boolean('show_title')->default(true);
            $table->boolean('show_description')->default(true);
            $table->boolean('show_primary_button')->default(true);
            $table->boolean('show_secondary_button')->default(true);

            // --- Status & Ordering ---
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
