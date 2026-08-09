<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Announcement
 *
 * @property int $id
 * @property array $title
 * @property array|null $badge
 * @property array|null $content
 * @property bool $is_important
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @method static Builder|Announcement published()
 * @method static Builder|Announcement important()
 * @method static Builder|Announcement draft()
 * @method static Builder|Announcement archived()
 */
class Announcement extends Model
{
    use HasFactory;
    use HasTranslations;

    /**
     * Nama tabel database.
     *
     * @var string
     */
    protected $table = 'announcements';

    /**
     * Field yang dapat diisi secara massal (mass-assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'badge',
        'content',
        'is_important',
        'published_at',
        'status',
    ];

    /**
     * Daftar field yang mendukung multi-bahasa (Spatie Translatable).
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'title',
        'badge',
        'content',
    ];

    /**
     * Type casting untuk atribut model (Laravel 11 Style).
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_important' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /* -------------------------------------------------------------------------- */
    /*                                SCOPES                                      */
    /* -------------------------------------------------------------------------- */

    /**
     * Scope query untuk hanya mengambil pengumuman yang sudah terbit (published)
     * dan tanggal publikasinya sudah/sedang berlaku.
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
     * Scope query untuk menyaring pengumuman yang ditandai sebagai Penting.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeImportant(Builder $query): Builder
    {
        return $query->where('is_important', true);
    }

    /**
     * Scope query untuk menyaring pengumuman berstatus draft.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope query untuk menyaring pengumuman yang diarsip.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeArchived(Builder $query): Builder
    {
        return $query->where('status', 'archived');
    }
}
