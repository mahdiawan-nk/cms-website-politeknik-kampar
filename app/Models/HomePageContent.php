<?php

namespace App\Models;

use App\Enums\SectionType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\HomePageContent
 *
 * @property int $id
 * @property SectionType $section_type
 * @property array $header
 * @property array|null $metadata
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * Accessor Properties (Virtual):
 * @property-read string|null $title
 * @property-read string|null $subtitle
 * @property-read string|null $description
 * @property-read string|null $media_url
 * @property-read string|null $button_text
 * @property-read string|null $button_url
 */
class HomePageContent extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'home_page_contents';

    protected $fillable = [
        'section_type',
        'header',
        'metadata',
        'sort_order',
        'is_active',
    ];

    /**
     * Kolom yang di-handle oleh Spatie Translatable
     */
    public array $translatable = ['header'];

    /**
     * Casting tipe data otomatis oleh Eloquent
     */
    protected $casts = [
        'section_type' => SectionType::class,
        'header'       => 'array',
        'metadata'     => 'array',
        'sort_order'   => 'integer',
        'is_active'    => 'boolean',
    ];

    /* =========================================================================
     * VIRTUAL ATTRIBUTE ACCESSORS
     * Memudahkan akses field di dalam $item->header tanpa $item->header['title']
     * ========================================================================= */

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->header['title'] ?? null
        );
    }

    protected function subtitle(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->header['subtitle'] ?? null
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->header['description'] ?? null
        );
    }

    protected function mediaUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->header['media_url'] ?? null
        );
    }

    protected function buttonText(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->header['button_text'] ?? null
        );
    }

    protected function buttonUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->header['button_url'] ?? null
        );
    }

    /* =========================================================================
     * METADATA HELPER METHODS
     * ========================================================================= */

    /**
     * Mengambil nilai atribut dari kolom JSON metadata secara aman dengan dot-notation.
     * Contoh: $item->getMeta('youtube_id') atau $item->getMeta('config.layout')
     */
    public function getMeta(string $key, mixed $default = null): mixed
    {
        return data_get($this->metadata, $key, $default);
    }

    /* =========================================================================
     * LOCAL QUERY SCOPES
     * ========================================================================= */

    /**
     * Scope filter hanya status aktif
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pengurutan berdasarkan sort_order
     */
    public function scopeOrdered(Builder $query, string $direction = 'asc'): Builder
    {
        return $query->orderBy('sort_order', $direction);
    }

    /**
     * Scope filter berdasarkan section_type
     */
    public function scopeOfSection(Builder $query, SectionType|string $section): Builder
    {
        $value = $section instanceof SectionType ? $section->value : $section;
        return $query->where('section_type', $value);
    }
}
