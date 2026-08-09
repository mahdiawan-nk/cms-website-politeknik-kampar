<?php

namespace App\Filament\Resources\HomePageContents\Schemas\Blocks;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class StaffBlock
{
    public static function schema(): array
    {
        return [
            Section::make('Daftar Dosen & Staf')
                ->description('Kelola daftar dosen dan staf yang tampil di halaman depan.')
                ->icon('heroicon-o-user-group')
                ->schema([
                    Repeater::make('metadata.staff')
                        ->label('Daftar Dosen / Staf')
                        ->grid(5)
                        ->schema([
                            // 1. Upload Foto Profile
                            FileUpload::make('photo')
                                ->label('Foto Profil')
                                ->image()
                                ->avatar() // Membuat preview lingkaran khas foto profil
                                ->imageEditor() // Opsional: mengizinkan crop/edit gambar
                                ->directory('staff-photos')
                                ->visibility('public')
                                ->disk('public')
                                ->columnSpanFull(),

                            // 2. Nama Lengkap & Gelar
                            TextInput::make('name')
                                ->label('Nama Lengkap')
                                ->placeholder('Contoh: Dr. Fulan, M.Kom.')
                                ->required()
                                ->columnSpanFull(),

                            // 3. Jabatan / Peran (Role)
                            TextInput::make('role')
                                ->label('Jabatan / Peran')
                                ->placeholder('Contoh: Dosen / Kepala Laboratorium')
                                ->required()
                                ->columnSpanFull(),

                            // 4. Departemen / Jurusan
                            TextInput::make('department')
                                ->label('Departemen / Jurusan')
                                ->placeholder('Contoh: Teknik Informatika')
                                ->required()
                                ->columnSpanFull(),
                        ])
                        ->minItems(1)
                        ->collapsible()
                        ->itemLabel(function (array $state): ?string {
                            if (empty($state['name'])) {
                                return 'Anggota Baru';
                            }
                            $role = !empty($state['role']) ? ' (' . $state['role'] . ')' : '';
                            return $state['name'] . $role;
                        })
                        ->addActionLabel('Tambah Dosen / Staf'),
                ]),
        ];
    }
}