<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\{Group,Section,Tabs};
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // KONTEN UTAMA (Kiri - 2 Kolom)
                Group::make()
                    ->schema([
                        Section::make('Detail Agenda & Lokasi Multi-Bahasa')
                            ->description('Kelola judul, lokasi, dan deskripsi acara dalam berbagai bahasa.')
                            ->schema([
                                Tabs::make('Locales')
                                    ->tabs([
                                        // TAB 1: BAHASA INDONESIA
                                        Tabs\Tab::make('Bahasa Indonesia')
                                            ->badge('ID')
                                            ->schema([
                                                TextInput::make('title.id')
                                                    ->label('Judul Agenda (ID)')
                                                    ->placeholder('Contoh: Seminar Internasional: Green Energy & Sustainability')
                                                    ->required()
                                                    ->maxLength(255),

                                                TextInput::make('location.id')
                                                    ->label('Lokasi Acara (ID)')
                                                    ->placeholder('Contoh: Auditorium Utama Kampus Poltek Kampar')
                                                    ->required()
                                                    ->maxLength(255),

                                                RichEditor::make('content.id')
                                                    ->label('Deskripsi Detail (ID)')
                                                    ->placeholder('Tuliskan rincian dan agenda acara dalam Bahasa Indonesia...')
                                                    ->toolbarButtons([
                                                        'bold',
                                                        'italic',
                                                        'underline',
                                                        'bulletList',
                                                        'orderedList',
                                                        'link',
                                                        'undo',
                                                        'redo',
                                                    ]),
                                            ]),

                                        // TAB 2: ENGLISH
                                        Tabs\Tab::make('English')
                                            ->badge('EN')
                                            ->schema([
                                                TextInput::make('title.en')
                                                    ->label('Event Title (EN)')
                                                    ->placeholder('Example: International Seminar: Green Energy & Sustainability')
                                                    ->maxLength(255),

                                                TextInput::make('location.en')
                                                    ->label('Location (EN)')
                                                    ->placeholder('Example: Main Auditorium, Poltek Kampar Campus')
                                                    ->maxLength(255),

                                                RichEditor::make('content.en')
                                                    ->label('Detailed Description (EN)')
                                                    ->placeholder('Write event details and agenda in English...')
                                                    ->toolbarButtons([
                                                        'bold',
                                                        'italic',
                                                        'underline',
                                                        'bulletList',
                                                        'orderedList',
                                                        'link',
                                                        'undo',
                                                        'redo',
                                                    ]),
                                            ]),
                                    ])
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // SIDEBAR PENGATURAN (Kanan - 1 Kolom)
                Group::make()
                    ->schema([
                        // SECTION 1: WAKTU & JADWAL
                        Section::make('Jadwal & Waktu')
                            ->schema([
                                DatePicker::make('event_date')
                                    ->label('Tanggal Pelaksanaan')
                                    ->native(false)
                                    ->displayFormat('d M Y')
                                    ->required()
                                    ->default(now()),

                                Group::make()
                                    ->schema([
                                        TimePicker::make('start_time')
                                            ->label('Mulai')
                                            ->native(false)
                                            ->displayFormat('H:i')
                                            ->seconds(false),

                                        TimePicker::make('end_time')
                                            ->label('Selesai')
                                            ->native(false)
                                            ->displayFormat('H:i')
                                            ->seconds(false),
                                    ])
                                    ->columns(2),

                                Select::make('time_zone')
                                    ->label('Zona Waktu')
                                    ->options([
                                        'WIB'  => 'WIB (Waktu Indonesia Barat)',
                                        'WITA' => 'WITA (Waktu Indonesia Tengah)',
                                        'WIT'  => 'WIT (Waktu Indonesia Timur)',
                                    ])
                                    ->default('WIB')
                                    ->required()
                                    ->native(false),
                            ]),

                        // SECTION 2: MEDIA & STATUS
                        Section::make('Media & Publikasi')
                            ->schema([
                                FileUpload::make('featured_image')
                                    ->label('Poster / Gambar Utama')
                                    ->image()
                                    ->directory('events')
                                    ->imageEditor()
                                    ->maxSize(2048)
                                    ->helperText('Format JPG, PNG, atau WebP. Maksimal 2MB.'),

                                Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'published' => 'Dipublikasikan',
                                        'draft'     => 'Draf',
                                        'archived'  => 'Diarsipkan',
                                    ])
                                    ->default('published')
                                    ->required()
                                    ->native(false),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}