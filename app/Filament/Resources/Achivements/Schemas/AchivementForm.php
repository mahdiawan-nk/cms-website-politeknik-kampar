<?php

namespace App\Filament\Resources\Achivements\Schemas;

use App\Enums\AchievementLevel;
use App\Enums\AchievementType;
use App\Models\Achivement as Achievement;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\{Grid, Group, Section, Tabs};
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\{Get, Set};
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AchivementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)->schema([

                    /*
                    |--------------------------------------------------------------------------
                    | Kolom Kiri: Konten & Multi-Bahasa (Span 2)
                    |--------------------------------------------------------------------------
                    */
                    Group::make()->schema([
                        Section::make('Media Dokumentasi')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Foto Dokumentasi')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('achievements')
                                    ->maxSize(2048)
                                    ->helperText('Format JPG/PNG, Maksimal 2MB.'),
                            ]),
                        Section::make('Konten Multi-Bahasa')
                            ->description('Isi judul, deskripsi, dan metadata prestasi dalam bahasa Indonesia dan Inggris.')
                            ->schema([
                                Tabs::make('Translasi')
                                    ->tabs([
                                        // Tab Bahasa Indonesia
                                        Tabs\Tab::make('Bahasa Indonesia')
                                            ->icon('heroicon-m-language')
                                            ->schema([
                                                TextInput::make('title.id')
                                                    ->label('Judul Prestasi')
                                                    ->placeholder('Contoh: Juara 1 World AI Hackathon')
                                                    ->required()
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                                        if ($operation === 'create') {
                                                            $set('slug', Str::slug($state));
                                                        }
                                                    }),

                                                Grid::make(2)->schema([
                                                    TextInput::make('category.id')
                                                        ->label('Kategori')
                                                        ->placeholder('Contoh: AKADEMIK / OLAHRAGA')
                                                        ->required(),

                                                    TextInput::make('organizer.id')
                                                        ->label('Penyelenggara / Unit')
                                                        ->placeholder('Contoh: Teknik Informatika')
                                                        ->required(),
                                                ]),

                                                Textarea::make('description.id')
                                                    ->label('Deskripsi Singkat')
                                                    ->placeholder('Jelaskan detail prestasi yang diraih...')
                                                    ->rows(4)
                                                    ->required(),
                                            ]),

                                        // Tab Bahasa Inggris
                                        Tabs\Tab::make('Bahasa Inggris')
                                            ->icon('heroicon-m-globe-alt')
                                            ->schema([
                                                TextInput::make('title.en')
                                                    ->label('Title')
                                                    ->placeholder('Example: 1st Winner World AI Hackathon')
                                                    ->required(),

                                                Grid::make(2)->schema([
                                                    TextInput::make('category.en')
                                                        ->label('Category')
                                                        ->placeholder('Example: ACADEMIC / SPORTS')
                                                        ->required(),

                                                    TextInput::make('organizer.en')
                                                        ->label('Organizer / Department')
                                                        ->placeholder('Example: Informatics Engineering')
                                                        ->required(),
                                                ]),

                                                Textarea::make('description.en')
                                                    ->label('Description')
                                                    ->placeholder('Explain the details of the achievement...')
                                                    ->rows(4)
                                                    ->required(),
                                            ]),
                                    ]),
                            ]),
                    ])->columnSpan(2),

                    /*
                    |--------------------------------------------------------------------------
                    | Kolom Kanan: Media & Taksonomi (Span 1)
                    |--------------------------------------------------------------------------
                    */
                    Group::make()->schema([
                        Section::make('Atribut & Status')
                            ->schema([
                                TextInput::make('slug')
                                    ->label('URL Slug')
                                    ->required()
                                    ->unique(Achievement::class, 'slug', ignoreRecord: true)
                                    ->helperText('Otomatis dibuat dari Judul (ID).'),

                                Select::make('type')
                                    ->label('Jenis Prestasi')
                                    ->options(AchievementType::class)
                                    ->default(AchievementType::COMPETITION->value ?? 'kompetisi')
                                    ->required(),

                                Select::make('level')
                                    ->label('Tingkat / Skala')
                                    ->options(AchievementLevel::class)
                                    ->nullable()
                                    ->placeholder('Pilih Tingkat (Opsional)'),

                                TextInput::make('year')
                                    ->label('Tahun')
                                    ->numeric()
                                    ->default((int) date('Y'))
                                    ->required(),

                                Toggle::make('is_featured')
                                    ->label('Unggulan (Featured)')
                                    ->helperText('Tampilkan di halaman utama website.')
                                    ->default(false),
                            ]),
                    ])->columnSpan(1),

                ]),
            ])
            ->columns(1);
    }
}
