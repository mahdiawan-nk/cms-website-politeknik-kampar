<?php

namespace App\Filament\Resources\HomePageContents\Schemas\Blocks;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\{Section, Tabs, Grid};
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\{Get, Set};
use Filament\Forms\Components\Toggle;

class SekilasProfilBlock
{
    public static function schema(): array
    {
        return [
            Grid::make(2)->schema([
                Section::make('Media Foto Profil')
                    ->description('Upload gambar')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        // Tampil hanya jika memilih "Video Background"
                        FileUpload::make('metadata.foto')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('atachment-img')
                            ->label('Foto Direktur / Atasan')
                            ->required(),
                    ]),

                // 3. KONTEN TEKS (Multi-bahasa)
                Section::make('Teks & Tipografi')
                    ->description('Masukkan judul dan deskripsi cover dalam dua bahasa.')
                    ->icon('heroicon-o-language')
                    ->schema([
                        TextInput::make("metadata.tagline")
                            ->label('Tagline')
                            ->required()
                            ->maxLength(255),

                        TextInput::make("metadata.title")
                            ->label('Title')
                            ->required()
                            ->maxLength(500),
                        TextInput::make("metadata.title_higliht")
                            ->label('Text Title Higlight')
                            ->required()
                            ->maxLength(500),
                        Textarea::make("metadata.quote")
                            ->label('Quote / Deskripsi')
                            ->rows(3)
                            ->maxLength(500),
                        Textarea::make("metadata.text_welcome")
                            ->label('Text Welcome')
                            ->rows(3)
                            ->maxLength(500),
                        Grid::make(2)->schema([
                            // ==========================================
                            // PRIMARY BUTTON
                            // ==========================================
                            Toggle::make('metadata.show_signature')
                                ->label('Tampilkan Signature')
                                ->live()
                                ->columnSpanFull(),

                            TextInput::make('metadata.name_signature')
                                ->label('Nama Lengkap')
                                ->placeholder('Contoh: Mahdiawan Nurkholifah, S.Kom')
                                ->visible(fn(Get $get): bool => (bool) $get('metadata.show_signature')),

                            TextInput::make('metadata.jabatan_signature')
                                ->label('Jabatan')
                                ->placeholder('Contoh: Mahdiawan Nurkholifah, S.Kom')
                                ->visible(fn(Get $get): bool => (bool) $get('metadata.show_signature')),

                        ])
                    ])
            ]),

        ];
    }
}
