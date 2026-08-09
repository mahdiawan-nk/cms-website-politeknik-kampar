<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property array $name
 * @property array $slug
 * @property array|null $description
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Category extends Model
{
    use HasFactory;
    use HasTranslations;

    /**
     * Nama tabel database.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * Field yang dapat diisi secara massal (mass-assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sort_order',
    ];

    /**
     * Daftar field yang mendukung multi-bahasa (translatable).
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Type casting untuk atribut model (Laravel 11 Style).
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    /* -------------------------------------------------------------------------- */
    /*                                SCOPES                                      */
    /* -------------------------------------------------------------------------- */

    /**
     * Scope query untuk mengurutkan kategori berdasarkan 'sort_order'.
     *
     * @param Builder $query
     * @param string $direction
     * @return Builder
     */
    public function scopeOrdered(Builder $query, string $direction = 'asc'): Builder
    {
        return $query->orderBy('sort_order', $direction);
    }

    /* -------------------------------------------------------------------------- */
    /*                             RELATIONSHIPS                                  */
    /* -------------------------------------------------------------------------- */

    /**
     * Relasi ke postingan (satu kategori memiliki banyak postingan).
     *
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}