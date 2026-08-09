<?php

namespace App\Models;

use App\Enums\ColorTheme;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\AchievementStat
 *
 * @property int $id
 * @property int $value
 * @property string|null $suffix
 * @property ColorTheme $color_theme
 * @property array $label
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $formatted_value
 */
class AchivementStat extends Model
{
    use HasFactory, HasTranslations;

    /**
     * Nama tabel di database.
     * Mengikat ke nama tabel pada migration ('achivement_stats').
     */
    protected $table = 'achivement_stats';

    /**
     * Daftar kolom yang ditangani oleh Spatie Translatable.
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'label',
    ];

    /**
     * Kolom yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value',
        'suffix',
        'color_theme',
        'label',
        'sort_order',
    ];

    /**
     * Type casting untuk kolom non-translatable.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'value' => 'integer',
        'color_theme' => ColorTheme::class,
        'sort_order' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors & Virtual Attributes
    |--------------------------------------------------------------------------
    */

    /**
     * Accessor untuk mendapatkan gabungan angka dan akhiran/suffix.
     * Contoh: "120+"
     */
    public function getFormattedValueAttribute(): string
    {
        return sprintf('%s%s', number_format($this->value), $this->suffix ?? '');
    }

    /*
    |--------------------------------------------------------------------------
    | Local Scopes (Filter & Ordering Query)
    |--------------------------------------------------------------------------
    */

    /**
     * Scope untuk mengurutkan statistik berdasarkan kolom sort_order (urutan naik).
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Scope untuk memfilter statistik berdasarkan tema warna tertentu.
     */
    public function scopeOfTheme(Builder $query, ColorTheme|string $theme): Builder
    {
        $value = $theme instanceof ColorTheme ? $theme->value : $theme;
        return $query->where('color_theme', $value);
    }
}
