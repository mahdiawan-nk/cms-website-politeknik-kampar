<?php

namespace App\Filament\Resources\Achivements\Tables;

use App\Enums\AchievementLevel;
use App\Enums\AchievementType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Tables\Enums\PaginationMode;

class AchivementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Thumb Gambar Dokumentasi
                ImageColumn::make('image_url')
                    ->label('Foto')
                    ->square(),

                // Judul Prestasi dengan Sub-teks (Organizer & Category)
                TextColumn::make('title')
                    ->label('Judul Prestasi')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => sprintf('%s • %s', $record->organizer, $record->category))
                    ->wrap(),

                // Badge Jenis Prestasi
                TextColumn::make('type')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state?->label() ?? $state)
                    ->color('info')
                    ->sortable(),

                // Badge Skala/Tingkat dengan Pewarnaan Dinamis
                TextColumn::make('level')
                    ->label('Tingkat')
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucfirst($state?->value ?? $state))
                    ->color(fn ($state) => match ($state?->value ?? $state) {
                        'internasional' => 'success',
                        'nasional'      => 'warning',
                        'regional'      => 'info',
                        'lokal'         => 'gray',
                        default         => 'gray',
                    })
                    ->sortable(),

                // Tahun Prestasi
                TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable()
                    ->alignCenter(),

                // Indikator Status Featured
                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->alignCenter(),

                // Slug (Disembunyikan secara bawaan)
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Timestamp Audit
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('year', 'desc')
            ->filters([
                // Filter berdasarkan Jenis Prestasi
                SelectFilter::make('type')
                    ->label('Jenis Prestasi')
                    ->options(AchievementType::class),

                // Filter berdasarkan Tingkat/Skala
                SelectFilter::make('level')
                    ->label('Tingkat / Skala')
                    ->options(AchievementLevel::class),

                // Filter berdasarkan Status Unggulan
                TernaryFilter::make('is_featured')
                    ->label('Unggulan (Featured)'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->paginationMode(PaginationMode::Cursor);
    }
}