<?php

namespace App\Filament\Resources\HomePageContents\Schemas\Blocks;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;

class ProdiBlock
{
    public static function schema(): array
    {
        return [
            Section::make('Program Studi')
                ->description('Kelola daftar program studi yang akan ditampilkan di halaman depan.')
                ->icon('heroicon-o-academic-cap')
                ->schema([
                    Repeater::make('metadata.prodi')
                        ->label('Daftar Program Studi')
                        ->grid(2)
                        ->schema([
                            // 1. Jenjang Pendidikan
                            Select::make('jenjang')
                                ->label('Jenjang')
                                ->options([
                                    'D2' => 'D2 (Diploma 2)',
                                    'D3' => 'D3 (Diploma 3)',
                                    'D4' => 'D4 / Sarjana Terapan',
                                ])
                                ->placeholder('Pilih Jenjang')
                                ->required(),

                            // 2. Nama Program Studi
                            TextInput::make('nama_prodi')
                                ->label('Nama Program Studi')
                                ->placeholder('Contoh: Rekayasa Perangkat Lunak')
                                ->required()
                                ->columnSpan(2),

                            // 3. Singkatan / Kode Prodi
                            TextInput::make('singkatan')
                                ->label('Singkatan')
                                ->placeholder('Contoh: RPL / TRPL')
                                ->required(),

                            // 4. Status Akreditasi
                            Select::make('akreditasi')
                                ->label('Akreditasi')
                                ->options([
                                    'Unggul' => 'Unggul',
                                    'Baik Sekali' => 'Baik Sekali',
                                    'Baik' => 'Baik',
                                    'A' => 'A',
                                    'B' => 'B',
                                    'C' => 'C',
                                    'Terakreditasi Minimal' => 'Terakreditasi Minimal',
                                ])
                                ->placeholder('Pilih Akreditasi')
                                ->required()
                                ->columnSpan(2),

                            // 5. URL Web Prodi
                            TextInput::make('url')
                                ->label('URL Link Web Prodi')
                                ->placeholder('https://rpl.kampus.ac.id')
                                ->url()
                                ->nullable()
                                ->columnSpan(2),

                            // 6. Deskripsi Singkat
                            Textarea::make('deskripsi')
                                ->label('Deskripsi Ringkas')
                                ->placeholder('Tuliskan deskripsi singkat mengenai program studi ini...')
                                ->rows(3)
                                ->nullable()
                                ->columnSpanFull(),
                        ])
                        ->columns(4)
                        ->collapsible()
                        ->itemLabel(function (array $state): ?string {
                            if (empty($state['nama_prodi'])) {
                                return 'Program Studi Baru';
                            }
                            return ($state['jenjang'] ?? '') . ' ' . $state['nama_prodi'] . ' (' . ($state['singkatan'] ?? '') . ')';
                        })
                        ->addActionLabel('Tambah Program Studi')
                        ->columnSpanFull(),
                ]),
        ];
    }
}
