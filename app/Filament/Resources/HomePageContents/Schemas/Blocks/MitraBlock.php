<?php

namespace App\Filament\Resources\HomePageContents\Schemas\Blocks;

use App\Filament\Actions\GenerateAiSampleAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class MitraBlock
{
    public static function schema(): array
    {
        return [
            Section::make('Mitra & Kerjasama Kampus')
                ->description('Kelola daftar mitra industri, instansi pemerintah, dan institusi pendidikan yang bekerja sama.')
                ->icon('heroicon-o-building-office-2')
                ->afterHeader([
                    GenerateAiSampleAction::make()
                        ->targetField('metadata.partners')
                        ->form([
                            // 1. Jumlah Data Sample
                            TextInput::make('count')
                                ->label('Jumlah Data Sample')
                                ->numeric()
                                ->default(6)
                                ->minValue(1)
                                ->maxValue(15)
                                ->required(),

                            // 2. Filter Kategori Mitra
                            CheckboxList::make('categories')
                                ->label('Pilihan Kategori Mitra')
                                ->options([
                                    'Industri & Teknologi' => 'Industri & Teknologi',
                                    'BUMN & Instansi Pemerintah' => 'BUMN & Instansi Pemerintah',
                                    'Perguruan Tinggi / Universitas' => 'Perguruan Tinggi / Universitas',
                                    'Perkebunan & Agribisnis' => 'Perkebunan & Agribisnis',
                                ])
                                ->columns(2)
                                ->default([
                                    'Industri & Teknologi',
                                    'BUMN & Instansi Pemerintah',
                                ]),
                        ])
                        ->prompt(function (array $data): string {
                            $count = $data['count'] ?? 6;
                            $categories = ! empty($data['categories'])
                                ? 'Kategori mitra HARUS dari daftar berikut: ' . implode(', ', $data['categories']) . '.'
                                : 'Kategori mitra bebas.';

                            return "Buatkan {$count} data mitra/partner kerjasama universitas terkemuka di Indonesia. " .
                                "{$categories} " .
                                "Format output HARUS JSON array dengan key: logo (isi null), name (string nama perusahaan/instansi),url (string URL resmi, contoh: https://company.com).";
                        }),
                ])
                ->schema([
                    Repeater::make('metadata.partners')
                        ->label('Daftar Mitra / Partner')
                        ->grid(6)
                        ->schema([
                            // 1. Upload Logo
                            FileUpload::make('logo')
                                ->label('Logo Mitra')
                                ->image()
                                ->imageEditor()
                                ->directory('partner-logos')
                                ->disk('public')
                                ->visibility('public')
                                ->columnSpanFull(),

                            // 2. Nama Instansi / Perusahaan
                            TextInput::make('name')
                                ->label('Nama Perusahaan / Instansi')
                                ->placeholder('Contoh: PT Telkom Indonesia (Persero) Tbk')
                                ->required()
                                ->columnSpanFull(),

                            // 5. Website Resmi
                            TextInput::make('url')
                                ->label('Website / Link Resmi')
                                ->placeholder('https://www.telkom.co.id')
                                ->url()
                                ->nullable()
                                ->columnSpanFull(),
                        ])
                        ->minItems(1)
                        ->collapsible()
                        ->itemLabel(function (array $state): ?string {
                            if (empty($state['name'])) {
                                return 'Mitra Baru';
                            }
                            $category = ! empty($state['category']) ? ' [' . $state['category'] . ']' : '';

                            return $state['name'] . $category;
                        })
                        ->addActionLabel('Tambah Mitra Baru'),
                ]),
        ];
    }
}
