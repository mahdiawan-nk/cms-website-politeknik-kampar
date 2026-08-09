<?php

namespace App\Filament\Resources\HomePageContents\Schemas\Blocks;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\CheckboxList;
use App\Filament\Actions\GenerateAiSampleAction;
use Filament\Schemas\Components\{Grid, Section, Tabs, Flex};
class TestimoniBlock
{
    public static function schema(): array
    {
        return [
            Section::make('Testimoni Alumni')
                ->description('Kelola daftar testimoni dan riwayat kesuksesan alumni yang tampil di halaman depan.')
                ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ->afterHeader([
                    GenerateAiSampleAction::make()
                        ->targetField('metadata.testimonials')
                        ->form([
                            // 1. Pilihan Jumlah Data Sample
                            TextInput::make('count')
                                ->label('Jumlah Data Sample')
                                ->numeric()
                                ->default(5)
                                ->minValue(1)
                                ->maxValue(15)
                                ->required(),

                            // 2. Range Tahun Lulus
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('year_from')
                                        ->label('Tahun Lulus (Mulai)')
                                        ->numeric()
                                        ->default(2018)
                                        ->required(),

                                    TextInput::make('year_to')
                                        ->label('Tahun Lulus (Sampai)')
                                        ->numeric()
                                        ->default(2024)
                                        ->required(),
                                ]),

                            // 3. Checkbox Pilihan Program Studi
                            CheckboxList::make('majors')
                                ->label('Pilihan Program Studi (Prodi)')
                                ->options([
                                    'D3 Teknik Informatika' => 'Teknik Informatika',
                                    'D3 Teknik Pengolahan Sawit' => 'Teknik Pengolahan Sawit',
                                    'D3 Perawatan dan Perbaikan Mesin' => 'Perawatan dan Perbaikan Mesin',
                                    'D4 Administrasi Bisnis Internasional' => 'Administrasi Bisnis Internasional',
                                    'D4 Teknologi Rekayasa Logistik' => 'Teknologi Rekayasa Logistik',
                                    'D4 Pengolahan Perkebunan' => 'Pengolahan Perkebunan',
                                    'D4 Manajemen Agribisnis' => 'Manajemen Agribisnis',
                                    'D2 Teknik Pengolahan Kelapa Sawit' => 'Teknik Pengolahan Kelapa Sawit',
                                ])
                                ->columns(2),
                        ])
                        ->prompt(function (array $data): string {
                            $count = $data['count'] ?? 5;
                            $yearFrom = $data['year_from'] ?? 2018;
                            $yearTo = $data['year_to'] ?? 2024;

                            // Jika user memilih prodi tertentu, batasi pilihan prodi pada prompt
                            $selectedMajors = ! empty($data['majors'])
                                ? 'Pilihan program studi HARUS salah satu dari daftar berikut: ' . implode(', ', $data['majors']) . '.'
                                : 'Program studi bebas acak.';

                            return "Buatkan {$count} data testimoni alumni universitas secara acak. " .
                                "{$selectedMajors} " .
                                "Tahun lulus alumni harus berkisar antara tahun {$yearFrom} sampai {$yearTo}. " .
                                "Format output HARUS JSON array dengan key: avatar (isi null), name (string nama & gelar), major (string prodi), graduation_year (integer antara {$yearFrom}-{$yearTo}), current_position (string jabatan & kantor), quote (string testimoni singkat).";
                        }),
                ])
                ->schema([
                    Repeater::make('metadata.testimonials')
                        ->label('Daftar Testimoni')
                        ->grid(5)
                        ->schema([
                            // 1. Upload Foto Alumni
                            FileUpload::make('avatar')
                                ->label('Foto Alumni')
                                ->image()
                                ->avatar()
                                ->imageEditor()
                                ->directory('alumni-photos')
                                ->visibility('public')
                                ->disk('public')
                                ->columnSpanFull(),

                            // 2. Nama Alumni
                            TextInput::make('name')
                                ->label('Nama Lengkap')
                                ->placeholder('Contoh: Ahmad Subagja, S.Kom.')
                                ->required()
                                ->columnSpanFull(),

                            // 3. Program Studi / Jurusan
                            TextInput::make('major')
                                ->label('Program Studi / Jurusan')
                                ->placeholder('Contoh: Teknik Informatika')
                                ->required()
                                ->columnSpanFull(),

                            // 4. Tahun Lulus / Angkatan
                            TextInput::make('graduation_year')
                                ->label('Tahun Lulus / Angkatan')
                                ->placeholder('Contoh: 2020')
                                ->numeric()
                                ->length(4)
                                ->nullable()
                                ->columnSpanFull(),

                            // 5. Pekerjaan / Perusahaan
                            TextInput::make('current_position')
                                ->label('Pekerjaan & Perusahaan Saat Ini')
                                ->placeholder('Contoh: Senior Software Engineer di PT Tech Indonesia')
                                ->required()
                                ->columnSpanFull(),

                            // 6. Isi Testimoni / Quote
                            Textarea::make('quote')
                                ->label('Isi Testimoni')
                                ->placeholder('Tuliskan kesan, pesan, atau pengalaman alumni selama berkuliah...')
                                ->rows(4)
                                ->required()
                                ->columnSpanFull(),
                        ])
                        ->minItems(1)
                        ->collapsible()
                        ->itemLabel(function (array $state): ?string {
                            if (empty($state['name'])) {
                                return 'Testimoni Baru';
                            }
                            $major = !empty($state['major']) ? ' - ' . $state['major'] : '';
                            $year = !empty($state['graduation_year']) ? ' (' . $state['graduation_year'] . ')' : '';
                            return $state['name'] . $major . $year;
                        })
                        ->addActionLabel('Tambah Testimoni'),
                ]),
        ];
    }
}
