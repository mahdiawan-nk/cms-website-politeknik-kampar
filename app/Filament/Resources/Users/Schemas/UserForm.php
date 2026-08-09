<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\{Grid,Group,Section};
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'lg' => 3,
                ])
                ->schema([
                    // Kolom Utama (2/3 lebar layar desktop)
                    Group::make([
                        Section::make('Informasi Akun')
                            ->description('Detail profil dasar dan kredensial pengguna.')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->placeholder('Masukkan nama lengkap')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('email')
                                    ->label('Alamat Email')
                                    ->placeholder('nama@domain.com')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),

                                DateTimePicker::make('email_verified_at')
                                    ->label('Waktu Verifikasi Email')
                                    ->placeholder('Pilih tanggal verifikasi')
                                    ->nullable()
                                    ->default(now()),
                            ])
                            ->columns(2),

                        Section::make('Keamanan & Password')
                            ->description('Atur password akun. Kosongkan saat mengedit jika tidak ingin mengubah password.')
                            ->schema([
                                TextInput::make('password')
                                    ->label('Password')
                                    ->password()
                                    ->revealable()
                                    ->required(fn (string $operation): bool => $operation === 'create')
                                    ->dehydrated(fn (?string $state): bool => filled($state))
                                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                                    ->maxLength(255),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                    // Kolom Samping / Sidebar (1/3 lebar layar desktop)
                    Group::make([
                        Section::make('Hak Akses & Peran (Shield)')
                            ->description('Tentukan peran (role) pengguna dalam sistem.')
                            ->schema([
                                Select::make('roles')
                                    ->label('Peran (Roles)')
                                    ->relationship('roles', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
                ]),
            ])
            ->columns([
                'default' => 1,
                'lg' => 1,
            ]);
    }
}