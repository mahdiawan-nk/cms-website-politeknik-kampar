<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $author_id
 * @property array $title
 * @property array $slug
 * @property array|null $excerpt
 * @property array $content
 * @property array|null $meta_title
 * @property array|null $meta_description
 * @property array|null $meta_keywords
 * @property string|null $og_image
 * @property string|null $canonical_url
 * @property bool $is_indexable
 * @property string|null $featured_image
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read string $featured_image_url
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\User|null $author
 */
class Post extends Model
{
    use HasFactory;
    use HasTranslations;

    /**
     * Nama tabel database.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Field yang dapat diisi secara massal (mass-assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
        'canonical_url',
        'is_indexable',
        'featured_image',
        'status',
        'published_at',
    ];

    /**
     * Daftar field yang mendukung multi-bahasa (Spatie Translatable).
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * Type casting untuk atribut model (Laravel 11 Style).
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_indexable' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /* -------------------------------------------------------------------------- */
    /*                                ACCESSORS                                   */
    /* -------------------------------------------------------------------------- */

    /**
     * Accessor untuk mendapatkan URL featured image yang valid.
     * Dipanggil menggunakan `$post->featured_image_url`
     *
     * @return Attribute
     */
    protected function featuredImageUrl(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                $defaultImage = asset('img/logo-plkm.png');

                // 1. Jika field kosong
                if (! $this->featured_image) {
                    return $defaultImage;
                }

                // 2. Jika nilai berupa URL eksternal (misal: dari seeder / CDN)
                if (str_starts_with($this->featured_image, 'http://') || str_starts_with($this->featured_image, 'https://')) {
                    return $this->featured_image;
                }

                // 3. Cek ketersediaan file di disk public storage
                if (Storage::disk('public')->exists($this->featured_image)) {
                    return Storage::disk('public')->url($this->featured_image);
                }

                // 4. Fallback jika file tidak ada di storage
                return $defaultImage;
            }
        );
    }

    /* -------------------------------------------------------------------------- */
    /*                                SCOPES                                      */
    /* -------------------------------------------------------------------------- */

    /**
     * Scope query untuk hanya mengambil postingan yang sudah terbit (published) 
     * dan tanggal publikasinya sudah lewati waktu sekarang.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope query untuk menyaring postingan yang berstatus draft.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope query untuk menyaring postingan berdasarkan kategori.
     *
     * @param Builder $query
     * @param int $categoryId
     * @return Builder
     */
    public function scopeByCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    /* -------------------------------------------------------------------------- */
    /*                             RELATIONSHIPS                                  */
    /* -------------------------------------------------------------------------- */

    /**
     * Relasi ke model Category (Post milik satu Kategori).
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relasi ke model User (Post ditulis oleh satu Penulis).
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
