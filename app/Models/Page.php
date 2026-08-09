<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property array $title
 * @property array $slug
 * @property array|null $content
 * @property array|null $seo
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @method static Builder|Page published()
 */
class Page extends Model
{
    use HasFactory;
    use HasTranslations;

    /**
     * Nama tabel di database (opsional, tapi baik untuk kejelasan).
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * Atribut yang mengizinkan mass-assignment.
     * Menggunakan $fillable lebih aman (whitelist) daripada $guarded (blacklist).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'seo',
        'is_published',
    ];

    /**
     * Atribut yang harus ditranslasi (multi-bahasa).
     * Package Spatie akan otomatis meng-handle konversi JSON di kolom ini.
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'title',
        'slug',
        'seo', // SEO biasanya ditranslasi (meta title & desc per bahasa)
    ];

    /**
     * Mendefinisikan tipe data asli (Casting) saat diambil dari database.
     * Catatan: Kolom di $translatable TIDAK PERLU dimasukkan ke sini.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'content' => 'array', // Wajib untuk Filament Builder (struktur blok)
            'is_published' => 'boolean',
        ];
    }

    /**
     * -------------------------------------------------------------------------
     * QUERY SCOPES
     * -------------------------------------------------------------------------
     */

    /**
     * Scope untuk hanya mengambil halaman yang sudah di-publish.
     * Cara pakai: Page::published()->get();
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
}
