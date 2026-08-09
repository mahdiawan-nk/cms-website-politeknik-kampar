<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property array $title
 * @property array $location
 * @property array|null $content
 * @property Carbon $event_date
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string $time_zone
 * @property string|null $featured_image
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string|null $featured_image_url
 * @property-read string $formatted_time
 * 
 * @method static Builder|Event published()
 * @method static Builder|Event upcoming()
 * @method static Builder|Event past()
 * @method static Builder|Event draft()
 * @method static Builder|Event archived()
 */
class Event extends Model
{
    use HasFactory;
    use HasTranslations;

    /**
     * Nama tabel database.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * Field yang dapat diisi secara massal (mass-assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'location',
        'content',
        'event_date',
        'start_time',
        'end_time',
        'time_zone',
        'featured_image',
        'status',
    ];

    /**
     * Daftar field yang mendukung multi-bahasa (Spatie Translatable).
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'title',
        'location',
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
            'event_date' => 'date',
        ];
    }

    /* -------------------------------------------------------------------------- */
    /*                                ACCESSORS                                   */
    /* -------------------------------------------------------------------------- */

    /**
     * Accessor untuk mendapatkan URL lengkap dari gambar utama (featured_image).
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

    /**
     * Accessor untuk memformat rentang waktu acara (Contoh: "08:30 - 16:00 WIB").
     */
    protected function formattedTime(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                if (! $this->start_time) {
                    return '-';
                }

                $start = Carbon::parse($this->start_time)->format('H:i');
                $end = $this->end_time ? Carbon::parse($this->end_time)->format('H:i') : null;

                return $end
                    ? "{$start} - {$end} {$this->time_zone}"
                    : "{$start} {$this->time_zone}";
            }
        );
    }

    /* -------------------------------------------------------------------------- */
    /*                                SCOPES                                      */
    /* -------------------------------------------------------------------------- */

    /**
     * Scope query untuk hanya mengambil agenda yang berstatus publikasi (published).
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope query untuk menyaring agenda mendatang (termasuk hari ini) yang sudah terbit.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->published()
            ->where('event_date', '>=', now()->startOfDay())
            ->orderBy('event_date', 'asc');
    }

    /**
     * Scope query untuk menyaring agenda yang sudah berlalu.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePast(Builder $query): Builder
    {
        return $query->published()
            ->where('event_date', '<', now()->startOfDay())
            ->orderBy('event_date', 'desc');
    }

    /**
     * Scope query untuk menyaring agenda berstatus draft.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope query untuk menyaring agenda yang diarsip.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeArchived(Builder $query): Builder
    {
        return $query->where('status', 'archived');
    }
}
