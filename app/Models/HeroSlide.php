<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeroSlide extends Model
{
    use HasFactory, HasTranslations;

    /**
     * Nama tabel yang terikat dengan model.
     *
     * @var string
     */
    protected $table = 'hero_slides';

    /**
     * Field yang dapat diisi secara massal (Mass Assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image_path',
        'tagline',
        'title',
        'description',
        'primary_button_text',
        'secondary_button_text',
        'primary_button_url',
        'secondary_button_url',
        'show_tagline',
        'show_title',
        'show_description',
        'show_primary_button',
        'show_secondary_button',
        'sort_order',
        'is_active',
    ];

    /**
     * Kolom yang ditranslasikan (Spatie Translatable).
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'tagline',
        'title',
        'description',
        'primary_button_text',
        'secondary_button_text',
    ];

    /**
     * Type casting atribut ke tipe data PHP native.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tagline' => 'array',
        'title' => 'array',
        'description' => 'array',
        'primary_button_text' => 'array',
        'secondary_button_text' => 'array',
        'show_tagline' => 'boolean',
        'show_title' => 'boolean',
        'show_description' => 'boolean',
        'show_primary_button' => 'boolean',
        'show_secondary_button' => 'boolean',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Local Scopes (Pembersih Query)
    |--------------------------------------------------------------------------
    */

    /**
     * Scope untuk mengambil hanya slide yang aktif.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk mengurutkan slide berdasarkan sort_order terkecil.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors & Helpers (Fitur Tambahan)
    |--------------------------------------------------------------------------
    */

    /**
     * Accessor untuk mendapatkan URL lengkap gambar.
     */
    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }

    /**
     * Helper untuk mengecek apakah Tombol Utama layak ditampilkan.
     */
    public function shouldShowPrimaryButton(): bool
    {
        return $this->show_primary_button
            && !empty($this->primary_button_text)
            && !empty($this->primary_button_url);
    }

    /**
     * Helper untuk mengecek apakah Tombol Kedua layak ditampilkan.
     */
    public function shouldShowSecondaryButton(): bool
    {
        return $this->show_secondary_button
            && !empty($this->secondary_button_text)
            && !empty($this->secondary_button_url);
    }
}
