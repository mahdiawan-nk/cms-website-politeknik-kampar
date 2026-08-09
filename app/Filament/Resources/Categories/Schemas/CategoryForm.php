<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Components\{Section,Grid,Tabs};
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\{Get, Set};
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        // Kiri (2 Kolom): Konten Utama Multi-Bahasa
                        Section::make('Informasi Kategori')
                            ->description('Kelola nama, slug, dan deskripsi kategori dalam beberapa bahasa.')
                            ->icon('heroicon-o-folder')
                            ->columnSpan(2)
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

                        // Kanan (1 Kolom): Pengaturan & Atribut Non-Translatable
                        Section::make('Pengaturan')
                            ->description('Konfigurasi posisi dan atribut kategori.')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->columnSpan(1)
                            ->schema([
                                TextInput::make('sort_order')
                                    ->label('Urutan Tampilan')
                                    ->helperText('Makin kecil angkanya, makin awal posisinya.')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    /**
     * Helper method untuk meng-generate field translatable per kode bahasa ($locale)
     */
    private static function getTranslatableFields(string $locale): array
    {
        return [
            // 1. Nama Kategori
            TextInput::make("name.{$locale}")
                ->label('Nama Kategori')
                ->placeholder($locale === 'id' ? 'Contoh: Berita Kampus' : 'Example: Campus News')
                ->required($locale === 'id') // Diwajibkan minimal untuk ID
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(function (Get $get, Set $set, ?string $state) use ($locale) {
                    // Auto-generate slug jika kolom slug di bahasa terkait masih kosong
                    if (! $get("slug.{$locale}")) {
                        $set("slug.{$locale}", Str::slug($state));
                    }
                }),

            // 2. Slug URL
            TextInput::make("slug.{$locale}")
                ->label('Slug / URL')
                ->placeholder($locale === 'id' ? 'berita-kampus' : 'campus-news')
                ->required($locale === 'id')
                ->maxLength(255)
                ->helperText('Digunakan untuk URL halaman. Hanya huruf kecil, angka, dan dash (-)'),

            // 3. Deskripsi
            Textarea::make("description.{$locale}")
                ->label('Deskripsi Singkat')
                ->placeholder('Tuliskan rangkuman isi dari kategori ini...')
                ->rows(3)
                ->maxLength(500),
        ];
    }
}