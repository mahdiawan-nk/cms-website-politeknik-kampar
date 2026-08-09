<?php

namespace App\Models;

use App\Enums\AchievementLevel;
use App\Enums\AchievementType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Achievement
 *
 * @property int $id
 * @property string $slug
 * @property string|null $image
 * @property int $year
 * @property AchievementType $type
 * @property AchievementLevel|null $level
 * @property array $title
 * @property array $category
 * @property array $description
 * @property array $organizer
 * @property bool $is_featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Achivement extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'achivements';

    /**
     * Datar kolom yang menggunakan Spatie Translatable.
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'title',
        'category',
        'description',
        'organizer',
    ];

    /**
     * Kolom yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'image',
        'year',
        'type',
        'level',
        'title',
        'category',
        'description',
        'organizer',
        'is_featured',
    ];

    /**
     * Type casting untuk kolom non-translatable.
     * Note: Kolom yang ada di $translatable tidak perlu dicast ke 'array' 
     * karena sudah ditangani secara otomatis oleh paket Spatie.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'year' => 'integer',
        'type' => AchievementType::class,
        'level' => AchievementLevel::class,
        'is_featured' => 'boolean',
    ];

    /**
     * Menggunakan slug sebagai key untuk Route Model Binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors & Media Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Mendapatkan URL gambar publik atau fallback placeholder.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }

        return asset('img/logo-plkm.png'); // Ganti dengan path placeholder yang sesuai
    }

    /*
    |--------------------------------------------------------------------------
    | Local Scopes (Filter Query)
    |--------------------------------------------------------------------------
    */

    /**
     * Filter hanya prestasi unggulan (featured).
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Filter berdasarkan jenis prestasi (type).
     */
    public function scopeOfType(Builder $query, AchievementType|string $type): Builder
    {
        $value = $type instanceof AchievementType ? $type->value : $type;
        return $query->where('type', $value);
    }

    /**
     * Filter berdasarkan tingkat / skala (level).
     */
    public function scopeOfLevel(Builder $query, AchievementLevel|string $level): Builder
    {
        $value = $level instanceof AchievementLevel ? $level->value : $level;
        return $query->where('level', $value);
    }

    /**
     * Filter berdasarkan tahun.
     */
    public function scopeOfYear(Builder $query, int $year): Builder
    {
        return $query->where('year', $year);
    }
}
