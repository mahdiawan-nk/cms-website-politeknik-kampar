<?php

namespace App\Filament\Resources\HomePageContents\Schemas\Blocks;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\{Section, Tabs, Grid};
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\{Get, Set};
use Filament\Forms\Components\Toggle;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Placeholder;
class CoverBlock
{
    /**
     * Mengembalikan array schema khusus untuk Section Cover
     */
    public static function schema(): array
    {
        return [
            // 1. PENGATURAN LAYOUT (Kondisional)
            Section::make('Pengaturan Layout Cover')
                ->description('Pilih tampilan layout untuk cover beranda Anda.')
                ->icon('heroicon-o-swatch')
                ->schema([
                    Select::make('metadata.layout')
                        ->label('Pilihan Layout')
                        ->options([
                            'default'         => 'Default Slider (Standar)',
                            'split_screen'    => 'Split Screen Slider (Terbagi 2 Layar)',
                            'three_dimension' => 'Three Dimension Slider (Efek 3D)',
                            'video_bg'        => 'Full Video Background',
                        ])
                        ->default('default')
                        ->required()
                        ->live() // Wajib Live: memicu re-render form di bawahnya saat opsi diubah
                ]),

            // 2. KONTEN MEDIA (Menyesuaikan dengan pilihan layout di atas)
            Section::make('Media Cover')
                ->description('Masukkan ID atau URL Video YouTube untuk background.')
                ->icon('heroicon-o-video-camera')
                ->visible(fn(Get $get): bool => $get('metadata.layout') === 'video_bg')
                ->schema([
                    TextInput::make('metadata.video_url')
                        ->label('ID / Link Video YouTube')
                        ->prefixIcon('heroicon-o-video-camera')
                        ->placeholder('WND4vDWNujk atau https://youtu.be/WND4vDWNujk')
                        ->helperText('Masukkan ID Video YouTube (contoh: WND4vDWNujk) atau URL lengkap YouTube.')
                        ->required()
                        ->live(onBlur: true), // Memperbarui preview secara otomatis saat input selesai

                    Placeholder::make('video_preview')
                        ->label('Preview Video Background')
                        ->content(function (Get $get): HtmlString {
                            $value = $get('metadata.video_url');

                            if (blank($value)) {
                                return new HtmlString('
                        <div class="text-xs text-gray-400 dark:text-gray-500 italic p-4 border border-dashed border-gray-300 dark:border-gray-700 rounded-lg text-center">
                            Masukkan ID / URL Video di atas untuk melihat preview.
                        </div>
                    ');
                            }

                            // Ekstraksi ID Youtube Otomatis (Mendukung ID polos, link youtube.com, & youtu.be)
                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $value, $matches);
                            $youtubeId = $matches[1] ?? $value;

                            return new HtmlString("
                    <div class='relative w-full max-w-xl aspect-video rounded-xl overflow-hidden shadow-md border border-gray-200 dark:border-gray-700 bg-slate-900 mt-1'>
                        <iframe 
                            class='absolute inset-0 w-full h-full'
                            src='https://www.youtube.com/embed/{$youtubeId}?autoplay=0&rel=0'
                            title='YouTube Video Preview'
                            frameborder='0'
                            allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
                            allowfullscreen>
                        </iframe>
                    </div>
                ");
                        }),
                ]),

            // 3. KONTEN TEKS (Multi-bahasa)
            Section::make('Teks & Tipografi')
                ->description('Masukkan judul dan deskripsi cover dalam dua bahasa.')
                ->icon('heroicon-o-language')
                ->visible(fn(Get $get): bool => $get('metadata.layout') === 'video_bg')
                ->schema([
                    TextInput::make("metadata.tagline")
                        ->label('Tagline (Judul Utama)')
                        ->required()
                        ->maxLength(255),

                    TextInput::make("metadata.title")
                        ->label('Title / Judul Utama')
                        ->maxLength(500),
                    TextInput::make("metadata.title_secondary")
                        ->label('Title 2 / Judul Utama 2')
                        ->maxLength(500),
                    Textarea::make("metadata.description")
                        ->label('Deskripsi')
                        ->rows(3)
                        ->maxLength(500),
                    Grid::make(2)->schema([
                        // ==========================================
                        // PRIMARY BUTTON
                        // ==========================================
                        Toggle::make('metadata.show_button_primary')
                            ->label('Tampilkan Tombol Primary')
                            ->live()
                            ->columnSpanFull(),

                        TextInput::make('metadata.button_text_primary')
                            ->label('Teks Tombol (CTA) Primary')
                            ->placeholder('Contoh: Daftar Sekarang')
                            ->visible(fn(Get $get): bool => (bool) $get('metadata.show_button_primary')),

                        TextInput::make('metadata.button_url_primary')
                            ->label('Link Tujuan Tombol Primary')
                            ->url()
                            ->placeholder('https://...')
                            ->visible(fn(Get $get): bool => (bool) $get('metadata.show_button_primary')),

                        // ==========================================
                        // SECONDARY BUTTON
                        // ==========================================
                        Toggle::make('metadata.show_button_secondary')
                            ->label('Tampilkan Tombol Secondary')
                            ->live()
                            ->columnSpanFull(),

                        TextInput::make('metadata.button_text_secondary')
                            ->label('Teks Tombol (CTA) Secondary')
                            ->placeholder('Contoh: Pelajari Lebih Lanjut')
                            ->visible(fn(Get $get): bool => (bool) $get('metadata.show_button_secondary')),

                        TextInput::make('metadata.button_url_secondary')
                            ->label('Link Tujuan Tombol Secondary')
                            ->url()
                            ->placeholder('https://...')
                            ->visible(fn(Get $get): bool => (bool) $get('metadata.show_button_secondary')),
                    ])
                ])
        ];
    }
}
