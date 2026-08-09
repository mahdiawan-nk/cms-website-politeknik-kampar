<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
// 1. Import Trait dari Spatie
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\SiteSetting
 *
 * Model profesional untuk mengelola pengaturan situs global.
 * Menggunakan caching otomatis dan mendukung multi-bahasa (JSON).
 *
 * @property int $id
 * @property array|null $site_name             --> Translatable
 * @property array|null $site_tagline          --> Translatable
 * @property string|null $logo_light
 * @property string|null $logo_dark
 * @property string|null $favicon
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $whatsapp
 * @property array|null $working_hours         --> Translatable
 * @property array|null $address               --> Translatable
 * @property string|null $google_maps_embed
 * @property bool $is_topbar_active
 * @property bool $is_announcement_active
 * @property array|null $topbar_announcement   --> Translatable
 * @property array|null $topbar_button_text    --> Translatable
 * @property string|null $topbar_button_url
 * @property array|null $footer_description    --> Translatable
 * @property array|null $copyright_text        --> Translatable
 * @property array|null $social_links
 * @property array|null $footer_navigation
 * @property array|null $meta_title            --> Translatable
 * @property array|null $meta_description      --> Translatable
 * @property array|null $meta_keywords         --> Translatable
 * @property array|null $og_title               --> Translatable
 * @property array|null $og_description         --> Translatable
 * @property string|null $og_image
 * @property string $twitter_card_type
 * @property bool $seo_robots_index
 * @property bool $seo_robots_follow
 * @property string|null $canonical_url
 * @property string|null $google_analytics_id
 * @property string|null $google_tag_manager_id
 * @property string|null $custom_head_scripts
 * @property string|null $custom_body_scripts
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read string $logo_light_url
 * @property-read string $logo_dark_url
 * @property-read string $favicon_url
 * @property-read string $og_image_url
 */
class SiteSetting extends Model
{
    use HasFactory;
    // 2. Gunakan Trait HasTranslations
    use HasTranslations;

    /**
     * Cache Key untuk menyimpan setting secara terpusat.
     */
    public const CACHE_KEY = 'site_settings_cache';

    /**
     * Attributes yang dapat diisi secara massal.
     */
    protected $fillable = [
        // Branding
        'site_name',
        'site_tagline',
        'logo_light',
        'logo_dark',
        'favicon',
        // Contact
        'email',
        'phone',
        'whatsapp',
        'working_hours',
        'address',
        'google_maps_embed',
        // Topbar
        'is_topbar_active',
        'is_announcement_active',
        'topbar_announcement',
        'topbar_button_text',
        'topbar_button_url',
        // Footer
        'footer_description',
        'copyright_text',
        'social_links',
        'footer_navigation',
        // SEO
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card_type',
        'seo_robots_index',
        'seo_robots_follow',
        'canonical_url',
        // Scripts
        'google_analytics_id',
        'google_tag_manager_id',
        'custom_head_scripts',
        'custom_body_scripts',
    ];

    /**
     * 3. Definisi Kolom yang Mendukung Multi-Bahasa.
     * Spatie akan menangani serialize/deserialize JSON secara otomatis untuk kolom ini.
     */
    public array $translatable = [
        'site_name',
        'site_tagline',
        'working_hours',
        'address',
        'topbar_announcement',
        'topbar_button_text',
        'footer_description',
        'copyright_text',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
    ];

    /**
     * Casting atribut ke tipe data asli.
     * CATATAN: Kolom terjemahan TIDAK PERLU di-cast ke 'array' lagi,
     * karena HasTranslations trait yang akan menanganinya.
     */
    protected $casts = [
        // Booleans
        'is_topbar_active'       => 'boolean',
        'is_announcement_active' => 'boolean',
        'seo_robots_index'       => 'boolean',
        'seo_robots_follow'      => 'boolean',

        // JSON Complex Fields (Non-Translatable, hanya struktur data)
        'social_links'           => 'array',
        'footer_navigation'      => 'array',
    ];

    // =========================================================================
    // BOOT & CACHE MANAGEMENT (Singleton Pattern)
    // =========================================================================

    /**
     * Logika booted model untuk menangani Cache Flashing.
     */
    protected static function booted(): void
    {
        // Hapus cache setiap kali data disimpan atau dihapus
        static::saved(fn() => Cache::forget(self::CACHE_KEY));
        static::deleted(fn() => Cache::forget(self::CACHE_KEY));
    }

    /**
     * Helper Singleton: Mengambil data setting tunggal (ter-cache selamanya).
     * Jika data tidak ada, mengembalikan instansiasi model kosong agar aplikasi tidak crash.
     */
    public static function getSettings(): static
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return static::first() ?? new static();
        });
    }

    // =========================================================================
    // ACCESSORS (URL ASSETS)
    // =========================================================================

    /**
     * Mengambil URL Logo Light dengan fallback.
     */
    protected function logoLightUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->logo_light
                ? Storage::url($this->logo_light)
                : asset('images/branding/default-logo-light.png') // Pastikan file ini ada
        );
    }

    /**
     * Mengambil URL Logo Dark dengan fallback.
     */
    protected function logoDarkUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->logo_dark
                ? Storage::url($this->logo_dark)
                : asset('images/branding/default-logo-dark.png') // Pastikan file ini ada
        );
    }

    /**
     * Mengambil URL Favicon dengan fallback.
     */
    protected function faviconUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->favicon
                ? Storage::url($this->favicon)
                : asset('favicon.ico') // Fallback ke favicon root
        );
    }

    /**
     * Mengambil URL OG Image (Social Share) dengan fallback.
     */
    protected function ogImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->og_image
                ? Storage::url($this->og_image)
                : asset('images/seo/default-og-image.jpg') // Pastikan file ini ada
        );
    }

    /**
     * Helper untuk mengambil teks sesuai bahasa (default: 'id')
     */
    /**
     * Helper untuk mengambil teks sesuai bahasa (default: locale aplikasi atau 'id')
     */
    public function getTranslation(string $column, ?string $locale = null): ?string
    {
        $locale = $locale ?: app()->getLocale();

        // 1. Ambil nilai mentah langsung dari DB (menghindari konflik $casts Eloquent)
        $value = $this->getRawOriginal($column) ?? $this->getAttribute($column);

        if (is_null($value)) {
            return null;
        }

        // 2. Decode bertahap jika data tersimpan sebagai double-encoded JSON string
        while (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && $decoded !== $value) {
                $value = $decoded;
            } else {
                break;
            }
        }

        // 3. Jika hasil decode berupa Array Multilingual
        if (is_array($value)) {
            $result = $value[$locale] ?? $value['id'] ?? $value['en'] ?? null;
            return is_string($result) ? $result : null;
        }

        // 4. Jika nilai asal adalah String biasa (non-JSON)
        return is_string($value) ? $value : null;
    }
}
