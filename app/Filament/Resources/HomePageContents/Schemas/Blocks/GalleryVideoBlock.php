<?php

namespace App\Filament\Resources\HomePageContents\Schemas\Blocks;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use Filament\Schemas\Components\Utilities\{Get, Set};

class GalleryVideoBlock
{
    public static function schema(): array
    {
        return [
            Section::make('Galeri Video YouTube')
                ->description('Kelola daftar video YouTube kegiatan, profil kampus, dan dokumentasi acara.')
                ->icon('heroicon-o-video-camera')
                ->schema([
                    Repeater::make('metadata.videos')
                        ->label('Daftar Video')
                        ->grid(4)
                        ->schema([
                            // 1. Judul Video
                            TextInput::make('title')
                                ->label('Judul Video')
                                ->placeholder('Contoh: Profile Kampus & Tour Fasilitas Digital')
                                ->required()
                                ->columnSpanFull(),

                            // 2. Kategori Video
                            TextInput::make('category')
                                ->label('Kategori Video')
                                ->placeholder('Contoh: Profil Kampus / Dokumentasi')
                                ->required()
                                ->columnSpanFull(),

                            // 3. Link Video YouTube
                            TextInput::make('youtube_url')
                                ->label('URL / Link YouTube')
                                ->placeholder('https://www.youtube.com/watch?v=...')
                                ->url()
                                ->required()
                                ->live(onBlur: true)
                                ->columnSpanFull(),
                            Placeholder::make('video_preview')
                                ->label('Preview Video')
                                ->content(function (Get $get): HtmlString {
                                    $url = $get('youtube_url');

                                    if (empty($url)) {
                                        return new HtmlString(
                                            '<div class="flex items-center justify-center p-4 text-xs italic border border-dashed rounded-lg text-gray-400 border-gray-300 dark:border-gray-700">' .
                                                'Masukkan URL YouTube di atas untuk melihat preview.' .
                                                '</div>'
                                        );
                                    }

                                    // Extract ID YouTube menggunakan Regular Expression
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
                                    $videoId = $matches[1] ?? null;

                                    if (! $videoId) {
                                        return new HtmlString(
                                            '<div class="flex items-center justify-center p-4 text-xs border rounded-lg text-danger-600 bg-danger-50 dark:bg-danger-950/30 border-danger-200 dark:border-danger-800">' .
                                                '⚠️ Format URL YouTube tidak valid.' .
                                                '</div>'
                                        );
                                    }

                                    return new HtmlString("
                                        <div class=\"relative w-full overflow-hidden bg-black shadow-md aspect-video rounded-xl\">
                                            <iframe
                                                class=\"absolute top-0 left-0 w-full h-full\"
                                                src=\"https://www.youtube.com/embed/{$videoId}\"
                                                title=\"YouTube video player\"
                                                frameborder=\"0\"
                                                allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    ");
                                })
                                ->columnSpanFull(),
                        ])
                        ->minItems(1)
                        ->collapsible()
                        ->itemLabel(function (array $state): ?string {
                            if (empty($state['title'])) {
                                return 'Video Baru';
                            }
                            $category = ! empty($state['category']) ? ' [' . $state['category'] . ']' : '';

                            return $state['title'] . $category;
                        })
                        ->addActionLabel('Tambah Video Baru'),
                ]),
        ];
    }
}
