<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Navigation extends Model
{
    use HasFactory;
    use HasTranslations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'navigations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'label',
        'type',
        'page_id',
        'url',
        'parent_id',
        'order',
        'is_active',
    ];

    /**
     * Atribut yang harus ditranslasi (multi-bahasa).
     * Package Spatie akan otomatis meng-handle konversi JSON di kolom ini.
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'label',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'label' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    protected $appends = [
        'label_text',
    ];

    public function getLabelTextAttribute()
    {
        return $this->getTranslation('label', app()->getLocale());
    }
    /**
     * Relasi ke halaman (Page) jika navigation bertipe internal.
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Relasi ke parent navigation (Menu Induk).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Navigation::class, 'parent_id');
    }

    /**
     * Relasi ke children navigation (Sub-menu).
     */
    public function children(): HasMany
    {
        return $this->hasMany(Navigation::class, 'parent_id')->orderBy('order', 'asc');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Scope untuk mengambil menu yang aktif saja.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk mengambil menu utama saja (tidak punya parent / root).
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope untuk mengurutkan berdasarkan kolom order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors & Helpers
    |--------------------------------------------------------------------------
    */

    public function getLocalizedLabel(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $labels = $this->label;

        // 1. Jika data kosong
        if (empty($labels)) {
            return 'Untitled';
        }

        // 2. Jika Laravel mendeteksi ini sebagai Object, ubah ke Array
        if (is_object($labels)) {
            $labels = json_decode(json_encode($labels), true);
        }

        // 3. Jika berbentuk String
        if (is_string($labels)) {
            $decoded = json_decode($labels, true);

            // Cek Double-Encode (jika setelah di-decode masih berupa string)
            if (is_string($decoded)) {
                $decoded = json_decode($decoded, true);
            }

            // Jika hasil decode adalah array yang valid, gunakan itu
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $labels = $decoded;
            } else {
                // Jika tidak bisa di-decode (bukan JSON), anggap itu teks biasa
                return $labels;
            }
        }

        // 4. Pengaman terakhir, jika masih bukan array, kembalikan 'Untitled'
        if (!is_array($labels)) {
            return 'Untitled';
        }

        // 5. Kembalikan berdasarkan urutan prioritas: Locale -> English -> Pertama -> Untitled
        return $labels[$locale] ?? $labels['en'] ?? (count($labels) > 0 ? reset($labels) : 'Untitled');
    }
}
