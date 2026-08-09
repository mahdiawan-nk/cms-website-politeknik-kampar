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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();

            // Translatable JSON Fields (Konten Utama)
            $table->json('title');
            $table->json('slug');
            $table->json('excerpt')->nullable();
            $table->json('content');

            // Translatable JSON Fields (SEO Multi-Bahasa)
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();

            // Non-Translatable SEO Fields
            $table->string('og_image')->nullable(); // Thumbnail khusus saat share ke FB/Twitter/WA (jika beda dari featured_image)
            $table->string('canonical_url')->nullable(); // Mencegah konten ganda (duplicate content)
            $table->boolean('is_indexable')->default(true); // Kontrol Meta Robots (Index / NoIndex)

            // Non-Translatable Fields
            $table->string('featured_image')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
