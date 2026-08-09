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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            // ==========================================
            // 1. IDENTITAS & BRANDING (Multi-Lang)
            // ==========================================
            $table->jsonb('site_name')->nullable();        // {"id": "Nama ID", "en": "Name EN"}
            $table->jsonb('site_tagline')->nullable();     // {"id": "Slogan ID", "en": "Tagline EN"}
            $table->string('logo_light')->nullable();     // Logo untuk background gelap
            $table->string('logo_dark')->nullable();      // Logo untuk background terang
            $table->string('favicon')->nullable();        // Path Icon Favicon Browser

            // ==========================================
            // 2. KONTAK UTAMA & LOKASI
            // ==========================================
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->jsonb('working_hours')->nullable();   // Multi-lang Jam Operasional
            $table->jsonb('address')->nullable();         // Multi-lang Alamat Fisik
            $table->text('google_maps_embed')->nullable();

            // ==========================================
            // 3. TOP BAR & ANNOUNCEMENT TICKER (Multi-Lang)
            // ==========================================
            $table->boolean('is_topbar_active')->default(true);
            $table->boolean('is_announcement_active')->default(true);
            $table->jsonb('topbar_announcement')->nullable(); // Teks Running Text / Announcement {"id": "...", "en": "..."}
            $table->jsonb('topbar_button_text')->nullable();  // Teks Tombol Topbar {"id": "...", "en": "..."}
            $table->string('topbar_button_url')->nullable();  // Link Tujuan Tombol Topbar

            // ==========================================
            // 4. PENGATURAN FOOTER & NAVIGASI (Multi-Lang)
            // ==========================================
            $table->jsonb('footer_description')->nullable(); // Deskripsi Singkat di Footer
            $table->jsonb('copyright_text')->nullable();     // Teks Hak Cipta Footer
            $table->jsonb('social_links')->nullable();       // Array Media Sosial (jsonb)
            $table->jsonb('footer_navigation')->nullable();   // Navigasi Multi-Kolom Footer (jsonb)

            // ==========================================
            // 5. PENGATURAN SEO (Multi-Lang & Global)
            // ==========================================
            // SEO Text Content (Multi-Lang)
            $table->jsonb('meta_title')->nullable();        // {"id": "...", "en": "..."}
            $table->jsonb('meta_description')->nullable();  // {"id": "...", "en": "..."}
            $table->jsonb('meta_keywords')->nullable();     // {"id": "...", "en": "..."}
            $table->jsonb('og_title')->nullable();          // {"id": "...", "en": "..."}
            $table->jsonb('og_description')->nullable();   // {"id": "...", "en": "..."}

            // SEO Media & Global Technical Settings
            $table->string('og_image')->nullable();        // Default Open Graph Image Share
            $table->string('twitter_card_type')->default('summary_large_image'); // summary / summary_large_image
            $table->boolean('seo_robots_index')->default(true);   // Allow search engine indexing
            $table->boolean('seo_robots_follow')->default(true);  // Allow search engine link following
            $table->string('canonical_url')->nullable();

            // ==========================================
            // 6. ANALYTICS & CUSTOM SCRIPTS
            // ==========================================
            $table->string('google_analytics_id')->nullable();  // G-XXXXXXXXXX
            $table->string('google_tag_manager_id')->nullable(); // GTM-XXXXXXX
            $table->text('custom_head_scripts')->nullable();     // Custom Code di <head>
            $table->text('custom_body_scripts')->nullable();     // Custom Code sebelum </body>

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
