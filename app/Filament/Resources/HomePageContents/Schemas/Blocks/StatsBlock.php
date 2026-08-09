<?php

namespace App\Filament\Resources\HomePageContents\Schemas\Blocks;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\{TextInput, Textarea};
use Filament\Schemas\Components\{Section, Tabs, Grid};
use Filament\Schemas\Components\Utilities\{Get, Set};

class StatsBlock
{
    public static function schema(): array
    {
        return [
            // 3. STATISTIK / METRIKS (MAKSIMAL 4 METRIKS)
            Section::make('Statistik & Metriks')
                ->description('Tambahkan data statistik atau metriks utama (Maksimal 4 metriks).')
                ->icon('heroicon-o-chart-bar')
                ->schema([
                    Repeater::make('metadata.stats')
                        ->label('Daftar Metriks')
                        ->table([
                            TableColumn::make('Target')
                            ->width(150),
                            TableColumn::make('Label')
                            ->width(250),
                            TableColumn::make('Suffix')
                            ->width(50),
                            TableColumn::make('Sublabel')
                            ->width(250),
                        ])
                        ->schema([
                            TextInput::make('target')
                                ->label('Nilai / Angka Metriks')
                                ->placeholder('Contoh: 150 / 99 / 10')
                                ->required(),
                            TextInput::make('label')
                                ->label('Label Metriks')
                                ->placeholder('Contoh: Klien Puas')
                                ->required(),
                            TextInput::make('suffix')
                                ->label('Sufix Nilai')
                                ->placeholder('Contoh: + , % , K')
                                ->required(),

                            Textarea::make('sublabel')
                                ->label('Keterangan Tambahan (Opsional)')
                                ->placeholder('Contoh: Di seluruh Indonesia')
                                ->nullable(),
                        ])
                        ->columns(4)
                        ->minItems(1)
                        ->maxItems(4) // Menjaga batas maksimal 4 metriks
                        ->collapsible()
                        ->itemLabel(fn(array $state): ?string => $state['label'] ?? 'Metriks Baru')
                        ->addActionLabel('Tambah Metriks')
                        ->columnSpanFull(),
                ]),
        ];
    }
}
