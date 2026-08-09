<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\{Group,Section,Tabs};
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // KONTEN UTAMA (Kiri - 2 Kolom)
                Group::make()
                    ->schema([
                        Section::make('Detail Pengumuman Multi-Bahasa')
                            ->description('Kelola judul, badge, dan konten pengumuman dalam berbagai bahasa.')
                            ->schema([
                                Tabs::make('Locales')
                                    ->tabs([
                                        // TAB 1: BAHASA INDONESIA
                                        Tabs\Tab::make('Bahasa Indonesia')
                                            ->badge('ID')
                                            ->schema([
                                                TextInput::make('title.id')
                                                    ->label('Judul Pengumuman (ID)')
                                                    ->placeholder('Contoh: Pengumuman Pelaksanaan Ujian Akhir Semester (UAS)')
                                                    ->required()
                                                    ->maxLength(255),

                                                TextInput::make('badge.id')
                                                    ->label('Badge / Kategori (ID)')
                                                    ->placeholder('Contoh: Akademik, PMB, Kemahasiswaan')
                                                    ->helperText('Label singkat di atas judul pengumuman.')
                                                    ->maxLength(50),

                                                RichEditor::make('content.id')
                                                    ->label('Isi Detail Pengumuman (ID)')
                                                    ->placeholder('Tuliskan rincian pengumuman dalam Bahasa Indonesia...')
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
                                                    ->label('Announcement Title (EN)')
                                                    ->placeholder('Example: End of Semester Final Examination Announcement')
                                                    ->maxLength(255),

                                                TextInput::make('badge.en')
                                                    ->label('Badge / Category (EN)')
                                                    ->placeholder('Example: Academic, Admissions, Student Affairs')
                                                    ->helperText('Short category label above the title.')
                                                    ->maxLength(50),

                                                RichEditor::make('content.en')
                                                    ->label('Detailed Content (EN)')
                                                    ->placeholder('Write detailed announcement content in English...')
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
                        Section::make('Publikasi & Visibilitas')
                            ->schema([
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

                                DateTimePicker::make('published_at')
                                    ->label('Tanggal & Waktu Rilis')
                                    ->default(now())
                                    ->native(false)
                                    ->displayFormat('d M Y, H:i')
                                    ->helperText('Pengumuman hanya tampil di publik jika waktu rilis telah tercapai.'),

                                Toggle::make('is_important')
                                    ->label('Tandai Sebagai Penting')
                                    ->helperText('Aktifkan untuk menampilkan badge "Penting" di halaman utama.')
                                    ->default(false),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}