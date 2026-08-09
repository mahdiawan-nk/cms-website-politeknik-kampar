<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\{Grid, Section, Group,Tabs};
use Filament\Schemas\Schema;

class HeroSlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // --- KOLOM KIRI (KONTEN UTAMA) ---
                Group::make()
                    ->schema([
                        // Section Media & Gambar
                        Section::make('Media')
                            ->description('Upload gambar background untuk hero slide.')
                            ->schema([
                                FileUpload::make('image_path')
                                    ->label('Hero Image')
                                    ->image()
                                    ->directory('hero-slides')
                                    ->visibility('public')
                                    ->disk('public')
                                    ->imageEditor()
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        // Section Multi-Language Konten & CTA Menggunakan Tabs
                        Section::make('Content & Translations')
                            ->description('Atur teks dan tombol berdasarkan bahasa yang dipilih.')
                            ->schema([
                                Tabs::make('Translations')
                                    ->tabs([
                                        // TAB BAHASA INDONESIA
                                        Tab::make('Bahasa Indonesia (ID)')
                                            ->icon('heroicon-m-language')
                                            ->schema([
                                                TextInput::make('tagline.id')
                                                    ->label('Tagline / Sub-heading (ID)')
                                                    ->placeholder('Contoh: Pelopor Teknologi & Industri Berkelanjutan')
                                                    ->maxLength(255),

                                                TextInput::make('title.id')
                                                    ->label('Main Title (ID)')
                                                    ->placeholder('Contoh: Membangun Generasi Unggul...')
                                                    ->required()
                                                    ->maxLength(255),

                                                Textarea::make('description.id')
                                                    ->label('Description (ID)')
                                                    ->placeholder('Tulis deskripsi singkat dalam Bahasa Indonesia...')
                                                    ->rows(3),

                                                Grid::make(2)
                                                    ->schema([
                                                        TextInput::make('primary_button_text.id')
                                                            ->label('Primary Button Text (ID)')
                                                            ->placeholder('Penerimaan Mahasiswa Baru'),

                                                        TextInput::make('secondary_button_text.id')
                                                            ->label('Secondary Button Text (ID)')
                                                            ->placeholder('Jelajahi Program Studi'),
                                                    ]),
                                            ]),

                                        // TAB ENGLISH
                                        Tab::make('English (EN)')
                                            ->icon('heroicon-m-language')
                                            ->schema([
                                                TextInput::make('tagline.en')
                                                    ->label('Tagline / Sub-heading (EN)')
                                                    ->placeholder('Example: Pioneering Technology & Sustainable Industry')
                                                    ->maxLength(255),

                                                TextInput::make('title.en')
                                                    ->label('Main Title (EN)')
                                                    ->placeholder('Example: Building an Excellent Generation...')
                                                    ->required()
                                                    ->maxLength(255),

                                                Textarea::make('description.en')
                                                    ->label('Description (EN)')
                                                    ->placeholder('Write a short description in English...')
                                                    ->rows(3),

                                                Grid::make(2)
                                                    ->schema([
                                                        TextInput::make('primary_button_text.en')
                                                            ->label('Primary Button Text (EN)')
                                                            ->placeholder('New Student Admission'),

                                                        TextInput::make('secondary_button_text.en')
                                                            ->label('Secondary Button Text (EN)')
                                                            ->placeholder('Explore Study Programs'),
                                                    ]),
                                            ]),
                                    ]),
                            ]),

                        // Section URL / Link (Global untuk semua bahasa)
                        Section::make('Button Links')
                            ->description('Tautan/URL tujuan saat tombol diklik (berlaku untuk semua bahasa).')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('primary_button_url')
                                            ->label('Primary Button Link')
                                            ->placeholder('https://...')
                                            ->url(),

                                        TextInput::make('secondary_button_url')
                                            ->label('Secondary Button Link')
                                            ->placeholder('https://...')
                                            ->url(),
                                    ]),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // --- KOLOM KANAN (SETTING & VISIBILITAS) ---
                Group::make()
                    ->schema([
                        // Status & Urutan
                        Section::make('Publishing')
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Active Status')
                                    ->helperText('Aktifkan untuk menampilkan slide di halaman depan.')
                                    ->default(true),

                                TextInput::make('sort_order')
                                    ->label('Sort Order')
                                    ->helperText('Angka lebih kecil tampil lebih awal.')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                            ]),

                        // Toggle Tampilan Elemen (Hide/Show Config)
                        Section::make('Display Visibility')
                            ->description('Atur elemen mana saja yang ingin ditampilkan pada slide ini.')
                            ->schema([
                                Toggle::make('show_tagline')
                                    ->label('Show Tagline')
                                    ->default(true),

                                Toggle::make('show_title')
                                    ->label('Show Title')
                                    ->default(true),

                                Toggle::make('show_description')
                                    ->label('Show Description')
                                    ->default(true),

                                Toggle::make('show_primary_button')
                                    ->label('Show Primary Button')
                                    ->default(true),

                                Toggle::make('show_secondary_button')
                                    ->label('Show Secondary Button')
                                    ->default(true),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
