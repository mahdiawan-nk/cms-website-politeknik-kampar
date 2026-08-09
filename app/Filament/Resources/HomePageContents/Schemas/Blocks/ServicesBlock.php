<?php

namespace App\Filament\Resources\HomePageContents\Schemas\Blocks;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;

class ServicesBlock
{
    public static function schema(): array
    {
        return [
            Section::make('Layanan & Sistem Kampus')
                ->description('Kelola daftar layanan digital dan sistem informasi kampus yang tampil di halaman depan.')
                ->icon('heroicon-o-computer-desktop')
                ->schema([
                    Repeater::make('metadata.services')
                        ->label('Daftar Layanan')
                        ->grid(3)
                        ->schema([
                            // 1. Kategori Layanan
                            TextInput::make('kategori')
                                ->label('Kategori / Sasaran')
                                ->placeholder('Contoh: Mahasiswa / Dosen / Umum')
                                ->required()
                                ->columnSpanFull(),

                            // 2. Nama Layanan
                            TextInput::make('name_services')
                                ->label('Nama Layanan')
                                ->placeholder('Contoh: Portal Akademik SIAKAD')
                                ->required()
                                ->columnSpanFull(),

                            // 3. URL Link Layanan
                            TextInput::make('url')
                                ->label('URL Link Portal / Akses')
                                ->placeholder('https://siakad.kampus.ac.id')
                                ->url()
                                ->nullable()
                                ->columnSpanFull(),

                            // 4. Deskripsi Layanan
                            Textarea::make('description')
                                ->label('Deskripsi Layanan')
                                ->placeholder('Tuliskan ringkasan fungsi atau kemudahan dari layanan ini...')
                                ->rows(3)
                                ->nullable()
                                ->columnSpanFull(),
                        ])
                        ->columns(3)
                        ->minItems(3)
                        ->collapsible()
                        ->itemLabel(function (array $state): ?string {
                            if (empty($state['name_services'])) {
                                return 'Layanan Baru';
                            }
                            $kategori = !empty($state['kategori']) ? ' [' . $state['kategori'] . ']' : '';
                            return $state['name_services'] . $kategori;
                        })
                        ->addActionLabel('Tambah Layanan')
                        ->columns(3),
                ]),
        ];
    }
}