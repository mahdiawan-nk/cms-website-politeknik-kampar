<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\{Section, Grid, Tabs, Group};
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\{Get, Set};
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        // ==========================================
                        // KOLOM KIRI (2 SPAN) - KONTEN MULTI-BAHASA
                        // ==========================================
                        Group::make()
                            ->columnSpan(2)
                            ->schema([
                                Section::make('Konten Artikel')
                                    ->description('Kelola teks artikel dan metadata SEO dalam beberapa bahasa.')
                                    ->icon('heroicon-o-document-text')
                                    ->schema([
                                        Tabs::make('Bahasa')
                                            ->tabs([
                                                // Tab Bahasa Indonesia
                                                Tabs\Tab::make('Indonesia (ID)')
                                                    ->icon('heroicon-m-language')
                                                    ->schema(self::getTranslatableFields('id')),

                                                // Tab Bahasa Inggris
                                                Tabs\Tab::make('English (EN)')
                                                    ->icon('heroicon-m-language')
                                                    ->schema(self::getTranslatableFields('en')),
                                            ])
                                            ->activeTab(1),
                                    ]),
                            ]),

                        // ==========================================
                        // KOLOM KANAN (1 SPAN) - SIDEBAR PENGATURAN
                        // ==========================================
                        Group::make()
                            ->columnSpan(1)
                            ->schema([
                                // 1. Status & Publikasi
                                Section::make('Publikasi')
                                    ->icon('heroicon-o-paper-airplane')
                                    ->schema([
                                        Select::make('status')
                                            ->label('Status Artikel')
                                            ->options([
                                                'draft' => 'Draft',
                                                'published' => 'Dipublikasikan',
                                                'archived' => 'Diarsipkan',
                                            ])
                                            ->default('draft')
                                            ->required()
                                            ->native(false),

                                        DateTimePicker::make('published_at')
                                            ->label('Waktu Publikasi')
                                            ->default(now())
                                            ->required(),

                                        Select::make('category_id')
                                            ->label('Kategori')
                                            ->relationship('category', 'name')
                                            ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslation('name', app()->getLocale()))
                                            ->searchable()
                                            ->preload()
                                            ->nullable(),

                                        Select::make('author_id')
                                            ->label('Penulis / Author')
                                            ->relationship('author', 'name')
                                            ->default(fn() => auth()->id())
                                            ->searchable()
                                            ->preload()
                                            ->required(),
                                    ]),

                                // 2. Gambar Sampul (Featured Image)
                                Section::make('Gambar Utama')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        FileUpload::make('featured_image')
                                            ->label('Featured Image')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('posts/featured')
                                            ->disk('public')
                                            ->visibility('public')
                                            ->columnSpanFull(),
                                    ]),

                                // 3. Pengaturan SEO & Sosmed Global
                                Section::make('Pengaturan SEO Global')
                                    ->icon('heroicon-o-globe-alt')
                                    ->collapsible()
                                    ->collapsed()
                                    ->schema([
                                        FileUpload::make('og_image')
                                            ->label('Open Graph Image')
                                            ->helperText('Gambar khusus thumbnail saat dibagikan ke WA/FB/Twitter.')
                                            ->image()
                                            ->directory('posts/og')
                                            ->visibility('public')
                                            ->disk('public'),

                                        TextInput::make('canonical_url')
                                            ->label('Canonical URL')
                                            ->placeholder('https://domain.com/artikel-asli')
                                            ->url(),

                                        Toggle::make('is_indexable')
                                            ->label('Izinkan Index Google')
                                            ->helperText('Nonaktifkan jika ingin memberi instruksi Meta NoIndex.')
                                            ->default(true),
                                    ]),
                            ]),
                    ]),
            ])
            ->columns(1);
    }

    /**
     * Helper method untuk meng-generate field translatable per kode bahasa ($locale)
     */
    private static function getTranslatableFields(string $locale): array
    {
        return [
            // 1. Judul Artikel
            // 1. FIELD JUDUL ARTIKEL (Bersih & Independen)
            TextInput::make("title.{$locale}")
                ->label('Judul Artikel')
                ->placeholder($locale === 'id' ? 'Contoh: Inovasi Teknologi Kampus' : 'Example: Campus Tech Innovation')
                ->required($locale === 'id')
                ->maxLength(255),

            // 2. FIELD SLUG / URL (Dikontrol Manual + Fitur On-Demand Generate)
            TextInput::make("slug.{$locale}")
                ->label('Slug / URL Halaman')
                ->placeholder($locale === 'id' ? 'inovasi-teknologi-2026' : 'campus-innovation-2026')
                ->required($locale === 'id')
                ->maxLength(255)
                ->alphaDash() // Memastikan hanya berisi huruf, angka, dan tanda hubung (-)
                ->prefix(config('app.url') . '/posts/') // Menampilkan preview URL agar user paham
                ->helperText('Alamat tautan artikel. Anda bisa menulis slug khusus (SEO friendly) atau klik tombol tongkat sihir di kanan untuk generate dari judul.')
                ->suffixAction(
                    Action::make('generateSlug')
                        ->icon('heroicon-m-sparkles')
                        ->tooltip('Buat slug otomatis dari Judul')
                        ->action(function (Set $set, Get $get) use ($locale) {
                            $title = $get("title.{$locale}");

                            if (! empty($title)) {
                                // Generate 4 digit angka acak (misal: 4829)
                                $uniqueNumber = now()->format('His');

                                // Buat slug: "judul-artikel-4829"
                                $generatedSlug = $uniqueNumber . '-' . Str::slug($title);

                                $set("slug.{$locale}", $generatedSlug);
                            }
                        })
                ),

            // 3. Ringkasan / Excerpt
            Textarea::make("excerpt.{$locale}")
                ->label('Ringkasan / Excerpt')
                ->placeholder('Tuliskan ringkasan singkat 2-3 kalimat untuk preview...')
                ->rows(3)
                ->maxLength(500),

            // 4. Isi Artikel (Rich Text Editor)
            // RichEditor::make("content.{$locale}")
            //     ->label('Isi / Konten Artikel')
            //     ->required($locale === 'id')
            //     ->fileAttachmentsDirectory('posts/attachments')
            //     ->fileAttachmentsDisk('public')
            //     ->fileAttachmentsVisibility('public')
            //     ->columnSpanFull(),
            TinyEditor::make("content.{$locale}")
                ->label('Isi / Konten Artikel')
                ->fileAttachmentsDisk('public')
                ->fileAttachmentsVisibility('public')
                ->fileAttachmentsDirectory('posts/attachments')
                ->profile('full')
                ->direction('ltr')// Set RTL or use ->direction('auto|rtl|ltr')
                ->columnSpan('full')
                ->required(),

            // 5. Section SEO khusus per Bahasa
            Section::make('Metadata SEO (' . strtoupper($locale) . ')')
                ->description('Pengaturan meta tag untuk mesin pencari Google.')
                ->icon('heroicon-o-magnifying-glass')
                ->collapsible()
                ->collapsed()
                ->schema([
                    TextInput::make("meta_title.{$locale}")
                        ->label('Meta Title')
                        ->placeholder('Judul khusus Google (maks 60 karakter)')
                        ->maxLength(60),

                    Textarea::make("meta_description.{$locale}")
                        ->label('Meta Description')
                        ->placeholder('Deskripsi ringkas pencarian Google (maks 160 karakter)')
                        ->rows(3)
                        ->maxLength(160),

                    TextInput::make("meta_keywords.{$locale}")
                        ->label('Meta Keywords')
                        ->placeholder('Contoh: kampus, berita, inovasi (pisahkan dengan koma)'),
                ]),
        ];
    }
}
